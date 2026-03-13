@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-primary-700 bg-primary-50 dark:text-primary-300 dark:bg-primary-900/20 transition-colors duration-200'
            : 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-surface-600 hover:text-primary-700 hover:bg-primary-50 dark:text-surface-400 dark:hover:text-primary-300 dark:hover:bg-primary-900/20 transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
