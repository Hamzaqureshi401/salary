<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    //Type Enums
    const DINING = 1;
    const TAKEAWAY = 2;
    const DELIVERY = 3;

    //Status Enums
    const PENDING = 0;
    const COOKING = 1;
    const READY = 2;
    const COMPLETED = 3;

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = Auth::user()->id;
        });
    }


    public function details()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class,'order_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function getOrderTypeStringAttribute()
    {
        $lang = null;
        if (session()->has('selected_language')) {   /*if session has selected language */
            $lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $lang = Translation::where('default', 1)->first();
        }
        if($lang == null)
        {
            switch($this->order_type){
                case 1: 
                    return 'Dining';
                case 2:
                    return 'Takeaway';
                case 3:
                    return 'Delivery';
            }
        }
        else{
            switch($this->order_type){
                case 1: 
                    return $lang->data['dining'] ?? 'Dining';
                case 2:
                    return $lang->data['takeaway'] ??  'Takeaway';
                case 3:
                    return $lang->data['delivery'] ?? 'Delivery';
            }
        }
      
        return '?';
    }

    public function getOrderTypeBadgeAttribute()
    {
        switch($this->order_type){
            case 1: 
                return 'bg-success';
            case 2:
                return 'bg-danger';
            case 3:
                return 'bg-secondary';
        }
        return '?';
    }

    public function OrderStatusString($status)
    {
        $lang = null;
        if (session()->has('selected_language')) {   /*if session has selected language */
            $lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $lang = Translation::where('default', 1)->first();
        }
        if($lang == null)
        {
            switch($status)
            {
                case 0:
                    return 'Pending';
                case 1:
                    return 'Cooking';
                case 2:
                    return 'Ready';
                case 3:
                    return 'Completed';
            }
        }
        else{
            switch($status)
            {
                case 0:
                    return $lang->data['pending'] ?? 'Pending';
                case 1:
                    return $lang->data['cooking'] ?? 'Cooking';
                case 2:
                    return $lang->data['ready'] ?? 'Ready';
                case 3:
                    return $lang->data['completed'] ?? 'Completed';
            }
        }
        return 'Unkown Status';
    }

    public function OrderStatusBadge($start,$status)
    {
        switch($status)
        {
            case 0:
                return $start.'-warning';
            case 1:
                return $start.'-bv';
            case 2:
                return $start.'-success';
            case 3:
                return $start.'-completed';
        }
        return 'Unkown Status';
    }

    public function getOrderStatusBackgroundAttribute()
    {
        switch($this->status)
        {
            case 0:
                return 'pending';
            case 1:
                return 'cooking';
            case 2:
                return 'ready';
        }
        return 'Unkown Status';
    }

    public function isPaid()
    {
        if($this->payments->sum('amount') >= $this->total)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function getCustomerNameFnAttribute()
    {
        $lang = null;
        if (session()->has('selected_language')) {   /*if session has selected language */
            $lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $lang = Translation::where('default', 1)->first();
        }
        if($lang == null)
        {
            if($this->customer_name)
            {
                return $this->customer_name;
            }
            else{
                return "Walk In Customer";
            }
        }
        else{
            if($this->customer_name)
            {
                return $this->customer_name;
            }
            else{
                return $lang->data['walk_in_customer'] ?? "Walk In Customer";
            }
        }
    }    
}