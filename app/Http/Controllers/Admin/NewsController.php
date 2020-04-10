<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('admin.news.form', ['categories' => Category::all()]), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->fill($request->all());

        if ($request->file('image')) {
            $request->file('image')->store('public/news/images');
            $news->image = $request->image->hashName();

        }

        $news->save();
        return redirect()->route('news.SingleNews', $news->id)->with(['success' => 'Новость успешно добавлена']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return response(view('admin.news.form', ['news' => $news, 'categories' => Category::all()]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $news->fill($request->all());

        if ($request->file('image')) {
            $request->file('image')->store('public/news/images');
            $news->image = $request->image->hashName();
        }

        $news->save();
        return redirect()->route('news.SingleNews', $news->id)->with(['success' => 'Новость успешно изменена!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param News $news
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        if($news->image) {
            $file = Str::replaceFirst('/storage', '/public', News::IMG_PATH) . $news->image;
            Storage::delete($file);
        }

        $news->delete();
        return redirect()->route('news.News')->with(['success' => 'Новость успешно удалена']);
    }
}
