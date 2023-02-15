<?php

namespace App\Http\Livewire;

use App\Models\AlbumCache;
use Livewire\Component;

class CollectionView extends Component
{
    public $search = "";

    // public function

    public function render()
    {
        $albums = [];
        if (!(strlen($this->search) == 0)){
            $albums = AlbumCache::where('name', 'like', '%'.$this->search.'%')->get();
        }

        return view('livewire.collection-view', [
            'albums' => $albums,
        ])
        ->layout('layouts.app');
    }
}
