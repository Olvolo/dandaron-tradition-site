<div class="space-y-6">
    <div>
        <label for="title" class="block font-medium text-sm text-gray-700">Название</label>
        <input type="text" name="title" id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('title', $book->title ?? '') }}" required>
    </div>

    <div>
        <label for="authors" class="block font-medium text-sm text-gray-700">Авторы (удерживайте Ctrl для выбора нескольких)</label>
        <select name="authors[]" id="authors" multiple class="block mt-1 w-full rounded-md shadow-sm border-gray-300 h-40">
            @foreach($authors as $author)
                <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', isset($book) ? $book->authors->pluck('id')->toArray() : [])))>{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="description" class="block font-medium text-sm text-gray-700">Описание</label>
        <textarea name="description" id="description" rows="10" class="block mt-1 w-full
        rounded-md shadow-sm border-gray-300">{{ old('description', $book->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="order_column" class="block font-medium text-sm text-gray-700">Порядковый номер</label>
        <input type="number" name="order_column" id="order_column" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('order_column', $book->order_column ?? 0) }}">
    </div>

    <div>
        <label for="custom_styles" class="block font-medium text-sm text-gray-700">Кастомные стили (включая тег &lt;style&gt;)</label>
        <textarea name="custom_styles" id="custom_styles" rows="15" class="block mt-1 w-full
        font-mono text-sm rounded-md shadow-sm border-gray-300">{{ old('custom_styles', $book->custom_styles ?? '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500">Пример: &lt;style&gt;body { background-image: url(...); }&lt;/style&gt;</p>
    </div>
</div>

<div class="mt-6">
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Сохранить</button>
</div>
