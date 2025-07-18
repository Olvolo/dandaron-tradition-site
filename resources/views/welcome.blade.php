<x-app-layout>
    {{-- Слот для основного содержимого --}}
    <div
        class="relative flex flex-grow items-center justify-center bg-cover bg-center min-h-full"
        style="background-image: url('{{ asset('images/main_background.webp') }}');">

        {{-- Слой для затемнения (нейтральный тёмно-серый) --}}
        <div class="absolute inset-0 bg-gray-900/10"></div>

        {{-- Контейнер для контента --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-brand-cream-light">

            {{-- Приветственный текст --}}
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Архив Традиции Дандарона
            </h1>
            <p class="text-lg md:text-xl text-brand-cream mb-8">
                Онлайн-архив и мемориал, посвященный жизни и работам Учителя Бидии Дандаровича Дандарона и его учеников.
            </p>

            {{-- Карточки-ссылки на ключевые разделы --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('tradition') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Традиция</h3>
                    <p class="text-brand-cream">Учителя линии преемственности</p>
                </a>
                <a href="{{ route('dandaron') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Дандарон</h3>
                    <p class="text-brand-cream">Биография, письма и работы Учителя</p>
                </a>
                <a href="{{ route('faces') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Лики Традиции</h3>
                    <p class="text-brand-cream">Ученики и последователи, работы</p>
                </a>
                <a href="{{ route('teaching') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Учение</h3>
                    <p class="text-brand-cream">Философия, сутры и тантры, садханы</p>
                </a>
                <a href="{{ route('history') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">История</h3>
                    <p class="text-brand-cream">История Учения и не только</p>
                </a>
                <a href="{{ route('additions') }}" class="block p-6 bg-brand-blue-dark/70 rounded-lg backdrop-blur-sm hover:bg-brand-blue-dark/90 transition-colors duration-300">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Дополнения</h3>
                    <p class="text-brand-cream">Материалы и ссылки</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
