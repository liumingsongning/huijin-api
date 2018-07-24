<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_join_unique extends Model
{
    public function unique_good(){
        return $this->hasMany('\App\Models\unique_good','unique_good_id','id');
    }
    public function order_good(){
        return $this->belongsTo('\App\Models\order_goods','order_good_id','id');
    }
}
