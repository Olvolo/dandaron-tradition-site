<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleSectionController extends Controller
{
    public function index(Article $article): View
    {
        $sections = $article->children()->with('children')->orderBy('order_column')->get();
        // Используем правильный не-статический метод
        $sectionTree = $article->getSectionTree();
        return view('admin.articlesections.index', compact('article', 'sections', 'sectionTree'));
    }

    public function store(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_html' => 'nullable|string',
            'order_column' => 'nullable|integer',
            'parent_id' => 'nullable|exists:articles,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['category_id'] = $article->category_id; // Наследуем категорию

        /** @var Article $section */
        $section = $article->children()->create($validated);
        $section->authors()->sync($article->authors->pluck('id')); // Наследуем авторов

        return redirect()->route('admin.articles.sections.index', $article)->with('success', 'Раздел успешно добавлен.');
    }

    public function edit(Article $section): View
    {
        $section->load('parent');
        // Используем правильный не-статический метод от родителя
        $sectionTree = $section->parent->getSectionTree($section->getKey());
        return view('admin.articlesections.edit', compact('section', 'sectionTree'));
    }

    public function update(Request $request, Article $section): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_html' => 'nullable|string',
            'order_column' => 'nullable|integer',
            'parent_id' => 'nullable|exists:articles,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $section->update($validated);

        return redirect()->route('admin.articles.sections.index', $section->parent_id)->with('success', 'Раздел успешно обновлен.');
    }

    public function destroy(Article $section): RedirectResponse
    {
        $section->load('parent');
        $parentArticle = $section->parent;
        $section->delete();
        return redirect()->route('admin.articles.sections.index', $parentArticle)->with('success', 'Раздел успешно удален.');
    }
}
