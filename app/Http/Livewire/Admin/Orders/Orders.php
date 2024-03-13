<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public $orders,$lang,$order,$paid_amount,$payment_type = 1;
    /* render the page */
    public function render()
    {
        $query = Order::with('payments')->latest();
        $this->orders = $query->get();
        return view('livewire.admin.orders.orders');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('orders_list'))
        {
            abort(404);
        }
    }
    /* change order status */
    public function changeStatus(Order $order)
    {
        if($order->status < 3)
        {
            $order->status ++;
            $order->save();
        }
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Order status has been changed.']);
    }
    /* show payment */
    public function viewPayment($id)
    {
        $this->order = Order::find($id);
        $this->paid_amount = $this->order->total - $this->order->payments->sum('amount');
        $this->payment_type = 1;
        $this->resetErrorBag();
    }
    /* store payment */
    public function savePayment()
    {
        $this->validate([
            'paid_amount'   => 'numeric'
        ]);
        $max = $this->order->total - $this->order->payments->sum('amount');
        if($this->paid_amount > $max)
        {
            $this->addError('paid_amount','Amount cannot be greater than balance!');
            return;
        }
        $payment = new OrderPayment();
        $payment->order_id = $this->order->id;
        $payment->created_by = Auth::user()->id;
        $payment->amount = $this->paid_amount;
        $payment->order_id = $this->order->id;
        $payment->customer_name = $this->order->customer->name;
        $payment->customer_phone = $this->order->customer->phone;
        $payment->customer_id = $this->order->customer->id;
        $payment->type = $this->payment_type;
        $payment->save();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Payment Saved.']);
        $this->order = [];
        $this->resetErrorBag();
        $this->emit('closemodal');
    }
}
