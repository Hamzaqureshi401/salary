<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    
    public function addons()
    {
        return $this->hasMany(OrderDetailAddon::class,'order_detail_id','id');
    }
}
