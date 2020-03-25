<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        //User::orderBy('id', 'desc')
        //User一覧表示をidカラムを基準に降順で取得
        //ページネーション(コントローラーでの記述)
        //orderBy()を使う場合は、::orderBy()->paginate(1ページの表示数)
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        //getでusers/idにアクセスされた場合の「取得表示処理」
        //User::find($id)により、idが渡された値のレコードを一つ取得
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        //Controller.phpで定義したcounts()関数を使用
        //引数に渡した$userのmicropost、follower、followingの数を連想配列の形で取得
        //それを連想配列データである$dataに加えている
        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
    //{id}のユーザがフォローしているユーザの一覧表示をする
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    //{id}のユーザをフォローしているユーザ一覧を表示する
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $favorites,
        ];

        $data += $this->counts($user);

        return view('users.favorites', $data);
    }
}