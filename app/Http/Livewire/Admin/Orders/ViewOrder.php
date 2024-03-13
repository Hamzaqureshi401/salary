<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\MasterSetting;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ViewOrder extends Component
{
    public $order,$store_name,$store_email,$store_phone,$address,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.orders.view-order');
    }
    /* process before render */
    public function mount($id)
    {
        $this->order = Order::find($id);
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
        if(!Auth::user()->can('orders_list'))
        {
            abort(404);
        }
    }
}