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

    public function __construct()
    {
        $this->middleware('form_validator:\App\News', ['only' => ['store','update']]);
    }

    /**
     * Показываем форму создания новости
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.form', ['categories' => Category::all()]);
    }

    /**
     * Передаем полученные из формы данные для сохранения в метод Save()
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
     * Показываем форму для редактирования новости
     * @param News $news
     * @return \Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.news.form', ['news' => $news, 'categories' => Category::all()]);
    }

    /**
     * Передаем данные из формы редактирования в метод Save() для сохранения в БД
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
     * Удаляем новость
     * @param News $news
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.News')->with(['success' => 'Новость успешно удалена']);
    }

    /**
     *  Метод для валидации и добавления / обновления новости в БД
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

        $news->fill($request->all());

        if ($request->file('image')) {
            $request->file('image')->store('public/news/images');
            $news->image = $request->image->hashName();

        }

        $news->save();
        return $news->id;
    }
}
