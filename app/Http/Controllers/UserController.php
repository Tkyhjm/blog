<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// ユーザー作成＆編集のバリデーション
use App\Http\Requests\UserRequest;
use App\User;
use App\Post;
use App\Comment;
use App\Follow;
use App\Good;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  マイページ(ユーザー情報詳細ページ)
    public function index()
    {
        // Auth_idからログインユーザー情報を取得
        $user = User::find(Auth::id())->get();

        // $user->load('posts', 'comments');
        
        // ログインユーザーの投稿全件取得
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(5);;
        // good数取得のため、紐付け
        $posts->load('goods');
        
        // ログインユーザーのコメント全件取得
        $comments = Comment::where('user_id', Auth::id())->get();
        
        // ログインユーザーのフォロー件数取得
        $follow_count = count(Follow::where('user_id', Auth::id())->get());
        // ログインユーザーのフォロワー件数取得
        $follower_count = count(Follow::where('follow_user_id', Auth::id())->get());
        
        return view('users.index', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'follow_count' => $follow_count, 'follower_count' => $follower_count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  ユーザー詳細情報作成ページ(新規登録後のみ、移動するページ)
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 各ユーザー詳細ページ
    public function show($id)
    {
//        ログインユーザーであった場合は、専用マイページに飛ぶ
        if ($id == Auth::id()) {
            
            // user.indexアクションと同様の処理
            $user = User::find(Auth::id())->get();
            // $user->load('posts', 'comments');

            $posts = Post::where('user_id', Auth::id())->get();
            $posts->load('goods');
            $comments = Comment::where('user_id', Auth::id())->get();
            
            $follow_count = count(Follow::where('user_id', $id)->get());
            $follower_count = count(Follow::where('follow_user_id', $id)->get());

            return view('users.index', ['user' => $user, 'posts' => $posts, 'comments' => $comments, 'follow_count' => $follow_count, 'follower_count' => $follower_count]);
              
        // ログインユーザー以外だった場合
        } else {
            
            // ユーザーIDからユーザー情報を取得
            $user = User::find($id);
            
            $user->load('posts', 'goods');
            
            //  $follow_checkがtrueならフォロー解除ボタン表示, falseならフォローするボタン表示
            if (Follow::where('user_id', Auth::id())->where('follow_user_id', $id)->first() !== null) {
                $follow_check = true;
            } else {
                $follow_check = false;
            }
             // ログインユーザーのフォロー件数取得
            $follow_count = count(Follow::where('user_id', $id)->get());
             // ログインユーザーのフォロワー件数取得
            $follower_count = count(Follow::where('follow_user_id', $id)->get());
            
            return view('users.show', ['user' => $user, 'follow_check' => $follow_check, 'follow_count' => $follow_count, 'follower_count' => $follower_count]);
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  ユーザー情報編集ページ表示
    public function edit($id)
    {
        // user_idからユーザー情報の取得
        $user = User::find($id);
        
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  ユーザー情報編集(更新)処理
    public function update(UserRequest $request, $id)
    {
        // user_idからユーザー情報の取得
        $user = User::find($id);

        // POST送信された項目を更新
        $user->name = $request->name;
        $user->message = $request->message;
        
        // 画像ファイルが添付されていたら画像を更新(画像は任意のため)
        $image = $request->file('user_image');
        if(isset($image)) {
            if ($image->isValid()) {
                $filename = $request->file('user_image')->store('public/image');
                $user->user_image = basename($filename);
            }
        }
        $user->save();
        
        // マイページへリダイレクト
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}