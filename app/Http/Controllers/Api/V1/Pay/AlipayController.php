<?php

namespace App\Http\Controllers\Api\V1\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Omnipay\Omnipay;

class AlipayController extends Controller
{
    public function payment(Request $request){
        
        $AlipayObj=$this->AlipayObj();

        $response = $AlipayObj->purchase([
            'out_trade_no' => $request->out_trade_no,
            'subject'      => 'test',
            'total_fee'    => $request->total_fee,
        ])->send();
        
        $response->redirect();;
    }
    public function AlipayObj(){
        $gateway = Omnipay::create('Alipay_LegacyExpress');
        $gateway->setSellerEmail('18610111139@163.com');
        $gateway->setPartner('2088921244662143');
        $gateway->setKey('adasu2lj6ydft0wy1jwx87v0oupf6frt');;
        $gateway->setReturnUrl('https://api.huijinjiu.com/return');
        $gateway->setNotifyUrl('https://api.huijinjiu.com/notify');
        return $gateway;
    }
}
