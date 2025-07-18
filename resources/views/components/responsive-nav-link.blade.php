@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-primary text-left text-base font-medium text-primary bg-primary/10 dark:bg-primary/20 focus:outline-none transition duration-150 ease-in-out'
                : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-brand-blue-dark/80 dark:text-brand-cream/80 hover:text-brand-blue-dark dark:hover:text-brand-cream-light hover:bg-gray-50 dark:hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
