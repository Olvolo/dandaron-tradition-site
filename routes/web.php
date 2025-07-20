<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\TeachingPageController;
use App\Http\Controllers\ArticlePageController;
use App\Http\Controllers\BookPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\ArticleSectionController;

// --- ПУБЛИЧНАЯ ЧАСТЬ ---

// Главная страница
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Тематические страницы
Route::view('/tradition', 'pages.tradition')->name('tradition');
Route::view('/dandaron', 'pages.dandaron')->name('dandaron');
Route::view('/faces', 'pages.faces')->name('faces');
Route::get('/teaching', TeachingPageController::class)->name('teaching');
Route::view('/history', 'pages.history')->name('history');
Route::view('/additions', 'pages.additions')->name('additions');Route::view('/contacts', 'pages.contacts')->name('contacts');

Route::get('/books', [BookPageController::class, 'index'])->name('books.index');
Route::get('/books/{book:slug}', [BookPageController::class, 'show'])->name('books.show');

Route::get('/articles/{article:slug}', [ArticlePageController::class, 'show'])->name('articles.show');

// Поиск (пока не создаём, чтобы не усложнять)
Route::get('/search', SearchController::class)->name('search');

// --- АДМИН-ПАНЕЛЬ ---
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Тут будут маршруты для управления контентом (CRUD)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('tags', TagController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('books', BookController::class);
    Route::resource('books.chapters', ChapterController::class)->shallow();
    Route::resource('articles.sections', ArticleSectionController::class)->shallow();
});

// НОВЫЙ МАРШРУТ ДЛЯ СОВМЕСТИМОСТИ С BREEZE
Route::get('/dashboard', function () {
    // Просто перенаправляем на настоящий дашборд админа
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Стандартные маршруты аутентификации от Laravel Breeze
require __DIR__.'/auth.php';
