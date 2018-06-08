<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
class SersocialiteController extends Controller
{
      /**
     * 重定向用户信息到 GitHub 认证页面。
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        // dd(new Socialite);
        return Socialite::driver($driver)->redirect();
    }

    /**
     * 获取来自 GitHub 返回的用户信息。
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        $user = Socialite::driver($driver)->user();
        dd($user);
        // $user->token;
    }
}
