<?php

namespace App\Http\Controllers\Admin;

use App\Models\News\Categories;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->flash();
            News::add($request);
            $newsCategory = $request->only(['category-selector']);
            return redirect()->route('news.Categories', ['category' => $newsCategory['category-selector']]);
        } else {
            return view('admin.add-news', ['categories' => Categories::getCategories()]);
        }
    }
}
