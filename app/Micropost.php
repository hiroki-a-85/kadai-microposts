<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    //UserモデルとMicropostモデルの１対多の関係の記述
    //一つのUserインスタンスに対して多のMicropostインスタンスの関係
    
    //function user() 単数形userでメソッドを定義
    
    //return $this->belongsTo(User::class);
    //この記述により、
    //Micropostインスタンスが所属しているUserインスタンスの情報を、
    //$micropost->user()->first、もしくは$micropost->userという記述で取得できるようになる
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //投稿をお気に入りに追加する機能
    //モデルに多対多の関係の記述→belongsToManyメソッド
    //第1引数に得る対象であるMicropostクラス、第2引数には中間テーブルであるfavorites
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
}
