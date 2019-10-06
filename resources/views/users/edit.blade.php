@extends('layouts.default')


@section('title', 'プロフィール編集')


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
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
                <label for="exampleInputEmail1">ユーザーID</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('title', $user->name) }}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">プロフィール画像</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="user_image">
            </div>

            <div class="form-group">
                <label for="message">メッセージ</label>
                <textarea class="form-control" row="5" id="message" name="message">{{ old('message', $user->message) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">プロフィール変更</button>
        </form>
    </div>
</div>



@endsection