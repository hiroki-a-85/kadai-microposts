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
}
