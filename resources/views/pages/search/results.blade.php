@php use App\Models\Article;use App\Models\Author;use App\Models\Book;use App\Models\Chapter; @endphp
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-surface overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-brand-blue-dark dark:text-brand-cream-light">

                    {{-- ЗАГОЛОВОК СТРАНИЦЫ --}}
                    @if($query)
                        <h1 class="text-3xl font-bold mb-2">
                            Результаты поиска: "{{ $query }}"
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-brand-cream/70 mb-8">
                            Найдено совпадений: {{ $results->count() }}
                        </p>
                    @else
                        <h1 class="text-3xl font-bold mb-6">Поиск по сайту</h1>
                    @endif

                    {{-- СПИСОК РЕЗУЛЬТАТОВ --}}
                    <div class="space-y-6">
                        @forelse ($results as $result)
                            <div class="border-b border-gray-200 dark:border-white/10 pb-4">
                                @if ($result instanceof Article)
                                    <h2 class="text-xl font-semibold">
                                        <a href="{{ route('articles.show', $result) }}"
                                           class="text-primary hover:underline">
                                            {!! App\Helpers\SearchHelper::highlight($result->title, $query) !!}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-500 dark:text-brand-cream/70 mt-2">{!! $result->snippet !!}</p>
                                    <p class="text-xs text-gray-400 dark:text-brand-cream/50 mt-2">
                                        Тип: Статья</p>

                                @elseif ($result instanceof Chapter)
                                    <h2 class="text-xl font-semibold">
                                        <a href="{{ route('books.show', $result->book) }}#section-{{$result->id}}"
                                           class="text-primary hover:underline">
                                            {!! App\Helpers\SearchHelper::highlight($result->title, $query) !!}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-500 dark:text-brand-cream/70 mt-2">{!! $result->snippet !!}</p>
                                    <p class="text-xs text-gray-400 dark:text-brand-cream/50 mt-2">
                                        Тип: Глава из книги "{{ $result->book->title }}"
                                    </p>

                                @elseif ($result instanceof Book)
                                    <h2 class="text-xl font-semibold">
                                        <a href="{{ route('books.show', $result) }}"
                                           class="text-primary hover:underline">
                                            {!! App\Helpers\SearchHelper::highlight($result->title, $query) !!}
                                        </a>
                                    </h2>
                                    <p class="text-xs text-gray-400 dark:text-brand-cream/50 mt-2">
                                        Тип: Книга
                                        (Авторы: {{ $result->authors->pluck('name')->join(', ') }})
                                    </p>

                                @elseif ($result instanceof Author)
                                    <h2 class="text-xl font-semibold text-primary">
                                        {!! App\Helpers\SearchHelper::highlight($result->name, $query) !!}
                                    </h2>
                                    <p class="text-xs text-gray-400 dark:text-brand-cream/50 mt-2">
                                        Тип: Автор
                                    </p>
                                @endif
                            </div>
                        @empty
                            @if($query)
                                <p>По вашему запросу ничего не найдено.</p>
                            @else
                                <p>Введите поисковый запрос в форме в шапке сайта.</p>
                            @endif
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
