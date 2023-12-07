@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-blue-400'
            : 'text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600 dark:hover:text-black';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
