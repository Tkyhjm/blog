<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // コメント投稿ページ
    public function create()
    {
        // テンプレートのhref=""内(リンク元)の第二引数で、$post_idが渡されてるので、クエリを受け取る
        $q = \Request::query();

        //  第二引数で、テンプレートから渡されたクエリ($q)の中からpost_idを変数として取り出す
        return view('comments.create', ['post_id' => $q['post_id']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  コメント作成処理
    public function store(CommentRequest $request)
    {

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->save();
        
        return redirect('/posts/' . $request->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  コメント編集ページ
    public function edit($id)
    {
        // comment_idからコメント情報を取得
        $comment = Comment::find($id);
        // usersとpostsテーブルと紐付け
        $comment->load('user', 'post');
        
        return view ('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  コメント編集(更新)処理
    public function update(Request $request, $id)
    {
        // comment_idからコメント情報を取得
        $comment = Comment::find($id);
        
        // 各項目の更新
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->save();
        
        // マイページへリダイレクト
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  コメントの削除処理
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        // マイページへリダイレクト
        return redirect()->route('users.index');
    }
}
