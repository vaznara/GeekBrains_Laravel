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

            $id = News::add($request);
            return redirect()->route('news.SingleNews', $id)->with('success', 'Новость добавлена успешно!');

        } else {
            return view('admin.add-news', ['categories' => Categories::getCategories()]);
        }
    }
}
