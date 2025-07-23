<div class="space-y-4">
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700">Имя</label>
        <input type="text" name="name" id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('name', $author->name ?? '') }}" required>
        @error('name')
        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image_path" class="block font-medium text-sm text-gray-700">Путь к фото</label>
        <input type="text" name="image_path" id="image_path" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('image_path', $author->image_path ?? '') }}">
        <p class="mt-1 text-xs text-gray-500">Пример: /images/authors/dandaron.jpg</p>
        @error('image_path')
        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="order_column" class="block font-medium text-sm text-gray-700">Порядковый номер</label>
        <input type="number" name="order_column" id="order_column" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('order_column', $author->order_column ?? 0) }}">
        @error('order_column')
        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Сохранить</button>
</div>
