<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class News extends Model
{
    use SoftDeletes;

    CONST IMG_PATH = '/storage/news/images/';
    // TODO подумать, может перенести в общий конфиг

    protected $fillable = ['title', 'body', 'image', 'category_id', 'img_uri', 'published_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parseNews($newsXmlItems)
    {
        $sqlErrors = [];

        foreach ($newsXmlItems as $item) {

            try {
                $newsClass = new News();

                $newsClass->title = $item['title'];
                $newsClass->body = $item['description'];
                $newsClass->img_uri = $item['enclosure::url'];
                $newsClass->published_at = date_create_from_format('D, d M Y H:i:s O', $item['pubDate']);

                // Если в источнике у новости нет категорий, устанавливаем категорию по умолчанию (1)
                // Если же категория есть, ищем в БД по имени
                if ($item['category'] === null) {
                    $categoryId = 1;
                } else {
                    $categoryId = Category::query()->where('name', '=', $item['category'])->select('id')->value('id');
                }

                // Если категория есть в базе, присваиваем его ID, если нет - создаем новую категорию в базе.
                if ($categoryId) {
                    $newsClass->category_id = $categoryId;
                } else {

                    $categoryData = [
                        'name' => $item['category'],
                        'uri_name' => Str::slug($item['category'])
                    ];

                    $category = New Category();
                    $category->fill($categoryData)->save();

                    $newsClass->category_id = $category->id;
                }

                $newsClass->save();

            } catch (QueryException $exception) {
                // В Базе дата публикации и заголовок новости являются уникальными,
                // следовательно отлавливаем ошибку нарушение уникальности и добавляем заголовок в массив
                // для отображения списка уже существующих новостей пользователю
                if ($exception->getCode() == 23000) {
                    array_push($sqlErrors, $item['title']);
                    continue;
                }
            }
        }
        return $this->createMessage($sqlErrors, count($newsXmlItems));
    }

    /**
     * Функция для сборки сообщения пользователю и редиректа
     * @param array $sqlErrors
     * @param int $countNews
     * @return String
     */
    private function createMessage(array $sqlErrors, int $countNews)
    {
        if (empty($sqlErrors)) {
            $message = 'Парсинг завершен успешно.';
        } else {

            $message = 'Парсинг завершен успешно. Не были добавлены следующие новости (уже есть в базе)<br><ol>';
            for ($i = 0; $i < count($sqlErrors); $i++) {
                $message .= '<li>' . $sqlErrors[$i] . '</li>';
            }
            $message .= '</ol>';
        }

        if ($countNews == count($sqlErrors)) {
            $message = 'Новых новостей нет';
        }

        return $message;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:5|max:50',
            'body' => 'required|min:100',
            'category_id' => 'required|numeric',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1000'
        ];
    }
}
