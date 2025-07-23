<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorPageController extends Controller
{
    // Показать список всех авторов ("Лики Традиции")
    public function index(): View
    {
        $authors = Author::query()->orderBy('order_column')->get();
        return view('pages.faces', compact('authors'));
    }

    // Показать страницу одного автора со всеми его работами
    public function show(Author $author): View
    {
        // "Жадно" загружаем все связанные статьи и книги
        $author->load('articles', 'books');
        return view('pages.authors.show', compact('author'));
    }
}
