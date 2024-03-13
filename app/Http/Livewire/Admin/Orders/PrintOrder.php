<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\MasterSetting;
use App\Models\Order;
use Livewire\Component;

class PrintOrder extends Component
{
    public $printer,$order,$store_name,$store_email,$store_phone,$address,$lang;
    /* render the page */
    public function render()
    {
        $printer =$this->printer;
        return view('livewire.admin.orders.print-order')->layout('layouts.print_layout',['printer' => $printer]);
    }
    /* process before render */
    public function mount($order,$printer)
    {
        $this->printer = $printer;
        $this->order =Order::find($order);
        if(!$this->order)
        {
            abort(404);
        }

        $settings = new MasterSetting();
        $site = $settings->siteData();
        $this->store_name = $site['store_name'] ?? 'StackPOS';
        $this->store_email = $site['store_email'] ?? 'store@store.com';
        $this->store_phone = $site['store_phone'] ?? '123456';
        $this->address = $site['address'] ?? '-';
        $this->lang = getTranslation();
    }
}
