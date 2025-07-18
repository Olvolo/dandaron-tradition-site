<?php

namespace App\Http\Controllers;

use App\Helpers\SearchHelper;
use App\Models\Article;
use App\Models\Author;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $query = $request->input('q');
        $results = collect();

        if ($query) {
            $articles = Article::search($query)->get();
            $chapters = Chapter::search($query)->get();
            $books = Book::search($query)->get();
            $authors = Author::search($query)->get();

            $chapters->load('book');
            $books->load('authors');

            // Добавляем сниппеты к статьям и главам
            $articles->each(fn($item) => $item->snippet = SearchHelper::highlight($item->content_html, $query));
            $chapters->each(fn($item) => $item->snippet = SearchHelper::highlight($item->content_html, $query));

            // Используем merge вместо concat
            $results = $articles
                ->merge($chapters)
                ->merge($books)
                ->merge($authors);
        }

        return view('pages.search.results', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
