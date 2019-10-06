<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Follow;
use App\User;

class FollowController extends Controller
{
    // follow追加処理
    public function store(Request $request, $user)
    {
        $follow = new Follow();
        $follow->user_id = Auth::id();
        $follow->follow_user_id = $request->follow_user_id;
        $follow->save();
        
        // ユーザー詳細ページへリダイレクト
        return redirect()->route('users.show', ['user' => $user]);
        
    }
    
    // follow解除処理
    public function delete(Request $request, $user)
    {
        $follow = Follow::where('user_id', $request->user_id)->where('follow_user_id', $request->follow_user_id)->first();
        $follow->delete();

        // ユーザー詳細ページへリダイレクト
        return redirect()->route('users.show', ['user' => $user]);
    }
    
    // followユーザー一覧表示ページ
    public function follow($id)
    {
        
        $follows = Follow::where('user_id', $id)->get();
        $users = array();
        foreach($follows as $follow) {
            $users[] = User::where('id', $follow->follow_user_id)->first();
        }
        
        
        return view('follows.follow', ['users' => $users]);
    }
    
    public function follower($id)
    {
        //        フォローした人の情報取得
        $follows = Follow::where('follow_user_id', $id)->get();
        $users = array();
        foreach($follows as $follow) {
            $users[] = User::where('id', $follow->user_id)->first();
        }
        
        return view('follows.follower', ['users' => $users]);
    }
}
