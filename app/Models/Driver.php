<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_no',
        'registration_date',
        'monthly_salary',
        'status',
    ];
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }
    public function assigning()
    {
        return $this->hasMany(VehicleAssigning::class,'driver_id','id')->orderBy('sort_id','asc');
    }
}
