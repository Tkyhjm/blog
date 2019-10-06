@extends('layouts.default')


@section('title', '新規投稿')


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
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">タイトル<span class="attention">*30文字以内</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">画像(任意)</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>


            <div class="form-group">
                <label for="exampleControlSelect1">顔文字(表情)</label>
                <select class="form-control" id="exampleControlSelect1" name="type">
                    <option selected="">選択する</option>
                    <option value="far fa-smile-beam">スマイル</option>
                    <option value="far fa-surprise">サプライズ</option>
                    <option value="far fa-smile-wink">ウインク</option>
                    <option value="far fa-sad-tear">悲しい</option>
                    <option value="far fa-sad-cry">泣き</option>
                    <option value="far fa-meh">無表情</option>
                    <option value="far fa-tired">疲れ</option>
                    <option value="far fa-kiss-wink-heart">ラブ</option>
                    <option value="far fa-grin-squint-tears">笑い泣き</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">メッセージ<span class="attention">*150文字以内</span></label>
                <textarea class="textarea w-100" row="5" id="comment" name="content">{{ old('content') }}</textarea>
            </div>

            <!--                user_idをvalueで持ってくる-->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <button type="submit" class="btn btn-primary w-100 my-3">投稿</button>
        </form>
    </div>
</div>



@endsection