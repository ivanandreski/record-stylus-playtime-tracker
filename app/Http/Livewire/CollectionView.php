<?php

namespace App\Http\Livewire;

use App\Models\AlbumCache;
use App\Repository\DiscogsRemoteDataSourceInterface;
use Livewire\Component;

class CollectionView extends Component
{
    public $search = "";

    public function handleSyncCollection(DiscogsRemoteDataSourceInterface $discogsRemoteDataSource) {
        $pagesJson = $discogsRemoteDataSource->getCollectionJson();
        $discogsRemoteDataSource->parseJsonCollectionAndUpdateCache($pagesJson);
    }

    public function render()
    {
        $albums = [];
        if (!(strlen($this->search) == 0)) {
            $albums = AlbumCache::where('name', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.collection-view', [
            'albums' => $albums,
        ])->layout('layouts.app');
    }
}
