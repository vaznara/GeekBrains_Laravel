<?php

namespace App\Http\Controllers\Admin;

use App\Models\News\Categories;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }
}
