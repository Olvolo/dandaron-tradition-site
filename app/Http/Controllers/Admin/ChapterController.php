<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ChapterController extends Controller
{
    // ИЗМЕНЁННЫЙ МЕТОД
    public function index(Book $book): View
    {
        // Загружаем главы верхнего уровня для отображения
        $chapters = $book->chapters()->whereNull('parent_id')->with('children')->orderBy('order_column')->get();

        // Получаем дерево для выпадающего списка в форме
        $chapterTree = $book->getChapterTree();

        return view('admin.chapters.index', compact('book', 'chapters', 'chapterTree'));
    }

    // МЕТОД CREATE УДАЛЁН

    public function store(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_html' => 'required|string',
            'order_column' => 'nullable|integer',
            'parent_id' => 'nullable|exists:chapters,id', // Добавили валидацию для parent_id
        ]);

        $book->chapters()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content_html' => $validated['content_html'],
            'order_column' => $validated['order_column'] ?? 0,
            'parent_id' => $validated['parent_id'],
        ]);

        return redirect()->route('admin.books.chapters.index', $book)->with('success', 'Глава успешно добавлена.');
    }

    public function edit(Chapter $chapter): View
    {
        $chapterTree = $chapter->book->getChapterTree($chapter->id);
        return view('admin.chapters.edit', compact('chapter', 'chapterTree'));
    }

    public function update(Request $request, Chapter $chapter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_html' => 'required|string',
            'order_column' => 'nullable|integer',
            'parent_id' => 'nullable|exists:chapters,id', // Добавили валидацию для parent_id
        ]);

        $chapter->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content_html' => $validated['content_html'],
            'order_column' => $validated['order_column'] ?? 0,
            'parent_id' => $validated['parent_id'],
        ]);

        return redirect()->route('admin.books.chapters.index', $chapter->book)->with('success', 'Глава успешно обновлена.');
    }

    public function destroy(Chapter $chapter): RedirectResponse
    {
        $book = $chapter->book;
        $chapter->delete();
        return redirect()->route('admin.books.chapters.index', $book)->with('success', 'Глава успешно удалена.');
    }
}
