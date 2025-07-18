<div class="{{ $isTopLevel ? '' : 'ml-6 border-l pl-6' }}">
    @foreach($chapters as $chapter)
        <div class="py-4">
            <h2 id="section-{{ $chapter->id }}" class="text-2xl font-bold scroll-mt-20">{{ $chapter->title }}</h2>
            <div class="prose dark:prose-invert max-w-none mt-4">
                {!! $chapter->content_html !!}
            </div>

            @if($chapter->children->isNotEmpty())
                @include('pages.books._content_recursive', ['chapters' => $chapter->children, 'isTopLevel' => false])
            @endif
        </div>
    @endforeach
</div>
