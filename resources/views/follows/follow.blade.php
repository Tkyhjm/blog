@extends('layouts.default')


@section('title', 'フォローリスト')


@section('content')
<h3 class="text-center follow-title">フォロー数 {{ count($users) }}人</h3>
@if (count($users) > 0)
@foreach($users as $user)
<div class="card-body">
    <a class="text-decoration-none" href="{{ route('users.show', $user->id) }}">
        <div class="card p-4  follow-page-link">
           <div class="user-info">
               @isset ($user->user_image)
               <img class="follow-user-image ml-4" src="{{ asset('storage/image/' . $user->user_image) }}">
               @endisset
               <h5 class="user-name text-center">{{ $user->name }}</h5>
           </div>
            <p class="pt-3 h6">{!! nl2br(e($user->message)) !!}</p>
        </div>
    </a>
</div>
@endforeach
@endif
@endsection