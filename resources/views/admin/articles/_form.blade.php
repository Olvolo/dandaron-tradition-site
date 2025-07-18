<div class="space-y-6">
    <div>
        <label for="title" class="block font-medium text-sm text-gray-700">Заголовок</label>
        <input type="text" name="title" id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('title', $article->title ?? '') }}" required>
    </div>

    <div>
        <label for="category_id" class="block font-medium text-sm text-gray-700">Категория</label>
        <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="authors" class="block font-medium text-sm text-gray-700">Авторы (удерживайте Ctrl для выбора нескольких)</label>
        <select name="authors[]" id="authors" multiple class="block mt-1 w-full rounded-md shadow-sm border-gray-300 h-32">
            @foreach($authors as $author)
                {{-- ИСПРАВЛЕНА ЛОГИКА ПРОВЕРКИ --}}
                <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', isset($article) ? $article->authors->pluck('id')->toArray() : [])))>{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="tags" class="block font-medium text-sm text-gray-700">Теги (удерживайте Ctrl для выбора нескольких)</label>
        <select name="tags[]" id="tags" multiple class="block mt-1 w-full rounded-md shadow-sm border-gray-300 h-32">
            @foreach($tags as $tag)
                {{-- ИСПРАВЛЕНА ЛОГИКА ПРОВЕРКИ --}}
                <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : [])))>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="content_html" class="block font-medium text-sm text-gray-700">Содержимое</label>
        <textarea name="content_html" id="content_html" rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 tinymce-editor">{{ old('content_html', $article->content_html ?? '') }}</textarea>
    </div>

    <div>
        <label for="order_column" class="block font-medium text-sm text-gray-700">Порядковый номер</label>
        <input type="number" name="order_column" id="order_column" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('order_column', $article->order_column ?? 0) }}">
    </div>
</div>

<div class="mt-6">
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Сохранить</button>
</div>
