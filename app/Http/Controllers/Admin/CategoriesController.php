<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller {

    // Вывод списка категорий
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    // Вывод формы создания новой категории
    public function create()
    {
        return view('admin.categories.create');
    }

    // Сохранение новой категории в БД
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $category = Category::add($request->all());
        $category->setStatus($request->get('published'));

        return redirect()->route('categories.index')->with('status', "Category '$category->title' has been created");
    }

    // Вывод формы редактирования категории
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();

        return view('admin.categories.edit', compact('category'));
    }

    // Сохранение изменений в категории в БД
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $category = Category::where('slug', $slug)->first();
        $category->edit($request->all());
        $category->setStatus($request->get('published'));

        return redirect()->route('categories.index')->with('status', "Category '$category->title' has been updated");
    }

    // Удаление категории
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categoryName = $category->title;
        $category->delete();

        return redirect()->route('categories.index')->with('status', "Category '$categoryName' has been deleted.");
    }

    // Переключатель статуса категории published
    public function toggle($slug)
    {
        Category::where('slug', $slug)->first()->toggleStatus();

        return redirect()->back()->with('status', 'Category status has been changed');
    }
}
