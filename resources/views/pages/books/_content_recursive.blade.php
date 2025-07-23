@foreach($chapters as $chapter)
    <div class="py-6">
        {{-- Заголовок раздела --}}
        <h2 id="section-{{ $chapter->id }}" class="text-2xl font-bold scroll-mt-20 text-center">
            {{ $chapter->title }}
        </h2>

        {{-- Содержимое раздела --}}
        <div class="prose prose-lg dark:prose-invert max-w-none mt-4">
            {!! $chapter->content_html !!}
        </div>

        {{-- Если у этого раздела есть дочерние, выводим их следом --}}
        @if($chapter->children->isNotEmpty())
            @include('pages.books._content_recursive', ['chapters' => $chapter->children, 'isTopLevel' => false])
        @endif
    </div>
@endforeach
