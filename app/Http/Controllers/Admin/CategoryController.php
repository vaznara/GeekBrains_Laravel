<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('form_validator:\App\Category', ['only' => ['store','update']]);
    }

    /**
     * Отображаем список категорий
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.category.index', ['categories' => Category::all()]);
    }

    /**
     * Отображаем форму для создания категорий
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Передаем данные в метод Save() для сохранения данных в БД
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->save($request);
        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно добавлена!']);
    }

    /**
     * Отображаем форму для редактирования категорий
     * @param Category $category
     * @return View
     */
    public function edit(Category $category)
    {
        return view('admin.category.form', ['category' => $category]);
    }

    /**
     * Передаем обновленные данные в метод Save() для сохранения данных в БД
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Category $category)
    {
        $this->save($request, $category);
        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно изменена!']);
    }

    /**
     * Удаляем категорию
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно удалена']);
    }


    /**
     * Валидируем полученные данные и сохраняем в БД.
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function save(Request $request, $category = null)
    {

        if (!$category) {
            $category = new Category();
        }

        $category->fill($request->all());
        $category->uri_name = Str::slug($request['name']);
        $category->save();

        return $category->id;
    }
}
