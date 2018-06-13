<?php

namespace App\Http\Controllers\APi\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;

class UserController extends BaseController
{
    public function userinfo(Request $request){
        return $this->response->array(['user'=>$request->user()]);
    }
}
