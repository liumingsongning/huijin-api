<?php

namespace App\Http\Controllers\Api\V1\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Cart;

class BuyNowCartController extends BaseController
{
     /**
     * @api {get} /BuyNowCart/cart BuyNowCart get
     * @apiName BuyNowCart get
     * @apiGroup Cart
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "cart": "$cart"
     *     }
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Access Denied
     *     {
     *       "message": "未查询到该购物车",
     *       "status_code": 404,
     *     }
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

           Cart::restore($this->uid.'buynow');
           Cart::store($this->uid.'buynow');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);

        }catch (Exception $e){
            return $this->error('422','查找商品失败');
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
     * @api {post} /BuyNowCart/cart add cart
     * @apiName BuyNowCart add
     * @apiGroup Cart
     *
     * @apiParam {string} good_id good id.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "cart": "$cart"
     *     }
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Access Denied
     *     {
     *       "message": "添加商品失败",
     *       "status_code": 422,
     *     }
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $good=\App\Models\good::find($request->good_id);

        try{

           Cart::restore($this->uid.'buynow');
            Cart::destroy();
            Cart::add($good)->associate('\App\Models\good');
           Cart::store($this->uid.'buynow');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);

        }catch (Exception $e){
            return $this->error('422','添加商品失败');
        }
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

    public function transform($cart){
        $call=[];
        foreach($cart as $row){
           
            $data['rowId']=$row->rowId;
            $data['id']=$row->id;
            $data['name']=$row->name;
            $data['qty']=$row->qty;
            $data['price']=$row->price;
            $data['options']=$row->options;
            $data['tax']=$row->tax;
            $data['subtotal']=$row->subtotal;
            $data['model']=$row->model;
            $call[]=$data;

        }
        return $call;
    }               
}
