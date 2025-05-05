<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use LemonSqueezy\Laravel\Billable;

use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Site;
// use App\Models\Package;
use Laravel\Sanctum\HasApiTokens;
use LemonSqueezy\Laravel\Order;
use LemonSqueezy\Laravel\Variant;

/**
 * @uses \LemonSqueezy\Laravel\Order<
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Billable, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

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
     * Check if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the package type based on purchased variants.
     */
    public function getPackageTypeAttribute(): string
    {
        if ($this->is_admin) {
            return 'pro';
        }
        // Check Pro variant first
        if ($this->hasPurchasedVariant(config('lemonsqueezy.variants.pro'))) {
            return 'pro';
        }
        // Then check Basic variant
        if ($this->hasPurchasedVariant(config('lemonsqueezy.variants.basic'))) {
             return 'basic';
        }

        return 'none'; // Default if no relevant variant purchased
    }

    /**
     * Check if the user can create more sites based on their purchased package.
     */
    public function canCreateMoreSites(): bool
    {
        if ($this->is_admin) {
            return true; // Admins always can
        }

        $packageType = $this->package_type; // Uses the updated attribute getter
        $siteCount = $this->sites()->count();

        if ($packageType === 'pro') {
            // Pro users have unlimited sites (or a high limit)
            // return $siteCount < 100; // Example high limit
            return true; // Example: Unlimited
        } elseif ($packageType === 'basic') {
            // Basic users have a limit (e.g., 1 site)
            // Get limit from config, default to 1 if not set
            return $siteCount < config('limits.basic_max_sites', 1);
        }

        // No package purchased or 'none' package
        return false;
    }
}
