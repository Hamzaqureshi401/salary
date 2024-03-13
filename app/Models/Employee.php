<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory;
      protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }

  

    // public function drivers()
    // {
    //     return $this->hasMany(Driver::class,'driver_id','id');
    // }

    // public function payments()
    // {
    //     return $this->hasMany(OrderPayment::class,'customer_id','id');
    // }
}
