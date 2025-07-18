@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary text-brand-blue-dark dark:text-brand-cream-light focus:outline-none transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-brand-blue-dark/70 dark:text-brand-cream/70 hover:text-brand-blue-dark dark:hover:text-brand-cream-light focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
