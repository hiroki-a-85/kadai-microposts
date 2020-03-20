<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
    //ミドルウェアの設定
    //ルーティングからコントローラへ渡される前の事前確認条件を設定
    //__construct()アクション、$this->middleware('適用するミドルウェアの名前')
    // guest、つまりログイン「していない」ならOK（ログインページへ行ける）
    //app/Http/Kernel.phpの、protected $routeMiddlewareにて、
    //'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class
    //RedirectIfAuthenticatedにて、ログイン「している」時のリダイレクト先を設定
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
