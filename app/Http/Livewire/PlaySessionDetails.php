<?php

namespace App\Http\Livewire;

use App\Models\PlaySession;
use Livewire\Component;

class PlaySessionDetails extends Component
{
    public PlaySession $playSession;

    public function render()
    {
        return view('livewire.play-session-details')->layout('layouts.app');
    }
}
