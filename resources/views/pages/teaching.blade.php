<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-6">Учение</h1>

                    {{-- Контейнер для нашего аккордеона --}}
                    <div x-data="{ openSection: 1 }" class="space-y-4">

                        @forelse ($categories as $category)
                            <div class="rounded-lg border border-gray-200 dark:border-gray-700">
                                {{-- Заголовок-карточка, который открывает/закрывает секцию --}}
                                <div @click="openSection = (openSection === {{ $category->id }} ? null : {{ $category->id }})"
                                     class="p-4 md:p-6 flex justify-between items-center cursor-pointer bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    <h2 class="text-xl font-semibold text-blue-600 dark:text-blue-400">{{ $category->name }}</h2>
                                    {{-- Иконка-стрелочка --}}
                                    <svg :class="{'rotate-180': openSection === {{ $category->id }} }" class="w-5 h-5 text-gray-500 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>

                                {{-- Выпадающий список статей --}}
                                <div x-show="openSection === {{ $category->id }}" x-transition class="p-4 md:p-6 border-t border-gray-200 dark:border-gray-700">
                                    <ul class="list-disc list-inside space-y-2">
                                        @forelse ($category->articles as $article)
                                            <li>
                                                <a href="{{ route('articles.show', $article) }}" class="text-indigo-500 hover:underline">{{ $article->title }}</a>                                            </li>
                                        @empty
                                            <li class="text-gray-500">Статей в этой категории пока нет.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">На данный момент нет категорий для отображения.</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
