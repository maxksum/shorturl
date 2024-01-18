<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Link extends Model
{
    protected $fillable = [
        'original_url', 'short_url', 'comment', 'user_id',
    ];

    public function getStatsCount()
    {
        return $this->hasMany(LinkStat::class)->count();
    }

    public function getUniqueStatsCount()
    {
        return $this->hasMany(LinkStat::class)
            ->groupBy('ip_address')
            ->distinct()
            ->count('ip_address');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            $link->short_url = $link->short_url ?: Str::random(8);
        });
    }
}

