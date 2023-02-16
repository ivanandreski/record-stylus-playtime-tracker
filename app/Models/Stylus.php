<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylus extends Model
{
    use HasFactory;

    protected $table = 'styluses';

    public function playSessions()
    {
        return $this->hasMany(PlaySession::class);
    }
}
