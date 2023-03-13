<div>
    <div class="flex w-full mb-2">
        <div class="flex-initial w-4/6 pr-2">
            <input type="text" wire:model="newStylusName"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Stylus Name" />
        </div>
        <div class="flex-initial w-2/6 pl-2">
            <button type="button" wire:click="handleAddCurrentStylusClick"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Add Stylus
            </button>
        </div>
    </div>
    @if(count($activeStyluses) > 0)
    <div class="flex w-full">
        <div class="flex-initial w-1/2 pr-2 border-r border-black">
            <h1 class="text-4xl mb-2">Active Styluses</h1>
            @foreach ($activeStyluses as $activeStylus)
            <ul class="mb-2 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg">
                    Name: {{ $activeStylus->name }}
                </li>
                <li class="w-full px-4 py-2 border-b border-gray-200">
                    Playtime: {{ $activeStylus->playtime_seconds }}
                </li>
                <li class="w-full px-4 py-2 border-b border-gray-200">
                    Play Sessions: {{ count($activeStylus->playSessions) }}</li>
                <li class="w-full px-4 py-2 border-gray-200">
                    <button type="button" wire:click="handleRetireStylusClick({{ $activeStylus->id }})"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                        Retire Stylus
                    </button>
                </li>
            </ul>
            @endforeach
        </div>
        <div class="flex-initial w-1/2 pl-2">
            <h1 class="text-4xl mb-2">Retired Styluses</h1>
            @foreach ($retiredStyluses as $retiredStylus)
            <ul class="mb-2 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg">Name: {{ $retiredStylus->name }}</li>
                <li class="w-full px-4 py-2 border-b border-gray-200">Playtime: {{ $retiredStylus->playtime_seconds }}
                </li>
                <li class="w-full px-4 py-2 border-b border-gray-200">Retired on: {{ $retiredStylus->updated_at }}</li>
                <li class="w-full px-4 py-2 border-gray-200">Playsessions: {{ count($retiredStylus->playSessions) }}
                </li>
            </ul>
            @endforeach
        </div>
    </div>
    @endif
</div>