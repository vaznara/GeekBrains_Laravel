<?php

namespace App\Http\Controllers\News;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()->get();
        return $categories;
    }
}
