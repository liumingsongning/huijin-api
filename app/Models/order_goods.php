<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_goods extends Model
{
    protected $guarded = [
        'id',
    ];
    public function unique_good(){
        return $this->hasMany('\App\Models\order_join_unique','order_good_id','id');
    }
    public function order_info(){
        return $this->belongsTo('\App\Models\order_info','order_sn','order_sn');
    }
}
