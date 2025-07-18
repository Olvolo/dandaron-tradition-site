<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Редактирование главы: &laquo;{{ $chapter->title }}&raquo;
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="parent_id" class="block font-medium text-sm text-gray-700">Родительский раздел</label>
                                <select name="parent_id" id="parent_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                    <option value="">-- Верхний уровень --</option>
                                    @foreach ($chapterTree as $id => $title)
                                        <option value="{{ $id }}" @selected(old('parent_id', $chapter->parent_id) == $id)>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="title" class="block font-medium text-sm text-gray-700">Название главы</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                            </div>
                            <div>
                                <label for="content_html" class="block font-medium text-sm text-gray-700">Содержимое</label>
                                <textarea name="content_html" id="content_html" class="tinymce-editor">{{ old('content_html', $chapter->content_html) }}</textarea>
                            </div>
                            <div>
                                <label for="order_column" class="block font-medium text-sm text-gray-700">Порядковый номер</label>
                                <input type="number" name="order_column" id="order_column" value="{{ old('order_column', $chapter->order_column) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Обновить главу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
