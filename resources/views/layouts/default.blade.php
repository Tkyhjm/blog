<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body>
        @if(Auth::Check())
       <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a href="{{ route('posts.index') }}" class="navbar-brand main-title">Enjoy Talk</a>
            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navmenu1"
                    aria-controls="navmenu1"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu1">
                <a href="{{ route('users.index') }}" class="nav-item nav-link">
                    @isset (Auth::user()->user_image)
                    <span><img class="user-image" src="{{ asset('storage/image/' . Auth::user()->user_image) }}"></span>
                    @endisset
                    {{ Auth::user()->name }} [マイページへ]
                </a>
                <a href="{{ route('posts.create') }}" class="nav-item nav-link post-create-link">新規投稿</a>
                <a href="#" id="logout" class="nav-item nav-link logout-link">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </nav>
        @endif
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 content_body">
                        <div class="card">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="/js/styles.js"></script>
    </body>
</html>
