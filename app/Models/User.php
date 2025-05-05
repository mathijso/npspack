<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Site;
use App\Models\Package;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)->explode(' ')->map(fn(string $name) => Str::of($name)->substr(0, 1))->implode('');
    }

    /**
     * Get the sites associated with the user.
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }

    /**
     * Get the package associated with the user.
     */
    public function package(): HasOne
    {
        // Assuming a user might not have a package record initially (defaults to basic)
        return $this->hasOne(Package::class);
    }

    /**
     * Check if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the user's package type ('basic' or 'pro').
     * Admins are always considered 'pro'.
     *
     * @return string
     */
    public function getPackageTypeAttribute(): string
    {
        if ($this->isAdmin()) {
            return 'pro';
        }
        return $this->package?->type ?? 'basic';
    }

    /**
     * Check if the user can create more sites based on their package.
     * Admins can always create more sites.
     *
     * @return bool
     */
    public function canCreateMoreSites(): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($this->package_type === 'pro') {
            return true; // Pro users have unlimited sites
        }

        // Basic users can only have 1 site
        return $this->sites()->count() < 1;
    }
}
