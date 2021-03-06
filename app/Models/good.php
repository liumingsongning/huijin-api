<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class good extends Model implements Buyable
{
    public function getBuyableIdentifier($options = NULL){
        return $this->id;
    }

    public function getBuyableDescription($options = null){
        return $this->goods_name;
    }

    public function getBuyablePrice($options = null){
        if($options){
            $price=$this->market_price;
            $suk=\App\Models\product::find($options['product_id'])->goods_attr;
            $attrs=\App\Models\goods_attr::where('goods_id',$this->id)->get();
            foreach (json_decode($suk) as $key => $value) {
                foreach ($attrs as $attr) {
                    if($attr->id==$value){
                        $price+=$attr->attr_price;
                    }
                }
                
                
            }
            return $price;
        }else{
            return $this->market_price;
        };
        
    }

    public function attrs(){
        return $this->hasMany('\App\Models\goods_attr','goods_id','id');
    }

    public function products(){
        return $this->hasMany('\App\Models\product','goods_id','id');
    }

    public function goods_type(){
        return $this->hasOne('\App\Models\goods_type','id','goods_type');
    }
}
