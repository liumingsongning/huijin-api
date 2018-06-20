<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_info extends Model
{
    protected $guarded = [
        'id',
    ];
    public function order_goods(){
        return $this->hasMany('\App\Models\order_goods','order_id','order_sn');
    }
}
