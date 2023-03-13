<div>
    <div class="flex-initial w-full">
        <h1 class="text-4xl">{{ $album->title }}</h1>
        <p class="my-2 text-xl">{{ $album->artist_name }}</p>
    </div>
    <hr class="my-2" />
    <div class="flex w-full mb-2">
        <div class="flex-initial w-1/2">
            <img class="mb-2 w-full rounded-lg" src="{{ $album->image_url }}" />
        </div>
        <div class="flex-initial w-1/2 pl-4">
            <div>
                <button type="button" wire:click="handleChangeAllTracksClick(true)"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    Full Album
                </button>
                <button type="button" wire:click="handleChangeAllTracksClick(false)"
                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    Clear
                </button>
            </div>
            <div>
                <select wire:model="stylusId" class="">
                    @foreach ($styluses as $stylus)
                        <option value="{{ $stylus->id }}">
                            {{ $stylus->name }} - {{ CarbonInterval::seconds($stylus->playtime_seconds)->cascade()->forHumans(); }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                @foreach ($album->tracks as $track)
                <label class="block">
                    <span>
                        <input wire:model="checkedTracks.{{ $track->id }}" class="w-4 h-4 mr-2" type="checkbox">
                    </span>
                    <span>{{ $track->position }} - {{ $track->name }} - {{ $track->duration_seconds }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="w-full">
        @if ($stylusExists)
        <button
            class="w-full text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
            wire:click="handleAddPlaySessionClick">Add play session</button>
        @else
        <a href="{{ route('stylus-view') }}">
            <button
                class="w-full text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Add a current stylus
            </button>
        </a>
        @endif
    </div>
</div>