<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //UserモデルとMicropostモデルの１対多の関係の記述
    //Userモデル側にも記述
    
    //function microposts() 複数形でメソッドを定義
    
    //return $this->hasMany(Micropost::class);
    //Userのインスタンスから、そのUserが持つMicropostsを、
    //$user->microposts()->get()、もしくは$user->micropostsという記述で取得できる
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
}
