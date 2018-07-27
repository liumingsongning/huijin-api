<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unique_good_market extends Model
{
    public function unique_good(){
        return $this->hasOne('\App\Models\unique_good','id','unique_good_id');
    }
    protected $guarded = [
        'id',
    ];
}
