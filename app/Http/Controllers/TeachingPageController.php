<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                // ДОБАВЛЯЕМ УСЛОВИЕ: ВЫБИРАТЬ ТОЛЬКО СТАТЬИ ВЕРХНЕГО УРОВНЯ
                $query->whereNull('parent_id')->orderBy('order_column');
            }])
            ->get();

        return view('pages.teaching', compact('categories'));
    }
}
