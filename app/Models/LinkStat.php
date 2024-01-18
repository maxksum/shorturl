<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkStat extends Model
{
    protected $fillable = [
        'link_id', 'ip_address', 'user_identifier',
    ];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }

    public static function logLinkVisit(Link $link, $userIdentifier, $ipAddress)
    {
        return self::create([
            'link_id' => $link->id,
            'ip_address' => $ipAddress,
        ]);
    }
}
