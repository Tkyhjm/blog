@extends('layouts.default')


@section('title', '記事詳細')


@section('content')
<div class="card-body bg-white">
    <div class="card mb-2">
        <div class="card-header">
            <a href="{{ route('users.show', $post->user_id) }}">
                @isset ($post->user->user_image)
                <span>
                <img class="user-image" src="{{ asset('storage/image/' . $post->user->user_image) }}">
                </span>
                @endisset
                <span>{{ $post->user->name }}</span>
            </a>
            <span>{{ $post->created_at }}</span>
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
            <div>
                @if ($good_check == false)
                <form method="post" action="{{ route('goods.store', $post->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-light"><span class="good-icon"><i class="far fa-thumbs-up "></i> {{ count($post->goods) }}</span></button>
                </form>
                @else
                <form method="post" action="{{ route('goods.delete', $post->id) }}" id="form_{{ $post->id }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-primary"><span class="good-icon"><i class="far fa-thumbs-up "></i> {{ count($post->goods) }}</span></button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary w-100 my-3">コメントする</a>
    <div class="p-3">
        @foreach ($post->comments as $comment)
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <a href="{{ route('users.show', $comment->user_id) }}">
                        @isset ($comment->user->user_image)
                        <span>
                            <img class="user-image" src="{{ asset('storage/image/' . $comment->user->user_image) }}">
                        </span>
                        @endisset
                        <span class="card-text">{{ $comment->user->name }}</span>
                    </a>
                    <span>{{ $comment->created_at }}</span>
                </div>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e($comment->comment)) !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection