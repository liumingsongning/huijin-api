<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\V1\traits\order;
use DB;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    use order;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function topUpOrder(Request $request)
    {
        $amount = $request->amount;
        $payment_id = $request->payment_id;
        $uid = $this->uid;

        //创建user_account数据
        $create['process_type'] = SURPLUS_SAVE;
        $create['user_id'] = $uid;
        $create['payment_id'] = $payment_id;
        $create['payment'] = $this->getPayName($order['pay_id']);
        // $create['user_note']=$uid;
        $create['amount'] = $amount;
        $create['order_sn'] = $this->get_order_sn();

        //创建订单数据，
        $order['user_id'] = $this->uid;
        $order['add_time'] = time();
        $order['pay_name'] = $this->getPayName($order['pay_id']);
        $order['pay_id'] = $payment_id;
        $order['order_sn'] = $create['order_sn'];
        $order['order_amount'] = $amount;

        DB::beginTransaction();
        try {
            \App\Models\user_account::create($create);
            $create = \App\Models\order_info::create($order);

            DB::commit();
        } catch (QueryException $ex) {
            return $ex;
            DB::rollback();
            return $this->error('422', '订单添加失败');
        }

        //返回订单号
        return $this->response->array(['order' => $create]);
    }
    public function withdraw(Request $request)
    {

        $real_name = $request->real_name; //真实姓名

        $bank_name = $request->bank_name; //开户行

        $bank_account = $request->bank_account; //银行账户

        $mobile_phone = $request->mobile_phone; //开户行

        $user_note = $request->user_note; //留言

        $tx_info = "真实姓名:【" . $real_name . "】开户行:【" . $bank_name . "】银行账户:【" . $bank_account . "】手机:【" . $mobile_phone . "】留言:【" . $user_note . "】";

        /* 变量初始化 */

        $surplus = array(

            'user_id' => $user_id,

            'process_type' => 1,

            'user_note' => $tx_info,

        );

        DB::beginTransaction();

        try {
            $user_yishenqing = \App\Models\user_account::where('process_type', 1)
                ->where('is_paid', 0)
                ->where('user_id', $this->uid)->select('sum(amount)')->sharedLock()->first();

            $sur_amount = \App\User::where('id', $this->uid)->first()->sharedLock()->user_money;

            DB::commit();
        } catch (QueryException $ex) {

            DB::rollback();
            $this->error('422', '锁定失败');
        }

        $user_yishenqing = $user_yishenqing * -1;

        $all_amout = $amount + $user_yishenqing;

        if ($all_amout > $sur_amount) {

            $content = "申请提醒总金额大于自己的余额";
            $this->error('422', $content);

        }

        //插入会员账目明细

        $amount = '-' . $amount;

        $surplus['payment'] = '';
        $surplus['amount'] = $amount;

        $create = \App\Models\user_account::create($surplus);

        /* 如果成功提交 */

        if ($create) {

            return $this->response->array(['success' => 1]);

        } else {

            $this->error('422', '提交失败');

        }
    }
    public function accountDetail(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $accounts = \App\Models\account_log::where('user_id', $this->uid)
            ->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        $accounts->user_money = \App\User::where('id', $this->uid)->first()->user_money;
        if ($accounts->isNotEmpty()) {
            return $this->response->array(['data' => $accounts]);
        } else {
            $this->error('404', '未查找到该数据');
        }

    }
    public function apply_log(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $accounts = \App\Models\user_account::where('user_id', $this->uid)
            ->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        $accounts->user_money = \App\User::where('id', $this->uid)->first()->user_money;
        if ($accounts->isNotEmpty()) {
            return $this->response->array(['data' => $accounts]);
        } else {
            $this->error('404', '未查找到该数据');
        }
    }

    public function checkSurplus(Request $request)
    {
        $user_money = \App\User::where('id', $this->uid)->first()->user_money;
        if ($request->order_amount > $user_money) {
            $this->error('422', '余额不足');
        } else {
            $this->response->array(['success' => 1]);
        }
    }

    public function surplusPay(Request $request)
    {
        $order_sn = $request->order_sn;
        $order = \App\Models\order_info::where('order_sn', $order_sn)->first();

        if (!$order) {
            return $this->error('404', '未查询到该订单');
        }

        $user_money = \App\User::where('id', $this->uid)->first()->user_money;

        if ($order->order_amount > $user_money) {
            $this->error('422', '余额不足');
        }
        DB::beginTransaction();

        try {
            $order->order_status = OS_CONFIRMED;
            $order->save();
            $this->log_account_change($order->user_id, $order->order_amount * (-1), 0, 0, 0, sprintf(config('lang.pay_order'), $order_sn));
            DB::commit();
        } catch (QueryException $ex) {

            DB::rollback();
            $this->error('422', '支付失败');
        }

        $this->response->array(['success' => 1]);

    }
}
