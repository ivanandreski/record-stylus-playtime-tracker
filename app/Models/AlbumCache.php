<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumCache extends Model
{
    use HasFactory;

    protected $table = 'album_cache';

    public function tracks()
    {
        return $this->hasMany(TrackCache::class);
    }
}
