<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Админ-панель
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Разделы управления</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:underline">
                                Управление Категориями
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tags.index') }}" class="text-blue-500 hover:underline">
                                Управление Тегами
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.authors.index') }}" class="text-blue-500 hover:underline">
                                Управление Авторами
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles.index') }}" class="text-blue-500 hover:underline">
                                Управление Статьями
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.books.index') }}" class="text-blue-500 hover:underline">
                                Управление Книгами
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
