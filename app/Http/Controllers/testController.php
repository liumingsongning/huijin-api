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
        $gateway->setSellerEmail('18610111139@163.com');
        $gateway->setPartner('2088921244662143');
        $gateway->setKey('adasu2lj6ydft0wy1jwx87v0oupf6frt');
        $gateway->setReturnUrl('https://api.huijinjiu.com/testreturn');
        $gateway->setNotifyUrl('https://api.huijinjiu.com/testnotify');
        return $gateway;
    }

    public function testAlipay(Request $request){
        $obj=$this->obj();

        $response = $obj->purchase([
            'out_trade_no' => $request->out_trade_no,
            'subject'      => 'test',
            'total_fee'    => $request->total_fee,
        ])->send();
        
        $response->redirect();;
    }


    public function alipayReturn()
    {
        $request = $this->obj()->completePurchase();
        $request->setParams($_REQUEST);

        try {
            /**
             * @var AopTradeAppPayResponse $response
             */
            $response = $request->send();
         
        
            if ($response->isPaid()) {

                /**
                 * Payment is successful
                 */
                // echo 'success'; //The notify response should be 'success' only

                echo 'success'; 


               


            } else {
                /**
                 * Payment is not successful
                 */
                die('fail'); //The notify response
            }
        } catch (Exception $e) {
            /**
             * Payment is not successful
             */
            die('fail'); //The notify response
        }
    }
    public function alipayNotify()
    {

        $request = $this->obj()->completePurchase();
        $request->setParams($_REQUEST);

        try {
            /**
             * @var AopTradeAppPayResponse $response
             */
            $response = $request->send();

          

          
            if ($response->isPaid()) {
                /**
                 * Payment is successful
                 */
                echo 'success'; //The notify response should be 'success' only
              

            } else {
                /**
                 * Payment is not successful
                 */
                die('fail'); //The notify response
            }
        } catch (Exception $e) {
            /**
             * Payment is not successful
             */
            die('fail'); //The notify response
        }
    }
}
