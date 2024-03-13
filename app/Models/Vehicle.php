<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{   protected $fillable = [
        'status',
        'file_no', 
        'plate_no',
    ];
    use HasFactory;
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }
    public function assigning()
    {
        return $this->hasMany(VehicleAssigning::class,'vehicle_id','id');
    }
    public function maintainance()
    {
        return $this->hasMany(Maintainance::class,'vehicle_file_no','file_no');
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class,'vehicle_file_no','file_no');
    }


}
