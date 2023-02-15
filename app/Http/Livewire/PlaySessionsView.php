<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PlaySessionsView extends Component
{
    public function render()
    {
        return view('livewire.play-sessions-view')->layout('layouts.app');
    }
}
