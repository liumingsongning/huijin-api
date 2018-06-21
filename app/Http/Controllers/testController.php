<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Controllers\Api\V1\traits\payment;

class testController extends Controller
{
    use payment;
    public function test(Request $request){
        // ini_set('date.timezone','PRC');
        // dd(4535);
        $id=$this->insert_pay_log(555, 8888, PAY_ORDER)->id;;
        dd($id);
        dd(date("Y-m-d H:i:s"));
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
        $gateway->setSellerEmail(config('alipay.SellerEmail'));
        $gateway->setPartner(config('alipay.Partner'));
        $gateway->setKey(config('alipay.Key'));;
        $gateway->setReturnUrl(config('alipay.ReturnUrl'));
        $gateway->setNotifyUrl(config('alipay.NotifyUrl'));
        return $gateway;
    }
}
