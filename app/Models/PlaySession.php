<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaySession extends Model
{
    use HasFactory;

    protected $table = 'play_session';

    public function playSessionTracks()
    {
        return $this->hasMany(PlaySessionTracks::class);
    }
}
