<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        $book = Book::query()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно создана.');
    }

    public function edit(Book $book): View
    {
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        $book->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete(); // Каскадное удаление глав сработает автоматически благодаря событию в модели
        return redirect()->route('admin.books.index')->with('success', 'Книга успешно удалена.');
    }
}
