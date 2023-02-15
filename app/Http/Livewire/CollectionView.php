<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CollectionView extends Component
{
    public function render()
    {
        return view('livewire.collection-view')->layout('layouts.app');
    }
}
