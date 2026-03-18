@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-700 bg-gray-900 text-gray-100 placeholder-gray-400 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm'
]) !!}>
