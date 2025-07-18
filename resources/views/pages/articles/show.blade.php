<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $article->title }}</h1>

                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        <span>Опубликовано в категории:
                            <a href="#" class="text-blue-500 hover:underline">{{ $article->category->name }}</a>
                        </span>
                        @if($article->authors->isNotEmpty())
                            <span class="mx-2">|</span>
                            <span>Авторы: {{ $article->authors->pluck('name')->join(', ') }}</span>
                        @endif
                    </div>

                    <div class="prose dark:prose-invert max-w-none">
                        {!! $article->content_html !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
