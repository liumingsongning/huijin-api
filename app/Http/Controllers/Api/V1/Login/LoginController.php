<?php
namespace App\Http\Controllers\Api\V1\Login;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\V1\traits\sendcode;
use JWTAuth;
use Lshorz\Luocaptcha\Facades\LCaptcha;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    use sendcode;
    /**
     * @api {post} /checkcaptcha checkcaptcha
     * @apiName checkcaptcha
     * @apiGroup Login
     *
     * @apiParam {string} phone User phone.
     * @apiParam {string} captcha luosimao captcha.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "success": "1"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Access Denied
     *     {
     *       "message": "人机验证失败",
     *       "status_code": 400,
     *     }
     */
    public function checkcaptcha(Request $request)
    {
        // $this->error('400','人机验证失败');
        $res = LCaptcha::verify($request->captcha);
     
        if ($res) {
            return $this->response->array(['success' => 1]);
        } else {
            $this->error('400','人机验证失败');
        }

    }
    /**
     * @api {post} /sendcode sendcode
     * @apiName sendcode
     * @apiGroup Login
     *
     * @apiParam {string} phone User phone.
     * @apiParam {string} captcha luosimao captcha.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "success": "1"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     *     HTTP/1.1 403 Access Denied
     *     {
     *       "message": "错误消息提示",
     *       "status_code": 403,
     *     }
     */
    public function sendPhoneCode(Request $request)
    {
     
        $data = $this->sendcode($request->phone);

        if ($data->error == 0) {
            return $this->response->array(['success' => 1]);
        } else {
            $this->error('403', $data->msg);
        };

    }
    /**
     * @api {post} /login login
     * @apiName Login
     * @apiGroup Login
     *
     * @apiParam {string} phone User phone.
     * @apiParam {string} code code
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "token": "$token"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 403 Access Denied
     *     {
     *       "message": "验证码不正确",
     *       "status_code": 403,
     *     }
     */
    public function login(Request $request)
    {
        $phone=$request->phone;
        // Hash::make('password')
        if ($this->checkCode($request->phone, $request->code)) {
            $user = \App\User::where('phone',$phone)->first();
            if(!$user){
                $user=\App\User::create(['phone'=>$phone,'name'=>$phone]);
            }   
            return $this->response->array(['token' =>JWTAuth::fromUser($user)]);
        } else {
            $this->error('403', '验证码不正确');
        };
    }
    public function index()
    {
        // $good=\App\models\good::find(1);
        // Cart::add($good);
        // Cart::add($good);
        Cart::restore('liuming');
        return Cart::content();
        // throw new Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.');
        // return $this->response->errorNotFound();
        // return $this->auth->user();
        // throw new \Symfony\Component\HttpKernel\Exception\ConflictHttpException('User was updated prior to your request.');

        // return $this->response->errorNotFound();
        // return $user = JWTAuth::parseToken()->authenticate();
        // $user = \App\User::find(1);
        // return $this->response->item($user);
        // $token = JWTAuth::fromUser($user);
        // return $token;
    }

}
