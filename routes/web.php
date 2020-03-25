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

//MicropostsControllerのindexアクションを経由してwelcomeを表示
Route::get('/', 'MicropostsController@index');

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

//ログイン「している」状態でルーティング可能とするRoute::groupにルーティングを追加
//Micropostsの、登録storeと削除destroyのみ
// POST URI:microposts Name:microposts.store Action:MicropostsController@store
// DELETE URI:microposts/{id} Name:microposts.destroy Action:MicropostsController@destroy 

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    //Route::group(['prefix' => 'users/{id}'], function () {...});
    //このグループ内のルーティングのURLの最初に/users/{id}を付与する
    //ex. POST /users/{id}/follow など
    Route::group(['prefix' => 'users/{id}'], function () {
        //{id}のユーザをフォローする
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        //{id}のユーザをアンフォローする
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        //{id}のユーザがフォローしているユーザの一覧表示をする
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        //{id}のユーザをフォローしているユーザ一覧を表示する
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        //{id}のユーザのお気に入り投稿を一覧表示する
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
    });
    
    Route::group(['prefix' => 'microposts/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});

