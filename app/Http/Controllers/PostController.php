<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// 記事投稿＆編集のバリデーション
use App\Http\Requests\PostRequest;
use App\Post;
use App\Follow;
use App\User;
use App\Good;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  投稿一覧ページ
    public function index()
    {
        // 投稿一覧を表示
        $posts = Post::latest()->paginate(5);
        // 各投稿にユーザー情報とgood数を表示するため、リレーション
        // (各modelファイルで結合処理をしている)
        $posts->load('user', 'goods');
        
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  記事投稿ページ
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 記事作成処理
    public function store(PostRequest $request)
    {
        // postsテーブルにpostで送信された各カラムの値を追加
        $post = new Post();
        $post->title = $request->title;
        $post->type = $request->type;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        
        // 画像ファイルが添付されていたら画像を追加(画像は任意項目のため)
        $image = $request->file('image');
        if(isset($image)) {
            if ($image->isValid()) {
                $filename = $request->file('image')->store('public/image');
                $post->image = basename($filename);
            }
        }
        // 追加内容を保存
        $post->save();
        
        // 記事一覧ページへリダイレクト
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  記事詳細ページ表示
    public function show(Post $post)
    {
        // goodボタンの表示切り替え
        if (Good::where('user_id', Auth::id())->where('post_id', $post->id)->first() !== null) {
            $good_check = true;
        } else {
            $good_check = false;
        }
        
        // 各記事のユーザー情報・コメント一覧・good数表示のため、リレーション
        $post->load('user', 'comments', 'goods');
        
        return view('posts.show', ['post' => $post, 'good_check' => $good_check]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 記事編集ページ表示
    public function edit($id)
    {
        // post_idを元に、記事情報取得
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  記事編集(更新)処理
    public function update(PostRequest $request, $id)
    {
        // post_idを元に、記事情報取得
        $post = Post::find($id);

        // postsテーブルにpostで送信された各カラムの値を更新
        $post->title = $request->title;
        $post->type = $request->type;
        $post->content = $request->content;
        $post->user_id = $request->user_id;

        // 画像ファイルが添付されていたら画像を追加(画像は任意項目のため)
        $image = $request->file('image');
        if(isset($image)) {
            if ($image->isValid()) {
                $filename = $request->file('image')->store('public/image');
                $post->image = basename($filename);
            }
        }
        $post->save();
        
        // ユーザー詳細画面にリダイレクト
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  記事削除処理 引数の(Post $post)でpost_idを元にpost情報取得
    public function destroy(Post $post)
    {
        // 対象レコード削除
        $post->delete();

        // ユーザー詳細画面にリダイレクト
        return redirect()->route('users.index');
    }
    
    // 記事一覧ページの検索処理
    public function search(Request $request)
    {
        // タイトルもしくは文章の中から、検索文字列と部分一致する記事を取得する
        $posts = Post::where('title', 'like', "%{$request->search}%")
            ->orWhere('content', 'like', "%{$request->search}%")
            ->latest()->paginate(5);

        // 検索結果の表示件数を出力する
        $search_result = $request->search . 'の検索結果' . $posts->total() . '件';

        return view('posts.index', ['posts' => $posts, 'search_result' => $search_result, 'search_query' => $request->search]);
    }
    
    // followユーザーの記事一覧表示ページ
    public function follow()
    {
        // follows, users, postsの3テーブルを結合して、フォローしているユーザーの記事全件を取得
        //        リレーションがうまくいかないため、DBクラスで対応
        $follow_posts = DB::table('follows')
            ->join('users', 'users.id', '=', 'follows.follow_user_id')
            ->join('posts', 'posts.user_id', '=', 'follows.follow_user_id')
            ->where('follows.user_id', '=', Auth::id())
            ->latest()->paginate(5);
        
        
        return view('posts.follow', ['follow_posts' => $follow_posts]);
    }
}
