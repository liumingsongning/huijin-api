<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Api\V1\traits\alipay;
use App\Http\Controllers\Api\V1\traits\payment;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Log;

class PaymentController extends BaseController
{
    use alipay,payment;
    /**
     * @api {get} 域名/alipay?order_sn=订单order_sn?pay_type=1 支付宝支付接口 有pay_type表示余额支付
     * @apiGroup Payment
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Find
     *     {
     *       "message": "404 Not Found",
     *       "status_code": 404
     *     }
     */
    public function alipay(Request $request)
    {
        $order_sn = $request->order_sn;
        $order = \App\Models\order_info::where('order_sn', $order_sn)->first();
      
        
        if (!$order) {
            return $this->error('404', '未查询到该订单');
        }

        $order_type=$request->has('pay_type')?PAY_SURPLUS:PAY_ORDER;

        $log_id = $this->insert_pay_log($order->id, $order->order_amount, $order_type)->id;

        $obj = $this->getAlipayObj();
        $response = $obj->purchase([
            'out_trade_no' => $order->order_sn . $log_id,
            'subject' => $order->order_sn,
            'total_fee' => $order->order_amount,
            // 'out_trade_no' => $request->sn,
            // 'subject' => '汇金酒业',
            // 'total_fee' => 0.01,
        ])->send();

        $response->redirect();
    }
    public function alipayReturn()
    {
        $request = $this->getAlipayObj()->completePurchase();
        $request->setParams($_REQUEST);

        try {
            /**
             * @var AopTradeAppPayResponse $response
             */
            $response = $request->send();
         
            $data = $response->getData();

            $order_sn = str_replace($data['subject'], '', $data['out_trade_no']);
            $order_sn = trim(addslashes($order_sn));

            if ($response->isPaid()) {

                /**
                 * Payment is successful
                 */
                // echo 'success'; //The notify response should be 'success' only

                if (!$this->check_money($order_sn, $data['total_fee'])) {
                    return redirect()->away(config('app.front_url').'/paycallback?type=alipay&error=1');
                }

                $this->order_paid($order_sn);

                return redirect()->away(config('app.front_url').'/paycallback?type=alipay&success=1');


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

        $request = $this->getAlipayObj()->completePurchase();
        $request->setParams($_REQUEST);

        try {
            /**
             * @var AopTradeAppPayResponse $response
             */
            $response = $request->send();

            $data = $response->getData();

            $order_sn = str_replace($data['subject'], '', $data['out_trade_no']);
            $order_sn = trim(addslashes($order_sn));
          
            if ($response->isPaid()) {
                /**
                 * Payment is successful
                 */
                echo 'success'; //The notify response should be 'success' only
                if (!$this->check_money($order_sn, $data['total_fee'])) {
                    return false;
                }

                $this->order_paid($order_sn);

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
