<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(Book $book): View
    {
        $chapters = $book->chapters()->whereNull('parent_id')->with('children')->orderBy('order_column')->get();
        $chapterTree = $book->getChapterTree();
        return view('admin.chapters.index', compact('book', 'chapters', 'chapterTree'));
    }

    public function store(StoreChapterRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        $book->chapters()->create($validated);

        return redirect()->route('admin.books.chapters.index', $book)->with('success', 'Глава успешно добавлена.');
    }

    public function edit(Chapter $chapter): View
    {
        $chapterTree = $chapter->book->getChapterTree($chapter->id);
        return view('admin.chapters.edit', compact('chapter', 'chapterTree'));
    }

    public function update(StoreChapterRequest $request, Chapter $chapter): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        $chapter->update($validated);

        return redirect()->route('admin.books.chapters.index', $chapter->book)->with('success', 'Глава успешно обновлена.');
    }

    public function destroy(Chapter $chapter): RedirectResponse
    {
        $book = $chapter->book;
        $chapter->delete();
        return redirect()->route('admin.books.chapters.index', $book)->with('success', 'Глава успешно удалена.');
    }
}
