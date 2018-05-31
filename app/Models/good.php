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
        return $this->market_price;
    }
}
