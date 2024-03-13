<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderStatusScreen extends Component
{
    public $pendingOrders,$readyOrders,$cookingOrders,$lang;
    /* render the page */
    public function render()
    {
        $this->pendingOrders = Order::where('status',Order::PENDING)->get();
        $this->readyOrders = Order::where('status',Order::READY)->get();
        $this->cookingOrders = Order::where('status',Order::COOKING)->get();
        return view('livewire.admin.orders.order-status-screen');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('view_status_screen'))
        {
            abort(404);
        }
    }
    /* change order status */
    public function changeStatus($id,$status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Order status has been changed.']);
    }
}
