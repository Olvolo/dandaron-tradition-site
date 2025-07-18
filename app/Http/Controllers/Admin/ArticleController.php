<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()->with('category', 'authors')->latest()->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();
        return view('admin.articles.create', compact('categories', 'authors', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content_html' => 'required|string',
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $article = Article::query()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'content_html' => $validated['content_html'],
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        $article->authors()->sync($validated['authors']);
        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно создана.');
    }

    public function edit(Article $article): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'authors', 'tags'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content_html' => 'required|string',
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'content_html' => $validated['content_html'],
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        $article->authors()->sync($validated['authors']);
        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно обновлена.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно удалена.');
    }
}
