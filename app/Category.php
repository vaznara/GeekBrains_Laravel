<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'uri_name'];

    public function news() {
        return $this->hasMany(News::class);
    }

    public function rules() {
        return [
            'name' => 'required|min:5|max:100',
        ];
    }

    public static function boot() {
        parent::boot();

        /*
         * При удалении категории удаляем и новости.
         */
        static::deleting(function($category) {
            $category->news()->delete();
        });
    }

    //TODO сделать валидацию с помощью посредника
}
