<?php

namespace App\Models;

use App\Helpers\Base62;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    protected $fillable = [
        'url',
        'short_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            if (auth()->check() && !$url->created_by) {
                $url->created_by = auth()->id();
            }
        });
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getShortUrl(): string
    {
        return url($this->short_url);
    }


    public function generateShortUrl(): void
    {
        $this->short_url = Base62::generateUnique(6);
    }
}
