<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StylusView extends Component
{
    public function render()
    {
        return view('livewire.stylus-view')->layout('layouts.app');
    }
}
