<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicleAssigning extends Model
{
     protected $fillable = [
        'status', // Add the 'status' attribute
    ];
    use HasFactory;
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }
   

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
   
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class,'assignment_id','id');
    }
    public function maintainance()
    {
        return $this->hasMany(Maintainance::class,'assignment_id','id');
    }

    
}