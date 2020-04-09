<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Categories extends Model
{

    public static function getCategories()
    {
        $categories = DB::table('categories')->get();
        return $categories;
    }

    public static function getCategoryIdByName($catName)
    {
        $catId = DB::table('categories')->where('uri_name', '=', $catName)->value('id');
        return $catId;
    }
}
