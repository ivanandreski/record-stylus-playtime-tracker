<div>
    <div class="flex-initial w-full">
        <h1 class="text-4xl">{{ $playSession->playSessionTracks[0]->track->album->title }}</h1>
        <p class="my-2 text-xl">{{ $playSession->playSessionTracks[0]->track->album->artist_name }}</p>
        <p class="my-2 text-xl">Duration: {{ $playSession->playtime_seconds }}</p>
    </div>
    <hr class="my-2" />
    <div class="flex w-full mb-2">
        <div class="flex-initial w-1/2">
            <img class="mb-2 w-full rounded-lg"
                src="{{ $playSession->playSessionTracks[0]->track->album->image_url }}" />
        </div>
        <div class="flex-initial w-1/2 pl-4">
            <div>
                @foreach ($playSession->playSessionTracks as $playSessionTrack)
                <label class="block">
                    <span>{{ $playSessionTrack->track->position }} - {{ $playSessionTrack->track->name }} - {{ $playSessionTrack->track->duration_seconds }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
</div>