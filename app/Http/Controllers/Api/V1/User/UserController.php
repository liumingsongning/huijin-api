<?php

namespace App\Http\Controllers\APi\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userinfo(){
        return $this->response->array(['user'=>$request->user()]);
    }
}
