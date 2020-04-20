<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'uri_name'];

    public function getNews() {
        return $this->hasMany(News::class);
    }

    public function getRules() {

        return [
            'name' => 'required|min:5|max:100',
            'uri_name' => 'required|min:5|max:100'
        ];
    }
}
