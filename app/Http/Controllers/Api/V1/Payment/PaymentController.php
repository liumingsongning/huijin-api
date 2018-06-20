<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Api\V1\traits\alipay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class PaymentController extends Controller
{
    use alipay;
    /**
     * @api {get} 域名/alipay?order_id=订单order_id  支付宝支付接口
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
        // $order_id = $request->order_id;
        // $order = \App\Models\order_infos::where('id', $id)->first();
        // if (!$order) {
        //     return $this->error('404', '未查询到该订单');
        // }

        $obj = $this->getAlipayObj();
        $response = $obj->purchase([
            // 'out_trade_no' => $order->order_id,
            // 'subject' => '汇金酒业',
            // 'total_fee' => $order->order_amount,
            'out_trade_no' => $request->sn,
            'subject' => '汇金酒业',
            'total_fee' => 0.01,
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
            Log::error('测试return');
            Log::error($response->getData());
            if ($response->isPaid()) {
                
                /**
                 * Payment is successful
                 */
                die('success'); //The notify response should be 'success' only
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
            Log::error('测试notify');
            Log::error($response->getData());
            if ($response->isPaid()) {
                /**
                 * Payment is successful
                 */
                die('success'); //The notify response should be 'success' only
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
