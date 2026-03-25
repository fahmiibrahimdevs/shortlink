<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'clicks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
