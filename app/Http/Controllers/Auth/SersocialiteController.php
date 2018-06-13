<?php

namespace App\Http\Controllers\Auth;

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

        if ($driver == 'qq') {

            $model = new \App\Models\qq_user;

            if ($qq = $this->findQq($user->id)) {

                if ($qq->uid) {

                    $login_user = \App\User::find($qq->uid);

                    return redirect()->away('http://test.huijinjiu.com:8080/find_user?token=' . JWTAuth::fromUser($login_user));

                } else {
                   
                    return redirect()->away('http://test.huijinjiu.com:8080/bind?type=qq&oauth_id=' . $user->id);

                }

            } else {

                $qq_user = $user->user;
                $qq_user['qq_id'] = $user->id;
                $model->fill($qq_user);
                $model->save($qq_user);
               
                return redirect()->away('http://test.huijinjiu.com:8080/bind?type=qq&qq_id=' . $user->id);
            }
        }
        // $user->token;
    }
    private function findQq($id)
    {
        return \App\Models\qq_user::where('qq_id', $id)->first();
    }
}
