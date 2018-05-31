<?php
namespace App\Http\Controllers\Api\V1\traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

trait sendcode
{
    public function sendcode($phone)
    {
        $code=$this->makeCode();
        $client = new Client();
        $url = "http://sms-api.luosimao.com/v1/send.json";
        $response = $client->request('post',
            $url,
            ['auth' => ['api', config('services.luosimao.luosimao_sms_key')],
                'form_params' => ['mobile' => $phone, 'message' => '验证码：'.$code.'【铁壳测试】']]
        );
        $data = json_decode($response->getBody()->getContents());
     
        if($data->error==0){
            Redis::set($phone, $code, 'EX', 3000);
        }

        return $data;
       

        // $data=Redis::get($phone);

        
    }
    public function makeCode(){
        return  $code=rand(1000,9999);
    }

    public function checkCode($phone,$code){
        return $code==Redis::get($phone)?true:false;
    }

}
