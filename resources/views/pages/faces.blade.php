<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6 text-center text-brand-blue-dark
            dark:text-brand-cream-light">Лики Традиции</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($authors as $author)
                    <a href="{{ route('authors.show', $author) }}" class="block p-6 bg-white dark:bg-surface rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                        <h2 class="text-xl font-semibold text-primary">{{ $author->name }}</h2>
                        {{-- В будущем здесь может быть краткое описание автора --}}
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
