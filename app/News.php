<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    CONST IMG_PATH = '/storage/news/images/';
    // TODO подумать, может перенести в общий конфиг

    protected $fillable = ['title', 'body', 'image', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function rules() {
        return [
            'title' => 'required|min:5|max:50',
            'body' => 'required|min:100',
            'category_id' => 'required|numeric',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1000'
            //TODO сделать isPrivate
        ];
    }
}
