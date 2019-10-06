@extends('layouts.defaultLogin')


@section('title', 'ユーザー詳細登録')


@section('content')
<main class="user-create-page">
    <section>
       <div class="container text-center">
           <div id="fade-in-content">
               <p><img class="top-icon w-25 py-3" src="/storage/image/hands.png"></p>
               <h3 class="display-4 pb-3">WELCOME!!</h3>
           </div>
           <p>まずは画像アイコンとメッセージを登録しよう！</p>
           @include('layouts.errors')
       </div>
    </section>
    <section>
        <div class="container">
            <form method="post" action="{{ route('users.update', Auth::id()) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-group">
                    <label for="file">プロフィール画像</label>
                    <input type="file" class="form-control-file" id="file" name="user_image">
                </div>
                <div class="form-group">
                    <label for="message">プロフィールメッセージ<span class="ml-2 text-danger">*200文字以内</span></label>
                    <textarea class="textarea w-100" id="message" name="message"></textarea>
                </div>

                <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                <button type="submit" class="btn btn-primary d-block mx-auto mb-3 w-25">Let's Start!</button>
            </form>
            <p class="text-center">
                <a href="{{ route('posts.index') }}">あとで登録する</a>
            </p>
        </div>
    </section>
    <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</main>
@endsection
