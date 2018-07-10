<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods_type extends Model
{
    public function orderAttr(){
        return $this->hasMany('\App\Models\attribute','type_id','id');
    }
}
