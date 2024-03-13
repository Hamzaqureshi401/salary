<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $casts = [
        'data' => 'array',
    ];
    protected $fillable = [
        'name',
        'data',
        'is_active',
        'default',
        'is_rtl',
        'image'
    ];

    public function photo()
    {
        if($this->image && file_exists(public_path($this->image)))
        {
            return asset($this->image);
        }
    }
}
