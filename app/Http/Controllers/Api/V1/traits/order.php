<?php
namespace App\Http\Controllers\Api\V1\traits;

use Illuminate\Support\Facades\Redis;

trait order
{
    public function get_order_sn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        $sn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        /* 检查订单号是否重复 */
        $is_existed = \App\Models\order_info::where('order_sn',$sn)->first();
        if ($is_existed) {
            $this->get_order_sn();
        }

        return $sn;
    }

    public function order_action($order_sn, $order_status, $shipping_status, $pay_status, $note = '', $username = null, $place = 0){
        $order=\App\Models\order_info::where('order_sn',$order_sn)->first();

        $model=new \App\Models\order_action;

        $model->order_id=$order->id;
        $model->action_user=$username;
        $model->order_status=$order_status;
        $model->shipping_status=$shipping_status;
        $model->pay_status=$pay_status;
        $model->action_place=$place;
        $model->action_note=$note;
        $model->log_time=time();

        $model->save();
    }

}
