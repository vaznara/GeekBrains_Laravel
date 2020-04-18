<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /*
     * Возвращаем вьюху страницы "О ..."
     */
    public function index() {
        return view('about');
    }
}
