<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Управление статьями
                </h1>
                <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Добавить статью</a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Заголовок</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Категория</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($articles as $article)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $article->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $article->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.articles.sections.index', $article) }}" class="text-green-600 hover:text-green-900">Разделы</a>                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Вы уверены?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center">Статей пока нет.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
