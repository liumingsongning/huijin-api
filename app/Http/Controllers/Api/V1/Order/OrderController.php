<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\V1\traits\order;
use Illuminate\Http\Request;

class OrderController extends BaseController
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
    public function add(Request $request)
    {
        $request->good_id;
        $order = array(
            'shipping_id' => $request->shipping_id,
            'pay_id' => $request->shipping_id,
            'pack_id' => $request->has('pack_id') ? $request->has('pack_id') : 0,
            'card_id' => $request->has('card_id') ? $request->has('card_id') : 0,
            'card_message' => '',
            'surplus' => $request->has('surplus') ? $request->has('surplus') : 0.00,
            'integral' => $request->has('integral') ? $request->has('integral') : 0,
            'bonus_id' => $request->has('bonus_id') ? $request->has('bonus_id') : 0,
            'need_inv' => $request->need_inv ? 0 : 1,
            'inv_type' => $request->inv_typ?$request->inv_typ:'',
            'inv_payee' => $request->inv_payee,
            'inv_content' => $request->inv_content,
            'postscript' => $request->postscript,
            'how_oos' => '',
            'need_insure' => 0,
            'user_id' => $this->uid,
            'add_time' => time(),
            'order_status' => OS_UNCONFIRMED,
            'shipping_status' => SS_UNSHIPPED,
            'pay_status' => PS_UNPAYED,
            'agency_id' => $request->agency_id,
        );
        $sn = $order['order_sn'] = $this->get_order_sn();

        $data['goods_number'] = $request->goods_number;

        \App\Models\order_info::create($order);

    }
}
