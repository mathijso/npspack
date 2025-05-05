<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Site;

class NpsResponse extends Model
{
    protected $fillable = [
    'site_id',
    'score',
    'feedback',
    'submitted_at',
    'ip_address',
    'fingerprint',
    'tag',
];

protected $casts = [
    'score' => 'integer',
    'submitted_at' => 'datetime',
];

public $timestamps = false;

public function site(): BelongsTo
{
    return $this->belongsTo(Site::class);
}

public function getTypeAttribute(): string
{
    return match (true) {
        $this->score >= 9 => 'Promoter',
        $this->score >= 7 => 'Passive',
        default => 'Detractor',
    };
}

}
