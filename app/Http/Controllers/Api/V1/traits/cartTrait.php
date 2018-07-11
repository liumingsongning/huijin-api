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
                $data['products']=\App\Models\product::where('goods_attr',json_encode($row->options))->first();
                $data['atts']=\App\Models\goods_attr::with('attribute')->whereIn('id',$row->options)->get();
               
            }
            $call[]=$data;
           

        }
        return $call;
    }
}