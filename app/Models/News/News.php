<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class News extends Model
{

    public $imgCatalog;
    public $table;

    public static function getNews()
    {
        $newsData = DB::table('news')
            ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name', 'categories.uri_name')
            ->get();
        return $newsData;
    }

    public static function getNewsByCat($catName)
    {
        $catId = Categories::getCategoryIdByName($catName);
        $newsData = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('category_id', '=', $catId)
            ->get();

        return $newsData;
    }

    public static function getSingleNews($id)
    {
        return DB::table('news')->find($id);
    }

    public static function add($request)
    {

        $request->file('news_image')->store('public/news/images');

        $data = [
            "title" => $request->news_title,
            "body" => $request->news_body,
            "category_id" => Categories::getCategoryIdByName($request->news_category),
            "image" => $request->news_image->hashName()
        ];

        return DB::table('news')->insertGetId($data);
    }
}
