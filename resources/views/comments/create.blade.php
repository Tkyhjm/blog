@extends('layouts.default')


@section('title', 'コメント投稿ページ')


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
        <form action="{{ route('comments.store', $post_id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="comment">コメント<span class="attention">*150文字以内</span></label>
                <textarea class="textarea w-100" row="5" id="comment" name="comment">{{ old('comment') }}</textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary w-100 my-2">コメントする</button>
        </form>
    </div>
</div>



@endsection