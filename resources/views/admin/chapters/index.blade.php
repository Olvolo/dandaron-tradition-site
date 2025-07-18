<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Управление главами книги: &laquo;{{ $book->title }}&raquo;
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Структура глав</h3>
                    @if($chapters->isNotEmpty())
                        @include('admin.chapters._chapter_list', ['chapters' => $chapters])
                    @else
                        <p class="text-center">Глав пока нет.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Добавить новую главу/раздел</h3>
                    <form action="{{ route('admin.books.chapters.store', $book) }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="parent_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Родительский раздел</label>
                                <select name="parent_id" id="parent_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-900 dark:border-gray-700">
                                    <option value="">-- Верхний уровень --</option>
                                    @foreach ($chapterTree as $id => $title)
                                        <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ВОТ ЭТИХ ПОЛЕЙ НЕ ХВАТАЛО --}}
                            <div>
                                <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Название главы</label>
                                <input type="text" name="title" id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-900 dark:border-gray-700" required>
                            </div>
                            <div>
                                <label for="content_html" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Содержимое</label>
                                <textarea name="content_html" id="content_html" class="tinymce-editor"></textarea>
                            </div>
                            <div>
                                <label for="order_column" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Порядковый номер</label>
                                <input type="number" name="order_column" id="order_column" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-900 dark:border-gray-700" value="0">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Добавить главу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
