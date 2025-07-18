<ul class="ml-6 border-l border-gray-200 dark:border-gray-700">
    @foreach ($chapters as $chapter)
        <li class="py-2 px-4">
            <div class="flex justify-between items-center">
                <span>{{ $chapter->order_column }}. {{ $chapter->title }}</span>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.chapters.edit', $chapter) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                    <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Вы уверены?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                    </form>
                </div>
            </div>

            {{-- Если есть дочерние главы, вызываем этот же шаблон для них --}}
            @if ($chapter->children->isNotEmpty())
                @include('admin.chapters._chapter_list', ['chapters' => $chapter->children])
            @endif
        </li>
    @endforeach
</ul>
