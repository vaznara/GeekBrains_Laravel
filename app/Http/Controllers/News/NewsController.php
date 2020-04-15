<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::query()
            ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.uri_name', 'categories.name', 'deleted_at')
            ->paginate(9);
        $categories = Category::query()->get();

        return view('news.index', ['categories' => $categories, 'news' => $news, 'img_path' => News::IMG_PATH]);
    }

    public function show(News $news)
    {
        return view('news.single-news', ['singleNews' => $news, 'img_path' => News::IMG_PATH]);
    }

    public function getNewsByCategoryName($cat)
    {
        $categories = Category::query()->get();
        $categoryId = Category::query()->select(['id'])->where('uri_name', $cat)->value('id');

        if (Category::find($categoryId)) {
            $newsByCategory = Category::find($categoryId)->getNews()
                ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
                ->select('news.*', 'categories.uri_name', 'categories.name', 'deleted_at')
                ->paginate(9);

            return view('news.index', ['categories' => $categories, 'news' => $newsByCategory, 'img_path' => News::IMG_PATH]);
        }

        return redirect()->route('news.News')->with(['error' => 'категорий не существует']);

    }

}
