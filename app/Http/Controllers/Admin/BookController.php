<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest; // <-- Используем Form Request
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::query()->with('authors')->orderBy('order_column')->paginate(20);
        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->validated(); // Получаем проверенные данные
        $validated['slug'] = Str::slug($validated['title']);

        $book = Book::query()->create($validated);
        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно создана.');
    }

    public function edit(Book $book): View
    {
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(StoreBookRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated(); // Получаем проверенные данные
        $validated['slug'] = Str::slug($validated['title']);

        $book->update($validated);
        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Книга успешно удалена.');
    }
}
