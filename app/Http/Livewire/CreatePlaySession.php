<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AlbumCache;
use App\Repository\AlbumCacheRepositoryInterface;
use App\Repository\DiscogsRemoteDataSourceInterface;

class CreatePlaySession extends Component
{
    public AlbumCache $album;

    public function mount(
        AlbumCacheRepositoryInterface $albumCacheRepository,
        DiscogsRemoteDataSourceInterface $discogsRemoteDataSource
        ) {
        if(!$albumCacheRepository->tracksExistForAlbumCache($this->album->id)) {
            $discogsRemoteDataSource->updateTracksForAlbum($this->album);
        }
    }

    public function render()
    {
        return view('livewire.create-play-session');
    }
}
