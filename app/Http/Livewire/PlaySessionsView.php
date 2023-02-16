<?php

namespace App\Http\Livewire;

use App\Models\PlaySession;
use Livewire\Component;

class PlaySessionsView extends Component
{
    public function render()
    {
        $playSessions = PlaySession::paginate(100);

        return view('livewire.play-sessions-view', [
            'playSessions' => $playSessions
        ])->layout('layouts.app');
    }
}
