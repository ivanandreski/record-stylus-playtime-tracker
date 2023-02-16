@props(['active'])

<li class="inline-block">
    <a @class([ 'py-2 pl-3 pr-4 border-b-2 border-transparent hover:border-blue-700 text-center' , 'text-blue-700'=>
        $active,
        'text-gray-700' => !$active,
        ]) {{ $attributes }}>
        {{ $slot }}
    </a>
</li>