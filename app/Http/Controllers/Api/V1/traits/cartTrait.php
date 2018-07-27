<?php
namespace App\Http\Controllers\Api\V1\traits;
use Omnipay\Omnipay;

trait cartTrait{
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
            if($row->options){ 
                $data['products']=\App\Models\product::find($row->options['product_id']);
                $data['atts']=\App\Models\goods_attr::with('attribute')->whereIn('id',json_decode($data['products']->goods_attr))->get();
               
            }
            $call[]=$data;
           

        }
        return $call;
    }
}