<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors',
            'order_column' => 'nullable|integer',
        ]);

        Author::query()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно создан.');
    }

    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,' . $author->getKey(),
            'order_column' => 'nullable|integer',
        ]);

        $author->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно обновлен.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно удален.');
    }
}
