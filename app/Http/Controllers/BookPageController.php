<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookPageController extends Controller
{
    // Показать список всех книг
    public function index(): View
    {
        $books = Book::query()->with('authors')->orderBy('order_column')->get();
        return view('pages.books.index', compact('books'));
    }

    // Показать одну книгу со всеми ее главами
    public function show(Book $book): View
    {
        // Загружаем только главы верхнего уровня, а их "детей" подгружаем рекурсивно
        $chapters = $book->chapters()
            ->whereNull('parent_id')
            ->with('children') // Можно сделать ->with('children.children...') для большей глубины
            ->orderBy('order_column')
            ->get();

        return view('pages.books.show', compact('book', 'chapters'));
    }
}
