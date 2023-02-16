<div class="w-full">
    <div class="mb-4 relative overflow-x-auto shadow-md border rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Album
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Playtime
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($playSessions as $playSession)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <img class="w-24" src="{{ $playSession->playSessionTracks[0]->track->album->image_url }}" />
                    </th>
                    <td class="px-6 py-4">
                        {{ $playSession->playSessionTracks[0]->track->album->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $playSession->updated_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $playSession->playtime_seconds }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/play-session/{{ $playSession->id }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $playSessions->links() }}
</div>