<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackCache extends Model
{
    use HasFactory;

    protected $table = 'tracks_cache';

    public function album()
    {
        return $this->belongsTo(AlbumCache::class, 'album_cache_id', 'owner_key');
    }

    public function playSessionTracks()
    {
        return $this->hasMany(PlaySessionTracks::class);
    }
}
