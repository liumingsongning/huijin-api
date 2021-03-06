<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_address extends Model
{
    protected $fillable=[
      'user_id',
      'consignee',
      'email',
      'street', 
      'province',
      'city', 
      'district', 
      'address', 
      'zipcode',
      'tel', 
      'mobile', 
      'sign_building', 
      'best_time' 
    ];
    protected $guarded = [
        'id',
    ];
}
