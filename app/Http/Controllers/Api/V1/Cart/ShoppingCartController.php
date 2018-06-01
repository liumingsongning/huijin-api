<?php

namespace App\Http\Controllers\Api\V1\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Http\Controllers\Api\BaseController;

class ShoppingCartController extends BaseController
{
    function __construct(Request $request){
        // $uid=$this->auth->user();
        // 
    } 
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
     /**
     * @api {post} /cart/add add cart
     * @apiName Cart
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
    public function add(Request $request){
        $good_id=$request->good_id;
        $uid=$this->auth->user()->id;
        $good=\App\Models\good::find($good_id);

        try{

            Cart::restore($uid);
            Cart::add($good);
            Cart::store($uid);

            return $this->response->array(['cart' =>Cart::content()]);

        }catch (Exception $e){
            return $this->error('422','添加商品失败');
        }

       
        return Cart::content();
    }
     /**
     * @api {post} /cart/minus minus cart
     * @apiName Cart
     * @apiGroup Cart
     *
     * @apiParam {string} rowId row id.
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
     *       "message": "减少商品失败",
     *       "status_code": 422,
     *     }
     */
    public function minus(Request $request){
        $uid=$this->auth->user()->id;
       
        $rowId=$request->rowId;

        try{

            Cart::restore($uid);
            $num=Cart::get($rowId)->qty-1;
            Cart::update($rowId,$num);
            Cart::store($uid);

            return $this->response->array(['cart' =>Cart::content()]);
        }catch (Exception $e){
            return $this->error('422','减少商品失败');
        }
    }
     /**
     * @api {post} /cart/clear clear cart
     * @apiName Cart
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
     *       "message": "清空购物车失败",
     *       "status_code": 422,
     *     }
     */
    public function clear(){
        $uid=$this->auth->user()->id;
        try{

            Cart::restore($uid);
            Cart::destroy();
            Cart::store($uid);

            return $this->response->array(['cart' =>Cart::content()]);
        }catch (Exception $e){
            return $this->error('422','清空购物车失败');
        }
       
    }
      /**
     * @api {post} /cart/remove remove cart
     * @apiName Cart
     * @apiGroup Cart
     *
     * @apiParam {string} rowId row id.
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
     *       "message": "移除商品失败",
     *       "status_code": 422,
     *     }
     */
    public function remove(Request $request){
        $uid=$this->auth->user()->id;
        $rowId=$request->rowId;
        try{

            Cart::restore($uid);
            Cart::remove($rowId);
            Cart::store($uid);

            return $this->response->array(['cart' =>Cart::content()]);

        }catch (Exception $e){
            return $this->error('422','移除商品失败');
        }
    }
}
