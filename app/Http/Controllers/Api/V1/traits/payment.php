<?php
namespace App\Http\Controllers\Api\V1\traits;

trait payment
{
    use order;
    public function insert_pay_log($id, $amount, $type = PAY_ORDER, $is_paid = 0)
    {

        $modle = new \App\Models\pay_log;
        $modle->order_id = $id;
        $modle->order_amount = $amount;
        $modle->order_type = $type;
        $modle->is_paid = $is_paid;
        $modle->save();
       
        return $modle;

    }

    public function check_money($log_id, $money)
    {
        $amount = \App\Models\pay_log('id', $log_id)->first()->order_amount;
        return $money == $amount ? true : false;
    }

    public function order_paid($log_id, $pay_status = PS_PAYED, $note = '')
    {
        $log_id = intval($log_id);
        if ($log_id > 0) {
            /* 取得要修改的支付记录信息 */
            $pay_log = \App\Models\pay_log::where('id', $log_id)->first();
            
            if ($pay_log && $pay_log->is_paid == 0) {

                /* 修改此次支付操作的状态为已付款 */
                $pay_log->is_paid=1;
                $pay_log->save();
                /* 根据记录类型做相应处理 */
                if ($pay_log->order_type== PAY_ORDER) {
                    /* 取得订单信息 */
                    $order=\App\Models\order_info::where('id',$pay_log->order_id)->first();

                    /* 修改订单状态为已付款 */
                    $order->order_status=OS_CONFIRMED;
                    $order->confirm_time=gmtime();
                    $order->pay_status=$pay_status;
                    $order->pay_time=gmtime();
                    $order->save();
                    /* 记录订单操作记录 */
                    $this->order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, $pay_status, $note, config('lang.buyer'));
                    /* 客户付款时给商家发送短信提醒 */

                } elseif ($pay_log->order_type== PAY_SURPLUS) {

                }}

        }
    }

}
