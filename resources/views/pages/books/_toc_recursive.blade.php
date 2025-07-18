<ul class="space-y-2 {{ $isTopLevel ? '' : 'ml-4' }}">
    @foreach($chapters as $chapter)
        <li>
            <a href="#section-{{ $chapter->id }}" class="hover:underline">{{ $chapter->title }}</a>
            @if($chapter->children->isNotEmpty())
                @include('pages.books._toc_recursive', ['chapters' => $chapter->children, 'isTopLevel' => false])
            @endif
        </li>
    @endforeach
</ul>
