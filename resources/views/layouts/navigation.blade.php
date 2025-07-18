<nav x-data="{ open: false }" class="bg-white dark:bg-brand-blue-light/10 border-b border-gray-200 dark:border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/logo.webp') }}" alt="Логотип" class="block h-9 w-auto">
                    </a>
                </div>
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex flex-wrap items-center">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">Главная</x-nav-link>
                    <x-nav-link :href="route('tradition')" :active="request()->routeIs('tradition')">Традиция</x-nav-link>
                    <x-nav-link :href="route('dandaron')" :active="request()->routeIs('dandaron')">Дандарон</x-nav-link>
                    <x-nav-link :href="route('faces')" :active="request()->routeIs('faces')">Лики Традиции</x-nav-link>
                    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">Книги</x-nav-link>
                    <x-nav-link :href="route('teaching')" :active="request()->routeIs('teaching')">Учение</x-nav-link>
                    <x-nav-link :href="route('history')" :active="request()->routeIs('history')">История</x-nav-link>
                    <x-nav-link :href="route('additions')" :active="request()->routeIs('additions')">Дополнения</x-nav-link>
                    <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-nav-link>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <form action="{{ route('search') }}" method="GET" class="mr-4">
                    <input type="search" name="q" placeholder="Поиск..." value="{{ request('q') }}" class="block w-full text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 focus:border-primary dark:focus:ring-primary">
                </form>
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-brand-blue-dark dark:text-brand-cream-light hover:text-primary">Войти</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-brand-blue-dark dark:text-brand-cream-light hover:text-primary">Регистрация</a>
                    @endif
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-brand-blue-dark/70 dark:text-brand-cream/70 bg-white dark:bg-transparent hover:text-brand-blue-dark dark:hover:text-brand-cream-light focus:outline-none transition ease-in-out duration-150">
                                <span>{{ Auth::user()->name }}</span>
                                <span class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </span>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if (Auth::user()->is_admin)
                                <x-dropdown-link :href="route('admin.dashboard')">Админ-панель</x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">Профиль</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <x-dropdown-link href="#" @click.prevent="document.getElementById('logout-form').submit()">
                                    Выйти
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-brand-blue-dark/70 hover:text-brand-blue-dark focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">Главная</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tradition')" :active="request()->routeIs('tradition')">Традиция</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dandaron')" :active="request()->routeIs('dandaron')">Дандарон</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faces')" :active="request()->routeIs('faces')">Лики Традиции</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">Книги</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('teaching')" :active="request()->routeIs('teaching')">Учение</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history')" :active="request()->routeIs('history')">История</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('additions')" :active="request()->routeIs('additions')">Дополнения</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-white/10">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-brand-blue-dark dark:text-brand-cream-light">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-brand-blue-dark/80">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    @if (Auth::user()->is_admin)
                        <x-responsive-nav-link :href="route('admin.dashboard')">
                            Админ-панель
                        </x-responsive-nav-link>
                    @endif
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Профиль
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                        @csrf
                        <x-responsive-nav-link href="#" @click.prevent="document.getElementById('logout-form-mobile').submit()">
                            Выйти
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">Войти</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Регистрация</x-responsive-nav-link>
                </div>
            @endguest
        </div>
    </div>
</nav>
