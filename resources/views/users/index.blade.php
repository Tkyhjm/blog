@extends('layouts.default')


@section('title', 'マイページ')


@section('content')
<div class="card-body">
    <div class="card p-4">
       <div class="user-info">
           @isset (Auth::user()->user_image)
           <p><img class="profile-user-image" src="{{ asset('storage/image/' . Auth::user()->user_image) }}"></p>
           @endisset
           <h2 class="user-name text-center">{{ Auth::user()->name }}</h2>
       </div>
        <p class="p-3">{!! nl2br(e(Auth::user()->message)) !!}</p>
        <ul class="user-status">
            <a href="{{ route('follows.follow', Auth::id()) }}"><li>フォロー数 : {{ $follow_count }}</li></a>
            <a href="{{ route('follows.follower', Auth::id()) }}"><li>フォロワー数 : {{ $follower_count }}</li></a>
            <li>投稿数 : {{ count($posts) }}</li>
        </ul>
        <a href="{{ route('users.edit', Auth::id()) }}" class="btn btn-info mt-4">プロフィールを編集する</a>
    </div>
</div>
<section>
   <ul class="nav nav-tabs">
       <li class="nav-item font-weight-bold"><a href="#posts" class="nav-link active" data-toggle="tab">投稿一覧</a></li>
       <li class="nav-item font-weight-bold"><a href="#comments" class="nav-link" data-toggle="tab">コメント一覧</a></li>
   </ul>
   <div class="tab-content">
       <div id="posts" class="tab-pane active">
           <div class="card-body bg-white">
               @forelse ($posts as $post)
               <div class="card mb-2">
                   <div class="card-header">
                       @isset ($post->user->user_image)
                       <span>
                           <img class="user-image" src="{{ asset('storage/image/' . $post->user->user_image) }}">
                       </span>
                       @endisset
                       <span>{{ Auth::user()->name }}</span>
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
                       <div class="float-right">
                           <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
                           <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                           <a href="#" class="btn btn-primary del" data-id="{{ $post->id }}">削除</a>
                           <form method="post" action="{{ route('posts.destroy', $post->id) }}" id="form_{{ $post->id }}">
                               {{ csrf_field() }}
                               {{ method_field('delete') }}
                           </form>
                       </div>
                       <span class="good-icon"><i class="far fa-thumbs-up "></i> {{ count($post->goods) }}</span>
                   </div>
               </div>
               @empty
               <h5 class="text-center py-5 my-5">投稿はありません</h5>
               @endforelse
           </div>
       </div>
       <div id="comments" class="tab-pane">
           <div class="card-body bg-white">
               @forelse ($comments as $comment)
               <div class="card mb-2">
                   <div class="card-header">
                       @isset ($comment->user->user_image)
                       <span>
                           <img class="user-image" src="{{ asset('storage/image/' . $comment->user->user_image) }}">
                       </span>
                       @endisset
                       <span>{{ Auth::user()->name }}</span>
                       <span class="float-right">{{ $comment->created_at }}</span>
                   </div>
                   <div class="card-body">
                       <div class="card-text">
                           <p>{!! nl2br(e($comment->comment)) !!}</p>
                       </div>
                       <div class="float-right">
                           <a href="{{ route('posts.show', $comment->post->id) }}" class="btn btn-primary">詳細</a>
                           <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary">編集</a>
                           <a href="#" class="btn btn-primary del" data-id="{{ $comment->id }}">削除</a>
                           <form method="post" action="{{ route('comments.destroy', $comment->id) }}" id="form_{{ $comment->id }}">
                               {{ csrf_field() }}
                               {{ method_field('delete') }}
                           </form>
                       </div>
                   </div>
               </div>
               @empty
               <h5 class="text-center py-5 my-5">コメントはありません</h5>
               @endforelse
           </div>
       </div>
   </div>
</section>
@endsection

