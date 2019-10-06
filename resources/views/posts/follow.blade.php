@extends('layouts.default')


@section('title', 'フォローユーザー記事一覧')


@section('content')
<div class="card-body">
    <div class="card p-4">
        <p>投稿を探してみよう!</p>
        <form action="{{ route('posts.search') }}" method="get" class="m-0">
            {{ csrf_field() }}
            <input type="text" name="search" placeholder="キーワード検索">
            <button class="btn-sm btn-secondary" type="submit">検索</button>
        </form>
        @isset($search_result)
        <p class="pt-4">{{ $search_result }}</p>
        @endisset
    </div>
</div>
<div class="container">
    <div class="row list">
        <span class="col-2"></span>
        <a href="{{ route('posts.index') }}" class="btn btn-light col-3 small-font ">全て表示</a>
        <span class="col-2"></span>
        <a href="{{ route('posts.follow') }}" class="btn btn-info col-3 small-font">フォローのみ表示</a>
        <span class="col-2"></span>
    </div>
</div>
<div class="card-body bg-white">
    @foreach ($follow_posts as $post)
    <div class="card mb-2">
        <div class="card-header">
            <a href="{{ route('users.show', $post->user_id) }}">
                @isset ($post->user_image)
                <span>
                    <img class="user-image" src="{{ asset('storage/image/' . $post->user_image) }}">
                </span>
                @endisset
                <span>{{ $post->name }}</span>
            </a>
            <span class="float-right mt-2">{{ $post->created_at }}</span>
        </div>
        <div class="card-body">
            <div class="card-title">
                <p class="content-title">
                    <span>{{ $post->title }}</span>
                    <span class="float-right"><i class="{{ $post->type }}"></i></span>
                </p>
            </div>
            <div class="card-text">
                <p>{!! nl2br(e($post->content)) !!}</p>
                @isset ($post->image)
                <p><img class="content-image" src="{{ asset('storage/image/' . $post->image) }}"></p>
                @endisset
            </div>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary float-right">詳細</a>
        </div>
    </div>
    @endforeach
</div>
<div class="paginate">
@if(isset($search_query))
{{ $follow_posts->appends(['search' => $search_query])->links() }}
@else
{{ $follow_posts->links() }}
@endif
@endsection
</div>
