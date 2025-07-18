<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticlePageController extends Controller
{
    public function show(Article $article): View
    {
        // Загружаем связанные модели авторов, чтобы избежать лишних запросов к БД
        $article->load('authors', 'category');

        return view('pages.articles.show', compact('article'));
    }
}
