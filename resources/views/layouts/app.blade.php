    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Архив Традиции Дандарона') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tiny.cloud/1/s9ruegseg1w39nvgw7am8g8ys8a3ryn4ozp2yuvsrfwbhx22/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY < 300)" class="font-sans antialiased
    bg-brand-blue-light text-brand-blue-dark
    dark:bg-brand-blue dark:text-brand-cream-light">
<div class="min-h-screen flex flex-col">
    {{-- HEADER --}}
    <header class="bg-white dark:bg-brand-blue-light/10 shadow">
        @include('layouts.navigation')
    </header>

    {{-- MAIN --}}
    <main class="flex-grow flex justify-center">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white dark:bg-brand-blue-light/10 border-t border-brand-blue-light
    dark:border-white/10 py-2">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 text-center text-brand-blue-dark/70
        dark:text-brand-cream/70">

            <nav class="flex justify-center flex-wrap gap-x-6 gap-y-2 mb-4">
                <a href="{{ route('welcome') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Главная</a>
                <a href="{{ route('tradition') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Традиция</a>
                <a href="{{ route('dandaron') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Дандарон</a>
                <a href="{{ route('faces') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Лики Традидии</a>
                <a href="{{ route('books.index') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Книги</a>
                <a href="{{ route('teaching') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Учение</a>
                <a href="{{ route('history') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">История</a>
                <a href="{{ route('additions') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Дополнения</a>
                <a href="{{ route('contacts') }}" class="hover:text-brand-blue-dark dark:hover:text-brand-cream-light transition">Контакты</a>
            </nav>

            <p>© {{ date('Y') }} Архив Традиции Дандарона. Все права защищены.</p>
        </div>
    </footer>

</div>

{{-- SCROLL-TO-TOP BUTTON --}}
<button
    x-show="!atTop"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed bottom-5 right-5 p-3 bg-primary text-brand-blue-dark rounded-full shadow-lg hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
    aria-label="Прокрутить наверх"
>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
</button>
</body>
</html>
