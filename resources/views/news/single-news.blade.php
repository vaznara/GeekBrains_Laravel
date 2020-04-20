@extends('layouts.main')

@section('title', $singleNews->title)

@section('content')
    <div class="card mb-3">
        @if($singleNews->image)
            <div class="card-img-top" style="background: url({{ $img_path . $singleNews->image }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
        @elseif($singleNews->img_uri)
            <div class="card-img-top" style="background: url({{ $singleNews->img_uri }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
        @else
            <div class="card-img-top" style="background: url({{ $img_path . 'default.jpg' }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
        @endif

        <div class="card-body">
            <h5 class="card-title">{{ $singleNews->title }}</h5>
            <p class="card-text">{!! $singleNews->body !!}</p>
        </div>
    </div>
    <div class="news-btns">
        <a href="{{ route('news.News') }}" class="btn">назад к новостям</a>

        @role('admin')
        <div class="admin-icons-news">
            <a href="{{ route('admin.news.edit', $singleNews) }}"><img src="{{ asset('storage/edit.svg') }}"
                                                                       alt="edit"
                                                                       style="width: 25px; height: auto;"></a>
            <button type="button" data-toggle="modal" data-target="#confirm">
                <img src="{{ asset('storage/delete.svg') }}" alt="delete"
                     style="width: 25px; height: auto;">
            </button>
        </div>
        @endrole

    </div>

    @role('admin')
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
    @endrole
@endsection
