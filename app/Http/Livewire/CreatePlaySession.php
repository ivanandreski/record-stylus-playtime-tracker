<?php

namespace App\Http\Livewire;

use App\Models\Stylus;
use Livewire\Component;
use App\Models\AlbumCache;
use App\Models\PlaySession;
use App\Models\PlaySessionTrack;
use App\Models\TrackCache;
use App\Repository\AlbumCacheRepositoryInterface;
use App\Repository\DiscogsRemoteDataSourceInterface;

class CreatePlaySession extends Component
{
    public AlbumCache $album;
    public $checkedTracks;

    public function mount(
        AlbumCacheRepositoryInterface $albumCacheRepository,
        DiscogsRemoteDataSourceInterface $discogsRemoteDataSource
    ) {
        if (!$albumCacheRepository->tracksExistForAlbumCache($this->album->id)) {
            $discogsRemoteDataSource->updateTracksForAlbum($this->album);
        }

        foreach ($this->album->tracks as $track) {
            $this->checkedTracks[$track->id] = false;
        }
    }

    public function handleChangeAllTracksClick($newValue)
    {
        foreach ($this->checkedTracks as $key => $value) {
            $this->checkedTracks[$key] = $newValue;
        }
    }

    public function handleAddPlaySessionClick()
    {
        $currentStylus = Stylus::where('is_retired', false)->first();
        $playSession = new PlaySession();
        $playSession->stylus_id = $currentStylus->id;
        $playSession->playtime_seconds = 0;
        $playSession->save();

        $playtime = 0;
        foreach($this->checkedTracks as $key => $value) {
            if($value) {
                $track = TrackCache::find($key);
                $playtime += $track->duration_seconds;

                $playSessionTrack = new PlaySessionTrack();
                $playSessionTrack->play_session_id = $playSession->id;
                $playSessionTrack->track_cache_id = $key;
                $playSessionTrack->save();
            }
        }

        $playSession->playtime_seconds = $playtime;
        $playSession->save();

        return redirect()->route('play-sessions-view');
    }

    public function render()
    {
        return view('livewire.create-play-session', [
            'stylusExists' => Stylus::where('is_retired', false)->exists(),
        ])->layout('layouts.app');
    }
}
