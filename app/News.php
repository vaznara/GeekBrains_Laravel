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

    public function getRules() {

        return [
            'title' => 'required|min:5|max:50',
            'body' => 'required',
            'category_id' => 'required|numeric',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1000'
            //TODO сделать isPrivate
        ];
    }
}
