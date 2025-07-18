<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border border-brand-blue-dark dark:border-brand-cream-light rounded-md font-semibold text-xs text-brand-blue-dark dark:text-brand-cream-light uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
