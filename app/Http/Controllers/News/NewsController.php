<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\News;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Делаем выборку всех новостей и передаем в вьюху.
     * @return view
     */
    public function index()
    {

        $news = News::query()
            ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.uri_name', 'categories.name')
            ->orderByDesc('published_at')
            ->paginate(9);
        $categories = Category::query()->get();

        return view('news.index', ['categories' => $categories, 'news' => $news, 'img_path' => News::IMG_PATH]);
    }


    /**
     * Передаем данные одной новостью в соответствующую вьюху
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(News $news)
    {
        return view('news.single-news', ['singleNews' => $news, 'img_path' => News::IMG_PATH]);
    }

    /**
     * Делаем выборку по категории и передаем в вьюху новостей
     * либо если такой категорий нет, редиректим на страницу новостей и показываем ошибку
     * @param String $cat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function getNewsByCategoryName($uri_name)
    {

        $categories = Category::query()->get();

        $categoryId = Category::query()
            ->select(['id'])
            ->where('uri_name', $uri_name)->value('id');

        $category = Category::find($categoryId);

        if ($category) {
            $newsByCategory = $category->news()
                ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
                ->select('news.*', 'categories.uri_name', 'categories.name')
                ->orderByDesc('published_at')
                ->paginate(9);

            return view('news.index', ['categories' => $categories, 'news' => $newsByCategory, 'img_path' => News::IMG_PATH]);
        }

        return redirect()->route('news.News')->with(['error' => 'категорий не существует']);

    }
}
