<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /*
     * Возвращаем список категории
     */
    public function index()
    {
        return Category::query()->get();
    }
}
