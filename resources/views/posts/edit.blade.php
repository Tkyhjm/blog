@extends('layouts.default')


@section('title', '投稿編集')


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
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
                <label for="exampleInputEmail1">タイトル</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">画像(任意)</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>


            <div class="form-group">
                <label for="exampleControlSelect1">カテゴリ</label>
                <select class="form-control" id="exampleControlSelect1" name="type">
                    <option selected="">選択する</option>
                    <option value="0" 
                    @if ($post->type == 0)
                     selected
                    @endif
                    >一言</option>
                    <option value="1" 
                    @if ($post->type == 1)
                    selected
                    @endif
                    >日記</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">メッセージ</label>
                <textarea class="form-control" row="5" id="comment" name="content">{{ old('content', $post->content) }}</textarea>
            </div>

            <!--                user_idをvalueで持ってくる-->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>
</div>



@endsection