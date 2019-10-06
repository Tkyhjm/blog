<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ログイン後、ルーティングを許可
Route::group(['middleware' => 'auth'], function() {
    

    // ユーザー詳細情報作成ページ(新規登録後のみ、移動するページ)
    Route::get('users/create', 'UserController@create')->name('users.create');
    
    // followユーザーの記事一覧表示ページ
    Route::get('posts/follow', 'PostController@follow')->name('posts.follow');
    
    // 記事検索結果表示ページ
    Route::get('posts/search', 'PostController@search')->name('posts.search');
    
    Route::resource('posts', 'PostController');
    
    Route::resource('comments', 'CommentController');
    
    Route::resource('users', 'UserController');
    
    // follow追加処理
    Route::post('follows/{user}', 'FollowController@store')->name('follows.store');
    
    // follow解除処理
    Route::delete('follows/{user}', 'FollowController@delete')->name('follows.delete');
    
    // followユーザー一覧表示ページ
    Route::get('follows/follow/{id}', 'FollowController@follow')->name('follows.follow');
    
    // followerユーザー一覧表示ページ
    Route::get('follows/follower/{id}', 'FollowController@follower')->name('follows.follower');
    
    // good数追加処理
    Route::post('goods/{post}', 'GoodController@store')->name('goods.store');
    
    // good数削除処理
    Route::delete('goods/{post}', 'GoodController@delete')->name('goods.delete');
    

});


Auth::routes();
