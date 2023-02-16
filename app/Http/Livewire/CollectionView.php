<?php

namespace App\Http\Livewire;

use App\Models\AlbumCache;
use App\Repository\DiscogsRemoteDataSourceInterface;
use Livewire\Component;

class CollectionView extends Component
{
    public function handleSyncCollection(DiscogsRemoteDataSourceInterface $discogsRemoteDataSource) {
        $pagesJson = $discogsRemoteDataSource->getCollectionJson();
        $discogsRemoteDataSource->parseJsonCollectionAndUpdateCache($pagesJson);
    }

    public function render()
    {
        return view('livewire.collection-view', [
            'albums' => AlbumCache::all()
        ])->layout('layouts.app');
    }
}
