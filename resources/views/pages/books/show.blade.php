<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100" x-data="{ tocOpen: false }">

                    <main>
                        <h1 class="text-4xl font-bold text-center mb-2">{{ $book->title }}</h1>
                        <p class="text-center text-gray-500 mb-8">{{ $book->authors->pluck('name')->join(', ') }}</p>

                        @include('pages.books._content_recursive', ['chapters' => $chapters, 'isTopLevel' => true])
                    </main>

                    <button
                        @click="tocOpen = true"
                        class="fixed top-16 right-4 p-3 bg-sky-600 text-white rounded-full
                        shadow-lg hover:bg-sky-700 focus:outline-none focus:ring-2
                        focus:ring-blue-500 focus:ring-offset-2"
                        aria-label="Открыть оглавление">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div x-show="tocOpen" x-cloak class="fixed inset-0 z-40 flex">
                        <div @click="tocOpen = false" x-show="tocOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/50"></div>

                        <div @click.away="tocOpen = false" x-show="tocOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-white dark:bg-gray-800">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-semibold">Оглавление</h3>
                                    <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">&times;</button>
                                </div>
                                <div class="overflow-y-auto">
                                    @include('pages.books._toc_recursive', ['chapters' => $chapters, 'isTopLevel' => true])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
