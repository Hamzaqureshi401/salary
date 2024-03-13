<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Salarygeneration extends Model
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
   

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
   
   
    
}