<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PartsType extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }

    public function maintainance()
    {
        return $this->hasMany(maintainance::class,'parts_type_id','id')->orderBy('sort_id','asc');
    }
}
