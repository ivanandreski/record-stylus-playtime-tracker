<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                    <x-nav-bar-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-bar-link>
                    <x-nav-bar-link :href="route('collection-view')" :active="request()->routeIs('collection-view')">
                        Collection</x-nav-bar-link>
                    <x-nav-bar-link :href="route('play-sessions-view')"
                        :active="request()->routeIs('play-sessions-view')">Play Sessions</x-nav-bar-link>
                    <x-nav-bar-link :href="route('stylus-view')" :active="request()->routeIs('stylus-view')">Styluses
                    </x-nav-bar-link>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>