<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserController extends Controller
{
    public function index()
    {
        $uri = 'http://img.lenta.ru/r/EX/import.rss';

        $xml = XmlParser::load($uri);
        $newsXml = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[title,pubDate,category,description,enclosure::url,guid]'],
            'pubDate' => ['uses' => 'channel.pubDate']
        ]);

        $news = new News();
        $result = $news->parseNews($newsXml['news']);

        return redirect()->route('news.News')->with(['success' => $result]);
    }
}
