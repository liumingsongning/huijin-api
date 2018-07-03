<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use Helpers;

    protected $uid='123';
    function __construct(Request $request){
        $this->middleware(function ($request, $next) {
          
            if($request->user()){
                $this->uid=$request->user()->id;
            }

            return $next($request);
        });
    } 
    public $nameSpace='\Symfony\Component\HttpKernel\Exception';
    // Dingo\Api\Exception\DeleteResourceFailedException 422
    // Dingo\Api\Exception\ResourceException 422
    // Dingo\Api\Exception\StoreResourceFailedException 422
    // Dingo\Api\Exception\UpdateResourceFailedException 422

    // Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException     403
    // Symfony\Component\HttpKernel\Exception\BadRequestHttpException     400
    // Symfony\Component\HttpKernel\Exception\ConflictHttpException     409
    // Symfony\Component\HttpKernel\Exception\GoneHttpException     410
    // Symfony\Component\HttpKernel\Exception\HttpException     500
    // Symfony\Component\HttpKernel\Exception\LengthRequiredHttpException     411
    // Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException     405
    // Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException     406
    // Symfony\Component\HttpKernel\Exception\NotFoundHttpException     404
    // Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException     412
    // Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException     428
    // Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException     503
    // Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException     429
    // Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException     401
    // Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException     415
    
    public function makeError($error,$msg){
        $str='\Symfony\Component\HttpKernel\Exception\\'.$error;
        throw new $str($msg);
    }
    public function error($code,$msg)
    {
        switch ($code) {
            case '400':
                $error='BadRequestHttpException';
                break;
            case '401':
                $error='UnauthorizedHttpException';
                break;
            case '403':
                $error='AccessDeniedHttpException';
                break;
            
            case '404':
                $error='NotFoundHttpException';
                break;
            
            case '405':
                $error='MethodNotAllowedHttpException';
                break;
            
            case '406':
                $error='NotAcceptableHttpException';
                break;
            
            case '409':
                $error='ConflictHttpException';
                break;
            case '410':
                $error='GoneHttpException';
                break;
            case '411':
                $error='LengthRequiredHttpException';
                break;
            
            case '412':
                $error='PreconditionFailedHttpException';
                break;
            
            case '415':
                $error='UnsupportedMediaTypeHttpException';
                break;
            
            case '428':
                $error='PreconditionRequiredHttpException';
                break;
            case '429':
                $error='TooManyRequestsHttpException';
                break;
            case '500':
                $error='HttpException';
                break;
            
            case '503':
                $error='ServiceUnavailableHttpException';
                break;
            
            case '422':
                throw new \Dingo\Api\Exception\DeleteResourceFailedException($msg);
                break;
            
            default:
                $error='HttpException';
                break;
        }
        $this->makeError($error,$msg);
    }
}
