<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    const CASH = 1;
    const CARD = 2;
    const CHEQUE =3;
    const BANK_TRANSFER = 4;

    
}
