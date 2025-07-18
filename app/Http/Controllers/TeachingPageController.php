<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeachingPageController extends Controller
{
    public function __invoke(): View
    {
        // Укажем ID категорий, которые должны отображаться на этой странице
        $categoryIds = [1, 2, 3]; // Предположим, это ID для "Философии", "Сутры" и "Тантры"

        $categories = Category::query()
            ->whereIn('id', $categoryIds)
            ->with(['articles' => function ($query) {
                $query->orderBy('order_column'); // Сортируем статьи внутри каждой категории
            }])
            ->get();

        return view('pages.teaching', compact('categories'));
    }
}
