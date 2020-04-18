@extends('layouts.main')

@section('title', 'Новости')

@section('content')
    <ul class="nav nav-pills news-nav">
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'news.News') === 0) ? 'active' : '' }}"
               href="{{ route('news.News') }}">Все</a>
        </li>

        @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ (request()->path() == 'news/categories/' . $category->uri_name) ? 'active' : '' }}"
                   href="{{ route('news.Categories', $category->uri_name) }}">{{ $category->name }}</a>
            </li>
        @endforeach

    </ul>
    <div class="row">

        @foreach ($news as $item)
            <div class="card col-4 border-0">
                <div class="card-img-top"
                     style="background: url({{ $item->image ? $img_path . $item->image : $img_path . 'default.jpg' }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }} <a href="{{ route('news.Categories', $item->uri_name) }}">
                            <span class="badge badge-dark">{{ $item->name }}</span></a></h5>
                    <p class="card-text">{!! Str::limit($item->body, 60) !!}</p>
                    <div class="news-btns">
                        <a href="{{ route('news.SingleNews', $item) }}" class="btn btn-primary">Подробнее</a>
                        @role('admin')
                            <div class="admin-icons">
                                <a href="{{ route('admin.news.edit', $item) }}"><img
                                        src="{{ asset('storage/edit.svg') }}" alt="edit"
                                        style="width: 25px; height: auto;"></a>
                                <button type="button" data-toggle="modal" data-target="#confirm"
                                        data-route="{{ route('admin.news.destroy', $item) }}">
                                    <img src="{{ asset('storage/delete.svg') }}" alt="edit"
                                         style="width: 25px; height: auto;">
                                </button>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @include('components.modal', ['modaltext' => 'Вы уверены, что хотите удалить эту новость?'])

    <div>{{ $news->links() }}</div>
@endsection

@section('custom-scripts')
    <script>
        let formButton = document.querySelectorAll(".admin-icons button");

        for (let i = 0; i < formButton.length; i++) {
            formButton[i].addEventListener('click', function (e) {
                e.preventDefault();
                let actionUri = e.currentTarget.dataset.route;
                let modalForm = document.querySelector("#modal-form");
                modalForm.action = actionUri;
            })
        }
    </script>
@endsection
