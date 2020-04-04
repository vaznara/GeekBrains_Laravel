<?php

namespace App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categories extends Model
{

    public static function getCategories()
    {
        return json_decode(Storage::get('files_db/categories'), true);
    }

    public static function getCategoryIdByName($catName)
    {
        $categoryId = 0;
        $categories = static::getCategories();

        foreach ($categories as $item) {

            if ($item['uri_name'] == $catName) {
                $categoryId = $item['id'];
            }
        }
        return $categoryId;
    }
}
