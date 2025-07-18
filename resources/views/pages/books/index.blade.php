<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-6">Книги</h1>
                    <div class="space-y-4">
                        @forelse($books as $book)
                            <a href="{{ route('books.show', $book) }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                <h2 class="text-xl font-semibold text-blue-600 dark:text-blue-400">{{ $book->title }}</h2>
                                <p class="text-sm text-gray-500">{{ $book->authors->pluck('name')->join(', ') }}</p>
                            </a>
                        @empty
                            <p>Книг пока нет.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
