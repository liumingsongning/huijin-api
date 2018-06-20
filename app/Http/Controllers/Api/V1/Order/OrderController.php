<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\V1\traits\order;
use Cart;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use order;
    /**
     * @api {get} /order   order list
     * @apiGroup Order
     * @apiParam {string} page page.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "order": "$data"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Find
     *     {
     *       "message": "404 Not Found",
     *       "status_code": 404
     *     }
     */
    public function index()
    {
        $model = new \App\Models\order_info;
        $data=$model::with('order_goods')->where('user_id', $this->uid)->simplePaginate(15);
        if(!Empty($data)){
            return $this->response->array(['orders'=>$data]);
        }else{
            $this->error('404', '还没有数据');
        }
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
     * @api {get} /order/:id   order show
     * @apiGroup Order
     * @apiParam {string} id order id.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "order": "$data"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Find
     *     {
     *       "message": "404 Not Found",
     *       "status_code": 404
     *     }
     */
    public function show($id)
    {
        $model = new \App\Models\order_info;
        $data = $model::with('order_goods')->where('id', $id)->first();
        if ($data) {
            return $this->response->array($data);
        } else {
            throw $this->error('404', '未发现该订单');
        }
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
     * @api {delete} /order/:id delete order
     * @apiName delete order
     * @apiGroup Order
     *
     * @apiParam {string} id  order id.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "success": "1"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Access Denied
     *     {
     *       "message": 删除订单失败",
     *       "status_code": 422,
     *     }
     */
    public function destroy($id)
    {
        $model = new \App\Models\order_info;
        $order_goods_model = new \App\Models\order_goods;

        DB::beginTransaction();

        try {
            $order = $model::where('user_id', $this->uid)->where('id', $id)->first();

            $order_goods_model::where('order_id', $order->order_sn)->delete();

            $order->delete();

            DB::commit();
        } catch (QueryException $ex) {

            DB::rollback();
            return $this->error('422', '删除订单失败');
        }

        return $this->response->array(['success' => 1]);

    }
    /**
     * @api {post} /order/add add order
     * @apiName add order
     * @apiGroup Order
     *
     *
     * @apiParam {string} consignee 收件人.
     * @apiParam {string} email 邮件地址
     * @apiParam {string} country 国家码.
     * @apiParam {string} province 省码
     * @apiParam {string} city 城市码.
     * @apiParam {string} district 地区码
     * @apiParam {string} address 地址全文.
     * @apiParam {string} zipcode 邮政编码
     * @apiParam {string} tel 座机
     * @apiParam {string} mobile 手机
     * @apiParam {string} sign_building 标志建筑
     * @apiParam {string} best_time 最佳送货时间
     * @apiParam {arr} rowIds rowIds 商品id.
     * @apiParam {string} pay_id pay_id 支付宝是1，微信扫码支付是6，线下支付是8.
     * @apiParam {string} need_inv 是否需要发票，1是需要，0是不需要
     * @apiParam {string} inv_type 发票样式 '增值税专用发票(一般纳税人)' 或者 '普通发票'.
     * @apiParam {string} inv_payee 发票抬头
     * @apiParam {string} inv_content 发票内容.
     * @apiParam {string} referer 'pc站'
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "order": "添加的订单详情"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Access Denied
     *     {
     *       "message": "订单添加失败",
     *       "status_code": 422,
     *     }
     */
    public function add(Request $request)
    {
        $model = new \App\Models\order_info;

        $order = $request->all();
        $order['user_id'] = $this->uid;
        $order['add_time'] = time();
        $order['order_status'] = OS_UNCONFIRMED;
        $order['shipping_status'] = SS_UNSHIPPED;
        $order['pay_status'] = PS_UNPAYED;
        $sn = $order['order_sn'] = $this->get_order_sn();

        $rowIds = $request->rowIds;

        $goods_amount = 0;

        foreach ($rowIds as $value) {

            Cart::restore($this->uid);
            $goods_amount += Cart::get($value)->subtotal;
            Cart::store($this->uid);

        }

        $order['goods_amount'] = $order['order_amount'] = $goods_amount;

        unset($order['rowIds']);

        DB::beginTransaction();

        try {
            $create = $model::create($order);
            $this->addOrderGoods($rowIds, $order['order_sn']);

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('422', '订单添加失败');
        }

        return $this->response->array(['order' => $model]);

    }
    public function addOrderGoods($rowIds, $id)
    {
        $order_goods_model = new \App\Models\order_goods;

        foreach ($rowIds as $value) {

            Cart::restore($this->uid);
            $cart = Cart::get($value);
            Cart::store($this->uid);

            $model = $cart->model;

            $create['order_id'] = $id;
            $create['goods_id'] = $model->id;
            $create['goods_name'] = $model->goods_name;
            $create['goods_sn'] = $model->goods_sn;
            $create['goods_number'] = $cart->qty;
            $create['goods_price'] = $model->goods_price;
            $create['market_price'] = $model->market_price;
            $order_goods_model::create($create);

        }
    }
    // $order = array(
    //     // 'consignee'.
    //     // 'email' 邮件地址
    //     // 'country' 国家码.
    //     // 'province' 省码
    //     // 'city' 城市码.
    //     // 'district' 地区码
    //     // 'address' 地址全文.
    //     // 'zipcode' 邮政编码
    //     // 'tel' 座机
    //     // 'mobile' 手机
    //     // 'sign_building' 标志建筑
    //     // 'best_time' 最佳送货时间
    //     // 'shipping_id' => $request->shipping_id,
    //     // 'pay_id' => $request->pay_id,
    //     // 'pack_id' => $request->has('pack_id') ? $request->has('pack_id') : 0,
    //     // 'card_id' => $request->has('card_id') ? $request->has('card_id') : 0,
    //     // 'card_message' => '',
    //     // 'surplus' => $request->has('surplus') ? $request->has('surplus') : 0.00,
    //     // 'integral' => $request->has('integral') ? $request->has('integral') : 0,
    //     // 'bonus_id' => $request->has('bonus_id') ? $request->has('bonus_id') : 0,
    //     // 'need_inv' => $request->need_inv ? 0 : 1,
    //     // 'inv_type' => $request->inv_typ?$request->inv_typ:'',
    //     // 'inv_payee' => $request->inv_payee?$request->inv_payee:'',
    //     // 'inv_content' => $request->inv_content?$request->inv_content:'',
    //     // 'postscript' => $request->postscript?$request->postscript:'',
    //     // 'how_oos' => '',
    //     // 'need_insure' => 0,
    //     'user_id' => $this->uid,
    //     'add_time' => time(),
    //     'order_status' => OS_UNCONFIRMED,
    //     'shipping_status' => SS_UNSHIPPED,
    //     'pay_status' => PS_UNPAYED,
    //     // 'agency_id' => $request->agency_id,
    // );
}
