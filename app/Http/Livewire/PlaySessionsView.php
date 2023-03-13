<?php

namespace App\Http\Livewire;

use App\Models\PlaySession;
use App\Models\Stylus;
use Livewire\Component;

class PlaySessionsView extends Component
{
    public $stylusId;

    public function mount()
    {
        $this->stylusId = Stylus::where('is_retired', false)->first()->id;
    }

    public function render()
    {
        $playSessions = PlaySession::where('stylus_id', $this->stylusId)
            ->orderBy('updated_at', 'desc')
            ->paginate(100);
        $styluses = Stylus::all();

        return view('livewire.play-sessions-view', [
            'playSessions' => $playSessions,
            'styluses' => $styluses
        ])->layout('layouts.app');
    }
}
