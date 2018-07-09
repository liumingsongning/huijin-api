<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods_attr extends Model
{
    public function attribute(){
        return $this->belongsTo('\App\Models\attribute','attr_id','id');
    }
}
