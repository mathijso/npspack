<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\NpsResponse;

class Site extends Model
{
    protected $fillable = ['name', 'domain', 'public_id', 'allowed_paths'];

    // Add casts for the JSON column
    protected function casts(): array
    {
        return [
            'allowed_paths' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(NpsResponse::class);
    }
}
