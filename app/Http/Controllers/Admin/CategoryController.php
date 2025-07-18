<?php
//
//namespace App\Http\Controllers\Admin;
//
//use App\Http\Controllers\Controller;
//use App\Models\Category;
//use Illuminate\Http\Request;
//use Illuminate\Support\Str;
//// ИМПОРТЫ ДЛЯ ТИПОВ
//use Illuminate\View\View;
//use Illuminate\Http\RedirectResponse;
//
//class CategoryController extends Controller
//{
//    // Добавлен тип : View
//    public function index(): View
//    {
//        // ИСПОЛЬЗУЕМ ::query()
//        $categories = Category::query()->latest()->paginate(20);
//        return view('admin.categories.index', compact('categories'));
//    }
//
//    // Добавлен тип : View
//    public function create(): View
//    {
//        return view('admin.categories.create');
//    }
//
//    // Добавлен тип : RedirectResponse
//    public function store(Request $request): RedirectResponse
//    {
//        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories']);
//
//        // ИСПОЛЬЗУЕМ ::query()
//        Category::query()->create([
//            'name' => $validated['name'],
//            'slug' => Str::slug($validated['name']),
//        ]);
//
//        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана.');
//    }
//
//    // Добавлен тип : View
//    public function edit(Category $category): View
//    {
//        return view('admin.categories.edit', compact('category'));
//    }
//
//    // Добавлен тип : RedirectResponse
//    public function update(Request $request, Category $category): RedirectResponse
//    {
//        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);
//
//        $category->update([
//            'name' => $validated['name'],
//            'slug' => Str::slug($validated['name']),
//        ]);
//
//        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена.');
//    }
//
//    // Добавлен тип : RedirectResponse
//    public function destroy(Category $category): RedirectResponse
//    {
//        $category->delete();
//        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена.');
//    }
//}


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);
        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена.');
    }
}
