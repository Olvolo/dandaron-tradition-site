<ul class="ml-6 border-l border-gray-200 dark:border-gray-700">
    @foreach ($sections as $section)
        <li class="py-2 px-4">
            <div class="flex justify-between items-center">
                <span>{{ $section->order_column }}. {{ $section->title }}</span>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.sections.edit', $section) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Вы уверены?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                    </form>
                </div>
            </div>

            {{-- Если есть дочерние разделы, вызываем этот же шаблон для них --}}
            @if ($section->children->isNotEmpty())
                @include('admin.articlesections._section_list', ['sections' => $section->children])
            @endif
        </li>
    @endforeach
</ul>
