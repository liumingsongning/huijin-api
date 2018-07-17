<?php
namespace App\Http\Controllers\Api\V1\traits;

trait user
{
    /**
     * 记录帐户变动
     * @param   int     $user_id        用户id
     * @param   float   $user_money     可用余额变动
     * @param   float   $frozen_money   冻结余额变动
     * @param   int     $rank_points    等级积分变动
     * @param   int     $pay_points     消费积分变动
     * @param   string  $change_desc    变动说明
     * @param   int     $change_type    变动类型：参见常量文件
     * @return  void
     */
    public function log_account_change($user_id, $user_money = 0, $frozen_money = 0, $rank_points = 0, $pay_points = 0, $change_desc = '', $change_type = ACT_OTHER)
    {
        /* 插入帐户变动记录 */
        $account_log = array(
            'user_id' => $user_id,
            'user_money' => $user_money,
            'frozen_money' => $frozen_money,
            'rank_points' => $rank_points,
            'pay_points' => $pay_points,
            'change_time' =>time(),
            'change_desc' => $change_desc,
            'change_type' => $change_type,
        );
        \App\Models\account_log::create($account_log);

        /* 更新用户信息 */
        \App\User::where('id',$user_id)->increment('user_money',$user_money);
    }

}
