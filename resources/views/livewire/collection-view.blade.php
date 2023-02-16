<div class="w-full">
    <div x-data="{
        search: '',
        show_item(el) {
            return this.search === '' ||
            el.dataset.title.toLowerCase().includes(this.search.toLowerCase()) ||
            el.dataset.artist.toLowerCase().includes(this.search.toLowerCase())
        }
    }">
        <div class="flex mb-2 w-full">
            <div class="flex-initial w-1/2 pr-2">
                <input type="text" x-model="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Search" />
            </div>
            <div class="flex-initial w-1/2 pl-2">
                <button type="button" wire:click="handleSyncCollection"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    Sync Collection
                </button>
            </div>
        </div>
        <div wire:loading class="flex justify-center w-full">
            <x-spinner />
        </div>
        <div wire:loading.class="hidden" class="grid grid-cols-4 xxs:grid-cols-1 gap-3 w-full">
            @foreach ($albums as $album)
            <a href="/play-session/create/{{ $album->id }}" x-show="show_item($el)" data-title="{{ $album->title }}"
                data-artist="{{ $album->artist_name }}">
                <div class="border border-gray-400 rounded">
                    <img src="{{ $album->image_url }}" class="object-fill" />
                    <h2 class="mt-2 mb-4 px-2 text-xl font-bold leading-none tracking-tight text-gray-900">{{
                        $album->title }}</h2>
                    <h4 class="mb-4 px-2 text-l leading-none tracking-tight text-gray-900">{{ $album->artist_name }}
                    </h4>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>