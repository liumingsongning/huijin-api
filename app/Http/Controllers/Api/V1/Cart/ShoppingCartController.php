<?php

namespace App\Http\Controllers\Api\V1\Cart;

use Cart;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\traits\cartTrait;

class ShoppingCartController extends BaseController
{
    use cartTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd($this->uid);
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
     * @apiName addCart
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
       
        $good=\App\Models\good::find($request->good_id);

        try{

            Cart::restore($this->uid.'shopping');
            if($request->has('spe')){
                Cart::add($good,1, ['product_id'=>$request->spe])->associate('\App\Models\good');
            }else{
                Cart::add($good)->associate('\App\Models\good');
            }
            Cart::store($this->uid.'shopping');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);

        }catch (Exception $e){
            return $this->error('422','添加商品失败');
        }

    }
    public function plus(Request $request){
        $rowId=$request->rowId;
        try{

            Cart::restore($this->uid.'shopping');
            $num=Cart::get($rowId)->qty+1;
            Cart::update($rowId,$num);
            Cart::store($this->uid.'shopping');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);
        }catch (Exception $e){
            return $this->error('422','减少商品失败');
        }
    }
     /**
     * @api {post} /cart/minus minus cart
     * @apiName minusCart
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
       
       
        $rowId=$request->rowId;

        try{

            Cart::restore($this->uid.'shopping');
            $num=Cart::get($rowId)->qty-1;
            Cart::update($rowId,$num);
            Cart::store($this->uid.'shopping');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);
        }catch (Exception $e){
            return $this->error('422','减少商品失败');
        }
    }
     /**
     * @api {post} /cart/clear clear cart
     * @apiName clearCart
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
       
        try{

            Cart::restore($this->uid.'shopping');
            Cart::destroy();
            Cart::store($this->uid.'shopping');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);
        }catch (Exception $e){
            return $this->error('422','清空购物车失败');
        }
       
    }
      /**
     * @api {post} /cart/remove remove cart
     * @apiName removeCart
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
      
        try{

            Cart::restore($this->uid.'shopping');
            Cart::remove($request->rowId);
            Cart::store($this->uid.'shopping');

            return $this->response->array(['cart' =>$this->transform(Cart::content())]);

        }catch (Exception $e){
            return $this->error('422','移除商品失败');
        }
    }
     /**
     * @api {get} /cart/display display cart
     * @apiName displayCart
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
    public function display(){
        // dd($this->uid);
        try{

            Cart::restore($this->uid.'shopping');
            $cart=$this->transform(Cart::content());
            Cart::store($this->uid.'shopping');
            return $this->response->array(['cart' =>$cart]);

        }catch (Exception $e){
            return $this->error('404','未查询到该购物车');
        }
    }
      /**
     * @api {get} /cart/getAssign getAssign cart
     * @apiName getAssign
     * @apiGroup Cart
     *
     * @apiParam {arr} rowIds rowIds 商品id.
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

    public function getAssign(Request $request){

        $rowIds=$request->rowIds;
      
        $call=[];

        foreach ($rowIds as $value) {

            Cart::restore($this->uid.'shopping');
            $row =Cart::get($value);
            Cart::store($this->uid.'shopping');

            $data['rowId']=$row->rowId;
            $data['id']=$row->id;
            $data['name']=$row->name;
            $data['qty']=$row->qty;
            $data['price']=$row->price;
            $data['options']=$row->options;
            $data['tax']=$row->tax;
            $data['subtotal']=$row->subtotal;
            $data['model']=$row->model;
            if($row->options){ 
                $data['products']=\App\Models\product::where('goods_attr',json_encode($row->options))->first();
                $data['atts']=\App\Models\goods_attr::with('attribute')->whereIn('id',$row->options)->get();
               
            }

           $call[]=$data;
          

        }

        return  $this->response->array(['cart' =>$call]);

    }
    public function test(Request $request){
        $goods_amount=0;
    
        foreach ($request->rowIds as $key => $value) {
            Cart::restore($this->uid.'shopping');
            $goods_amount+=Cart::get($value)->subtotal;
            Cart::store($this->uid.'shopping'); 
        }

        dd($goods_amount);

    }
}
