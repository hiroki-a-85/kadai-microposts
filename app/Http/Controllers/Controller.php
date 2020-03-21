<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //micropostの数のカウントを表示するために実装
    //Controllerに対して実装するため、全てのコントローラでcounts()が使用できる
    public function counts($user) {
        $count_microposts = $user->microposts()->count();

        return [
            'count_microposts' => $count_microposts,
        ];
    }
}
