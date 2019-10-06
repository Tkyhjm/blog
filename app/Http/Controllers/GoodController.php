<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Good;
use App\Post;

class GoodController extends Controller
{

    // good数追加処理
    public function store(Request $request, Post $post)
    {
        // goodsレコードの生成
        $good = new Good();
        $good->user_id = Auth::id();
        $good->post_id = $request->post_id;
        $good->save();
        
        return redirect()->route('posts.show', ['post' => $post, ]);
    }
    
    // good数削除処理
    public function delete(Request $request, Post $post)
    {
        // goodレコードの削除
        $good = Good::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        $good->delete();
        
        // 記事詳細ページへリダイレクト
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
