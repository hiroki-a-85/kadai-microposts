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

        return view('users.show', [
            'user' => $user,
        ]);
    }
}