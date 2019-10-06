@extends('layouts.defaultLogin')


@section('title', '新規登録')


@section('content')
<main class="top_image">
    <div class="container">
        <h1 class="display-1 main-title text-center py-5">Enjoy Talk</h1>
        <h2 class="text-center pb-4">新規登録</h2>
        @include('layouts.errors')
        <form action="{{ route('register') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password-confirm">パスワード(確認)</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success d-block mx-auto my-4 w-50">新規登録</button>
            </div>
        </form>
        <a class="btn btn-primary d-block mx-auto w-50" href="{{ route('login') }}">ログインはこちら</a>
    </div>
<main>
@endsection