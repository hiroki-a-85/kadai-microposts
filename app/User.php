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
    
    //フォロー、フォロワー機能のための多対多の関係を記述
    
    //モデルが多対多の関係の時は中間テーブルを用意するが、今回はuser_followテーブルがそれ
    //中間テーブルのためのModelファイルは不要
    
    //belongsToManyメソッドを使用する
    //フォロー、フォロワー関係の場合、多対多の関係がどちらもUserに対するものなので、
    //どちらもUserのModelファイルに記述する
    
    //followings()の定義により、
    //$user->followingsで$userがフォローしているUser達を取得できる
    //第2引数に中間テーブルを指定、第3引数に中間テーブルでの自分のidを示すカラムを指定、
    //第4引数に中間テーブルでフォロー先のidを示すカラムを指定
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    //followers()の定義により、
    //$user->followersで$userをフォローしているUser達を取得できる
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    //フォロー、アンフォローできるようにするため、
    //follow()、unfollow()メソッドを定義
    //$user->follow($user_id)や$user->unfollow($user_id)というように使用できる
    
    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    //自分がフォローしたユーザの投稿も表示するタイムラインの表示機能
    //タイムライン用のマイクロポストを取得するためのメソッドを定義する
    public function feed_microposts()
    {
        //実行したユーザがフォローしているユーザのidの配列を取得している
        //$this->followings()によりフォローしているユーザ情報を取得
        //pluck('users.id')により、usersテーブルのidカラムの値だけを抜き出している
        //toArray()により配列に変換している
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        
        //自分をマイクロポストも表示させるため、自身のidも配列へ追加
        $follow_user_ids[] = $this->id;
        
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    //投稿をお気に入りに追加する機能
    //モデルに多対多の関係の記述→belongsToManyメソッド
    //第1引数に得る対象であるMicropostクラス、第2引数には中間テーブルであるfavorites
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    //現在のお気に入りの中に、$micropostIdがあるかどうか調べるメソッド
    public function is_adding_into_favorites($micropostId)
    {
        return $this->favorites()->where('micropost_id', $micropostId)->exists();
    }
    
    //現在の投稿したmicropostの中からidが$micropostIdのものがあるかどうか調べるメソッド
    public function is_my_micropost($micropostId)
    {
        return $this->microposts()->where('id', $micropostId)->exists();
    }
    
    //お気に入りに追加するメソッドfavorite($micropostId)を定義
    public function favorite($micropostId)
    {
        $exist_in_favorites = $this->is_adding_into_favorites($micropostId);
        
        $exists_in_my_microposts = $this->is_my_micropost($micropostId);
        
        if ($exist_in_favorites) {
            //お気に入りに追加していれば、何もしない
            return false;
        } elseif ($exists_in_my_microposts) {
            //自分の投稿であれば、何もしない
            return false;
        } else {
            //お気に入りになく、自分の投稿でもなければ、お気に入りに追加する
            $this->favorites()->attach($micropostId);
            return true;
        }
    }
    
    //お気に入りから外すメソッドunfavorite($micropostId)を定義
    public function unfavorite($micropostId)
    {
        //既にお気に入りに追加しているかの確認
        $exist = $this->is_adding_into_favorites($micropostId);
        
        if (!$exist) {
            //既にお気に入りに追加していなければ、何もしない
            return false;
        } else {
            //そうでなければ、お気に入りから外す
            $this->favorites()->detach($micropostId);
            return true;
        }
    }
}
