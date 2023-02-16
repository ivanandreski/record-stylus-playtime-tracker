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
        return $this->hasMany(PlaySessionTracks::class);
    }

    public function stylus()
    {
        return $this->belongsTo(Stylus::class, 'stylus_id', 'owner_key');
    }
}
