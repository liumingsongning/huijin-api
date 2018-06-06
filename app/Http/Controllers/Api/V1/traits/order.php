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

}
