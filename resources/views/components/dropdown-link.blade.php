@props(['active' => false])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-100 bg-gray-900 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-200 hover:bg-gray-900 hover:text-white focus:outline-none focus:bg-gray-900 focus:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
