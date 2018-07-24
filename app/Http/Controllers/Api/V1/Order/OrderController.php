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
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $model = new \App\Models\order_info;

        $data = $model::with('order_goods')
            ->where('user_id', $this->uid)
            ->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        if (!empty($data)) {
            return $this->response->array(['orders' => $data]);
        } else {
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

            $order_goods_model::where('order_sn', $order->order_sn)->delete();

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
     * @apiParam {string} province 省码
     * @apiParam {string} city 城市码.
     * @apiParam {string} district 地区码
     * @apiParam {string} street 街道码
     * @apiParam {string} address 地址全文.
     * @apiParam {string} zipcode 邮政编码
     * @apiParam {string} tel 座机
     * @apiParam {string} mobile 手机
     * @apiParam {string} sign_building 标志建筑
     * @apiParam {string} best_time 最佳送货时间
     * @apiParam {arr} rowIds rowIds 商品id.
     * @apiParam {string} pay_id pay_id 支付宝是1，微信扫码支付是6，线下支付是8,余额支付是2.
     * @apiParam {string} need_inv 是否需要发票，1是需要，0是不需要
     * @apiParam {string} inv_type 发票样式 '增值税专用发票(一般纳税人)' 或者 '普通发票'.
     * @apiParam {string} inv_payee 发票抬头
     * @apiParam {string} inv_content 发票内容.
     * @apiParam {string} referer 'self_site'
     * @apiParam {string} cart_type 'shopping'or'buynow'
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
        $cart_type = $request->cart_type;

        $model = new \App\Models\order_info;

        $order = $request->all();
        $order['user_id'] = $this->uid;
        $order['add_time'] = time();
        $order['order_status'] = OS_UNCONFIRMED;
        $order['shipping_status'] = SS_UNSHIPPED;
        $order['pay_status'] = PS_UNPAYED;
        $order['referer'] = config('lang.' . $order['referer']);
        $order['pay_name'] = $this->getPayName($order['pay_id']);

        $sn = $order['order_sn'] = $this->get_order_sn();

        $rowIds = $request->rowIds;

        $goods_amount = 0;

        foreach ($rowIds as $value) {

            Cart::restore($this->uid . $cart_type);
            $goods_amount += Cart::get($value)->subtotal;
            Cart::store($this->uid . $cart_type);

        }

        $order['goods_amount'] = $order['order_amount'] = $goods_amount;

        unset($order['rowIds']);
        unset($order['cart_type']);

        DB::beginTransaction();

        try {
            $create = $model::create($order);
            $this->addOrderGoods($rowIds, $order['order_sn'], $cart_type);

            DB::commit();
        } catch (QueryException $ex) {
            return $ex;
            DB::rollback();
            return $this->error('422', '订单添加失败');
        }

        return $this->response->array(['order' => $create]);

    }
    public function addOrderGoods($rowIds, $sn, $cart_type)
    {
        $order_goods_model = new \App\Models\order_goods;

        foreach ($rowIds as $value) {

            Cart::restore($this->uid . $cart_type);
            $cart = Cart::get($value);
            Cart::store($this->uid . $cart_type);

            $model = $cart->model;

            $create['order_sn'] = $sn;
            $create['goods_id'] = $model->id;
            $create['goods_name'] = $model->goods_name;
            $create['goods_sn'] = $model->goods_sn;
            $create['goods_number'] = $cart->qty;
            $create['goods_price'] = $cart->price;
            $create['market_price'] = $model->market_price;
            if ($cart->options) {
                $products = \App\Models\product::where('goods_attr', json_encode($cart->options))->first();
                $atts = \App\Models\goods_attr::with('attribute')->whereIn('id', $cart->options)->get();
                $create['product_id'] = $products->id;
                $create['goods_attr_id'] = json_encode($cart->options);
                $goods_attrs = '';
                foreach ($atts as $key => $value) {
                    $goods_attrs .= $value->attribute->attr_name . ':' . $value->attr_value . '    ';
                }
                $create['goods_attr'] = $goods_attrs;
            }
            $order_goods_model::create($create);

        }
    }
    private function getPayName($pay_id)
    {
        return \App\Models\payment::where('id', $pay_id)->first()->pay_name;
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
    public function orderGoodgetUniqueGood(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $order_good_id = $request->order_good_id;
        $data = \App\Models\order_join_unique::with('unique_good')->where('order_good_id', $order_good_id)
            ->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        if (!empty($data)) {
            return $this->response->array(['orders' => $data]);
        } else {
            $this->error('404', '还没有数据');
        }
    }
    /**
     * @api {post} /order/addSecondHand addSecondHand
     * @apiName addSecondHand
     * @apiGroup Order
     *
     *
     * @apiParam {string} consignee 收件人.
     * @apiParam {string} email 邮件地址
     * @apiParam {string} province 省码
     * @apiParam {string} city 城市码.
     * @apiParam {string} district 地区码
     * @apiParam {string} street 街道码
     * @apiParam {string} address 地址全文.
     * @apiParam {string} zipcode 邮政编码
     * @apiParam {string} tel 座机
     * @apiParam {string} mobile 手机
     * @apiParam {string} sign_building 标志建筑
     * @apiParam {string} best_time 最佳送货时间
     * @apiParam {arr} unique_good_id unique_good_id 商品id.
     * @apiParam {arr} unique_good_market_id unique_good_market_id 二手市场id.
     * @apiParam {string} pay_id pay_id 支付宝是1，微信扫码支付是6，线下支付是8,余额支付是2
     * @apiParam {string} referer 'self_site'
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
    public function addSecondHand(Request $request)
    {
        $model = new \App\Models\order_info;

        $order = $request->all();
        $order['user_id'] = $this->uid;
        $order['add_time'] = time();
        $order['order_status'] = OS_UNCONFIRMED;
        $order['shipping_status'] = SS_UNSHIPPED;
        $order['pay_status'] = PS_UNPAYED;
        $order['referer'] = config('lang.' . $order['referer']);
        $order['pay_name'] = $this->getPayName($order['pay_id']);
        $order['is_second_hand'] = 1;

        $sn = $order['order_sn'] = $this->get_order_sn();
        
        $unique_good_market_id=$request->unique_good_market_id;

        $unique_good_market=\App\Models\unique_good_market::where('id',$unique_good_market_id)->first();

        $order['goods_amount'] = $order['order_amount'] = $unique_good_market->price;

        DB::beginTransaction();

        try {
            $create = $model::create($order);
            $good=$this->addSecondHandOrderGoods($request->unique_good_id, $order['order_sn'],$unique_good_market);

            DB::commit();
        } catch (QueryException $ex) {
            return $ex;
            DB::rollback();
            return $this->error('422', '订单添加失败');
        }

        \App\Models\order_join_unique::where('id',$good->id)->update(['unique_good_id'=>$request->unique_good_id]);

        return $this->response->array(['order' => $create]);

    }
    public function addSecondHandOrderGoods($unique_good_id, $order_sn,$unique_good_market)
    {
        $unique_good=\App\Models\unique_good::where('id',$unique_good_id)->first();
        $create['order_sn'] = $order_sn;
        $create['goods_id'] = $unique_good->id;
        $create['goods_name'] = $unique_good->goods_name;
        $create['goods_sn'] = $unique_good->goods_sn;
        $create['goods_number'] =1;
        $create['goods_price'] = $unique_good_market->price;
        $create['market_price'] =$unique_good_market->price;
       
        $create['product_id'] = $unique_good->product_id;
        $create['goods_attr_id'] = $unique_good->goods_attr_id;
        
        $create['goods_attr'] = $unique_good->goods_attr;
        
        $create['unique_good_market_id'] = $unique_good_market->id;
        $order_goods_model = new \App\Models\order_goods;
        $data=$order_goods_model::create($create);

        $unique_good_market->status=UNI_AWAIT_PAY;
        $unique_good_market->save();

        return $data;
    }
}
