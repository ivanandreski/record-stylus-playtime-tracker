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

    public function handleRetireStylusClick($stylusId)
    {
        $currentStylus = Stylus::find($stylusId);
        $currentStylus->is_retired = true;
        $currentStylus->save();
    }

    public function render()
    {
        $activeStyluses = Stylus::where('is_retired', false)->get();
        $retiredStyluses = Stylus::where('is_retired', true)->get();

        return view('livewire.stylus-view', [
            'activeStyluses' => $activeStyluses,
            'retiredStyluses' => $retiredStyluses,
        ])->layout('layouts.app');
    }
}
