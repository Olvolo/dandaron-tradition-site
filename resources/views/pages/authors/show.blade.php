<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-surface overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-brand-blue-dark dark:text-brand-cream-light">

                    {{-- Здесь может быть изображение автора, если мы его добавим --}}
                    <h1 class="text-4xl font-bold mb-8">{{ $author->name }}</h1>
                    {{-- ВЫВОДИМ ФОТО, ЕСЛИ ОНО ЕСТЬ --}}
                    @if($author->image_path)
                        <div class="my-8 flex justify-center">
                            <img src="{{ asset($author->image_path) }}" alt="{{ $author->name }}" class="rounded-lg shadow-md max-w-sm w-full">
                        </div>
                    @endif
                    {{-- Выводим книги автора --}}
                    @if($author->books->isNotEmpty())
                        <h2 class="text-2xl font-semibold mt-8 mb-4 border-b pb-2">Книги</h2>
                        <div class="space-y-3">
                            @foreach($author->books as $book)
                                <a href="{{ route('books.show', $book) }}" class="block text-primary hover:underline text-lg">{{ $book->title }}</a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Выводим статьи автора --}}
                    @if($author->articles->isNotEmpty())
                        <h2 class="text-2xl font-semibold mt-8 mb-4 border-b pb-2">Статьи</h2>
                        <div class="space-y-3">
                            @foreach($author->articles as $article)
                                <a href="{{ route('articles.show', $article) }}" class="block text-primary hover:underline text-lg">{{ $article->title }}</a>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
