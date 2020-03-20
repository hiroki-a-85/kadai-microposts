<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//ミドルウェア(コントローラーに渡される前の事前確認条件)
//そのリダイレクト先を設定
//ログインを「している」
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //「if (Auth::guard($guard)->check())」
        //ログインしている → true
        //その時のリダイレクト先を返す
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
