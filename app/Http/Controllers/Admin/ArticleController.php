<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()
            ->whereNull('parent_id')
            ->with('category', 'authors')
            ->latest()
            ->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();
        // ИСПРАВЛЕНО: Правильный вызов статического метода
        $articleTree = Article::getArticleTree();
        return view('admin.articles.create', compact('categories', 'authors', 'tags', 'articleTree'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        $article = Article::query()->create($validated);

        $article->authors()->sync($validated['authors']);
        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно создана.');
    }

    public function edit(Article $article): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();
        // ИСПРАВЛЕНО: Правильный вызов статического метода с исключением текущей статьи
        $articleTree = Article::getArticleTree($article->getKey());
        return view('admin.articles.edit', compact('article', 'categories', 'authors', 'tags', 'articleTree'));
    }

    public function update(StoreArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        $article->update($validated);

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
