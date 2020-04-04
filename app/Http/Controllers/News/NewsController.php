<?php

namespace App\Http\Controllers\News;

use App\Models\News\Categories;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index() {
        return view('news.index', ['categories' => Categories::getCategories()]);
    }

    public function getOne($id) {
        return view('news.single-news', ['singleNews' => News::getSingleNews($id)]);
    }

    public function getByCat($cat) {
        return view('news.list', ['news' => News::getNewsByCat($cat)]);
    }
}
