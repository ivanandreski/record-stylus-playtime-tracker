<div class="flex justify-center">
    <div class="w-3/4" x-data="{
        search: '',
        show_item(el) {
            return this.search === '' ||
            el.dataset.title.toLowerCase().includes(this.search.toLowerCase()) ||
            el.dataset.artist.toLowerCase().includes(this.search.toLowerCase())
        }
    }">
        <div class="mb-2 w-1/2">
            <input type="text" x-model="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Search" />
        </div>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($albums as $album)
            <a href="/play-session/create/{{ $album->id }}" x-show="show_item($el)" data-title="{{ $album->title }}"
                data-artist="{{ $album->artist_name }}">
                <div class="border border-gray-400 rounded">
                    <img src="{{ $album->image_url }}" class="object-fill"/>
                    <h2 class="mt-2 mb-4 px-2 text-xl font-bold leading-none tracking-tight text-gray-900">{{ $album->title }}</h2>
                    <h4 class="mb-4 px-2 text-l leading-none tracking-tight text-gray-900">{{ $album->artist_name }}</h4>
                    <h5 class="mb-4 px-2 leading-none tracking-tight text-gray-900">{{ $album->release_year }}</h5>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>