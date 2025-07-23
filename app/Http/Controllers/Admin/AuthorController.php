<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest; // <-- Используем Form Request
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::query()->orderBy('order_column')->paginate(20);
        return view('admin.authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('admin.authors.create');
    }

    // Используем StoreAuthorRequest
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        Author::query()->create($validated);

        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно создан.');
    }

    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    // Используем StoreAuthorRequest
    public function update(StoreAuthorRequest $request, Author $author): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        $author->update($validated);

        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно обновлен.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно удален.');
    }
}
