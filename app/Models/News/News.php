<?php

namespace App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    public static function getNews()
    {
        return json_decode(Storage::get('files_db/news'), true);
    }

    public static function getNewsByCat($catName)
    {

        $catId = Categories::getCategoryIdByName($catName);
        $news = self::getNews();
        $chosenNews = [];

        foreach ($news as $item) {
            if ($item['category_id'] == $catId) {
                $chosenNews[] = $item;
            }
        }
        return $chosenNews;
    }

    public static function getSingleNews($id)
    {
        return static::getNews()[$id];
    }

    public static function add($request)
    {
            $news = News::getNews();
            $requestParams = $request->only(['news-header', 'news-body', 'category-selector']);

            $news[array_key_last($news) + 1] = [
                "id" => array_key_last($news) + 1,
                "title" => $requestParams['news-header'],
                "body" => $requestParams['news-body'],
                "category_id" => Categories::getCategoryIdByName($requestParams['category-selector'])
            ];

            $news = json_encode($news);
            Storage::put('files_db/news', $news);
    }
}
