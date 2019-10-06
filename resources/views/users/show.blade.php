@extends('layouts.default')


@section('title', 'ユーザーページ')


@section('content')
<div class="card-body">
    <div class="card p-4">
       <div class="user-info">
           @isset ($user->user_image)
           <p><img class="profile-user-image" src="{{ asset('storage/image/' . $user->user_image) }}"></p>
           @endisset
           <h2 class="user-name text-center">{{ $user->name }}</h2>
       </div>
        <p class="p-3">{!! nl2br(e($user->message)) !!}</p>
        <ul class="user-status">
            <a href="{{ route('follows.follow', $user->id) }}"><li>フォロー数 : {{ $follow_count }}</li></a>
            <a href="{{ route('follows.follower', $user->id) }}"><li>フォロワー数 : {{ $follower_count }}</li></a>
            <li>投稿数 : {{ count($user->posts) }}</li>
        </ul>
         @if ($follow_check == false)
          <form method="post" action="{{ route('follows.store', $user) }}">
           {{ csrf_field() }}
            <input type="hidden" name="follow_user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-secondary w-100">フォローする</button>
        </form>
        @else
        <form method="post" action="{{ route('follows.delete', $user) }}" id="form_{{ $user->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="follow_user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-info w-100">フォロー中</button>
        </form>
        @endif
    </div>
</div>
<h3 class="title m-4 text-center">投稿一覧</h3>
<div class="card-body bg-white">
    @forelse ($user->posts as $post)
    <div class="card mb-2">
        <div class="card-header">
            @isset ($user->user_image)
            <span>
                <img class="user-image" src="{{ asset('storage/image/' . $user->user_image) }}">
            </span>
            @endisset
            <span>{{ $user->name }}</span>
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
            <span class="good-icon"><i class="far fa-thumbs-up "></i> {{ count($post->goods) }}</span>
        </div>
    </div>
    @empty
    <h5 class="text-center py-5 my-5">投稿はありません</h5>
    @endforelse
</div>
@endsection





