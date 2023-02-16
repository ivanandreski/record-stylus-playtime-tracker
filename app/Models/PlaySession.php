<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaySession extends Model
{
    use HasFactory;

    protected $table = 'play_sessions';

    public function playSessionTracks()
    {
        return $this->hasMany(PlaySessionTrack::class);
    }

    public function stylus()
    {
        return $this->belongsTo(Stylus::class, 'stylus_id');
    }
}
