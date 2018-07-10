<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    public function goods_attr(){
        return $this->hasMany('\App\Models\goods_attr','attr_id','id');
    }
}
