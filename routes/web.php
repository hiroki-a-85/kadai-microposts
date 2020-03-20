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

Route::get('/', function () {
    return view('welcome');
});

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//User情報の一覧表示(UsersController@index)
//User情報の詳細表示(UsersController@show)

//Route::group(['middleware' => ['auth']], function () { ログイン認証を確認させたいルーティング });
//ログイン「している」状態でルーティングが可能となる

//RESTfulルーティング基本形 - Route::resource('テーブル名','...Controller');
//['only' => ['index', 'show']] これで実装アクションの絞り込み
// GET URI:users Name:users.index Action:UsersController@index
// GET URI:users/{id} Name:users.show Action:UsersController@show 

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});