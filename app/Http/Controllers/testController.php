<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;

class testController extends Controller
{
    public function test(Request $request){

        $obj=$this->obj();

        $response = $obj->purchase([
            'out_trade_no' => $request->out_trade_no,
            'subject'      => 'test',
            'total_fee'    => $request->total_fee,
        ])->send();
        
        $response->redirect();;
    }
    public function obj(){
        $gateway = Omnipay::create('Alipay_LegacyExpress');
        $gateway->setSellerEmail('18610111139@163.com');
        $gateway->setPartner('2088921244662143');
        $gateway->setKey('adasu2lj6ydft0wy1jwx87v0oupf6frt');;
        $gateway->setReturnUrl('https://api.huijinjiu.com/return');
        $gateway->setNotifyUrl('https://api.huijinjiu.com/notify');
        return $gateway;
    }
}
