@extends('layouts.defaultLogin')

@section('content')
<main class="top_image">
    <div class="container">
        <h1 class="display-1 main-title text-center py-5">Enjoy Talk</h1>
        <h2 class="text-center pb-4">ログイン</h2>
        @include('layouts.errors')
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary d-block mx-auto my-4 w-50">ログイン</button>
            </div>
        </form>
        <a class="btn btn-success d-block mx-auto w-50" href="{{ route('register') }}">新規登録はこちら</a>
    </div>
<main>
@endsection