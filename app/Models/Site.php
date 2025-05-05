<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\NpsResponse;

class Site extends Model
{
    protected $fillable = ['name', 'domain', 'public_id'];
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function responses(): HasMany
{
    return $this->hasMany(NpsResponse::class);
}
}
