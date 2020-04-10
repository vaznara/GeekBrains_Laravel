<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    CONST IMG_PATH = '/storage/news/images/';

    protected $fillable = ['title', 'body', 'image', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
