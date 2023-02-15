<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaySessionTracks extends Model
{
    use HasFactory;

    protected $table = 'play_session_tracks';

    public function track()
    {
        return $this->belongsTo(TrackCache::class, 'track_cache_id', 'owner_key');
    }

    public function playSession()
    {
        return $this->belongsTo(PlaySession::class, 'play_session_id', 'owner_key');
    }
}
