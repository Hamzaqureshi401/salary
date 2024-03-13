<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{   protected $casts = [
    'date' => 'date', // Make sure this is set to date
];

    use HasFactory;
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }

    public function expensetype()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id','id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Companies::class,'company_id','id');
    }
    public function assigning()
    {
        return $this->belongsTo(VehicleAssigning::class,'assignment_id','id');
    }
}