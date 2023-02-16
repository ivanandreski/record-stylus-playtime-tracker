<?php

namespace App\Http\Livewire;

use App\Models\Stylus;
use Livewire\Component;

class StylusView extends Component
{
    public $newStylusName = "";

    public function handleAddCurrentStylusClick()
    {
        $stylus = new Stylus();
        $stylus->is_retired = false;
        $stylus->name = $this->newStylusName;
        $stylus->playtime_seconds = 0;
        $stylus->save();

        $this->newStylusName = "";
    }

    public function handleRetireCurrentStylusClick()
    {
        $currentStylus = Stylus::where('is_retired', false)->first();
        $currentStylus->is_retired = true;
        $currentStylus->save();
    }

    public function render()
    {
        $currentStylus = Stylus::where('is_retired', false)->first();
        $retiredStyluses = Stylus::where('is_retired', true)->get();

        return view('livewire.stylus-view', [
            'currentStylus' => $currentStylus,
            'retiredStyluses' => $retiredStyluses,
        ])->layout('layouts.app');
    }
}
