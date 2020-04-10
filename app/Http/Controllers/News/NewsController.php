<?php

namespace App\Http\Controllers\News;

use App\Models\News\Categories;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    private CONST IMG_PATH = '/storage/news/images/';

    public function index() {
        return view('news.index', ['categories' => Categories::getCategories(), 'news' => News::getNews(), 'img_path' => self::IMG_PATH]);
    }

    public function getOne($id) {
        return view('news.single-news', ['singleNews' => News::getSingleNews($id), 'img_path' => self::IMG_PATH]);
    }

    public function getByCat($cat) {
        return view('news.index', ['categories' => Categories::getCategories(), 'news' => News::getNewsByCat($cat), 'img_path' => self::IMG_PATH]);
    }
}
