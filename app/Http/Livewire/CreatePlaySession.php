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
    public $stylusId;

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

        $this->stylusId = Stylus::where('is_retired', false)->first()->id;
    }

    public function handleChangeAllTracksClick($newValue)
    {
        foreach ($this->checkedTracks as $key => $value) {
            $this->checkedTracks[$key] = $newValue;
        }
    }

    public function handleAddPlaySessionClick()
    {
        $currentStylus = Stylus::find($this->stylusId);
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

        if($playtime == 0) {
            $playtime = 40*60;
        }

        $playSession->playtime_seconds = $playtime;
        $playSession->save();

        $currentStylus->playtime_seconds += $playtime;
        $currentStylus->save();

        return redirect()->route('play-sessions-view');
    }

    public function render()
    {
        $styluses = Stylus::where('is_retired', false)->get();

        return view('livewire.create-play-session', [
            'styluses' => $styluses,
            'stylusExists' => count($styluses) > 0,
        ])->layout('layouts.app');
    }
}
