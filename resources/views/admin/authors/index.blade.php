<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-brand-blue-dark dark:text-brand-cream-light">
                    Управление авторами
                </h1>
                <a href="{{ route('admin.authors.create') }}" class="px-4 py-2 bg-primary text-brand-blue-dark rounded-md hover:bg-primary-hover font-semibold text-xs uppercase">Добавить автора</a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-500/10 text-green-700 dark:text-green-300 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-surface overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-brand-blue-dark dark:text-brand-cream-light">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brand-blue-dark/70 dark:text-brand-cream/70 uppercase">Порядок</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-brand-blue-dark/70 dark:text-brand-cream/70 uppercase">Имя</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-brand-blue-dark/70 dark:text-brand-cream/70 uppercase">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-surface divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($authors as $author)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $author->order_column }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $author->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.authors.edit', $author) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Редактировать</a>
                                    <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Вы уверены?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-brand-blue-dark/70 dark:text-brand-cream/70">Авторов пока нет.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
