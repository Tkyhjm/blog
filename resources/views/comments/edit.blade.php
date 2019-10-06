@extends('layouts.default')


@section('title', 'コメント編集ページ')


@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('comments.update', $comment->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea class="form-control" row="5" id="comment" name="comment">{{ old('comment', $comment->comment) }}</textarea>
            </div>

            <input type="hidden" name="post_id" value="{{ $comment->post->id }}">
                           
            <input type="hidden" name="user_id" value="{{ $comment->user->id }}">

            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>
</div>



@endsection