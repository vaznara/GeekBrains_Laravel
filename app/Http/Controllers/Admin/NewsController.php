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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.form', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $newsId = $this->save($request);
        return redirect()->route('news.SingleNews', $newsId)->with(['success' => 'Новость успешно добавлена']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.news.form', ['news' => $news, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, News $news)
    {
        $newsId = $this->save($request, $news);
        return redirect()->route('news.SingleNews', $newsId)->with(['success' => 'Новость успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     * @param News $news
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        if ($news->image) {
            $file = Str::replaceFirst('/storage', '/public', News::IMG_PATH) . $news->image;
            Storage::delete($file);
        }

        $news->delete();
        return redirect()->route('news.News')->with(['success' => 'Новость успешно удалена']);
    }

    /**
     * Store or update resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save($request, $news = null)
    {
        if (!$news) {
            $news = new News();
        }

        $validatedData = $request->validate($news->getRules());

        $news->fill($validatedData);

        if ($request->file('image')) {
            $request->file('image')->store('public/news/images');
            $news->image = $request->image->hashName();

        }
        $news->save();
        return $news->id;
    }
}
