<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_info extends Model
{
    protected $guarded = [
        'id',
    ];
    public function order_goods(){
        return $this->hasMany('\App\Models\order_goods','order_sn','order_sn');
    }

    public function unique()
    {
        return $this->hasManyThrough(
            'App\Models\order_join_unique', 
            '\App\Models\order_goods',
            'order_sn',
            'order_good_id',
            'order_sn'
        );
    }
}
