@extends('layouts.main')

@section('title', $singleNews->title)

@section('content')
    <div class="card mb-3">
        <div class="card-img-top"
             style="background: url({{ $singleNews->image ? $img_path . $singleNews->image : $img_path . 'default.jpg' }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
        <div class="card-body">
            <h5 class="card-title">{{ $singleNews->title }}</h5>
            <p class="card-text">{!! $singleNews->body !!}</p>
        </div>
    </div>
    <div class="news-btns">
        <a href="{{ route('news.News') }}" class="btn">назад к новостям</a>
        @auth
            <div class="admin-icons-news">
                <a href="{{ route('admin.news.edit', $singleNews) }}"><img src="{{ asset('storage/edit.svg') }}"
                                                                           alt="edit"
                                                                           style="max-width: 32px;width: 100%; height: 100%;"></a>
                <button type="button" data-toggle="modal" data-target="#confirm">
                    <img src="{{ asset('storage/delete.svg') }}" alt="delete"
                         style="max-width: 32px;width: 100%; height: 100%;">
                </button>
            </div>
        @endauth
    </div>
    @auth
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmLabel">Удаление новости</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Вы уверены, что хотите удалить эту новость?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <form action="{{ route('admin.news.destroy', $singleNews) }}" method="post">
                            <button type="submit" class="btn btn-primary" value="Delete">Удалить</button>
                            <input type="hidden" name="_method" value="delete"/>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
