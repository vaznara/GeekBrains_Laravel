<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(view('admin.category.index', ['categories' => Category::all()]), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('admin.category.form'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all())->save();

        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно добавлена!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response(view('admin.category.form', ['category' => $category]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->all())->save();
        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно изменена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with(['success' => 'Категория успешно удалена']);
    }
}
