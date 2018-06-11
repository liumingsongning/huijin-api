<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qq_user extends Model
{
    protected $fillable=[
        'qq_id',
        'ret',
        'msg',
        'nickname', 
        'gender',
        'province', 
        'city', 
        'year', 
        'figureurl',
        'figureurl_1', 
        'figureurl_2', 
        'figureurl_qq_1', 
        'figureurl_qq_2', 
        'is_yellow_vip', 
        'vip', 
        'yellow_vip_level', 
        'level', 
        'id_yellow_year_vip', 
      ];
}
