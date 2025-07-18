<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-left text-sm leading-5 text-brand-blue-dark dark:text-brand-cream-light hover:bg-gray-100 dark:hover:bg-white/10 focus:outline-none focus:bg-gray-100 dark:focus:bg-white/10 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
