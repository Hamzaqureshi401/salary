<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Addon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetailAddon;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PosScreen extends Component
{
    public $products,$selected_category='all',$search='',$cart=[],$addons,$product,$categories,$selected_variant,$selected_extras=[],$cartindex=0,$notes,$taxpercentage,$tax_amount=0;
    public $order_type=Order::DINING,$tables,$selected_table,$todaycooking=[];
    public $total,$subtotal,$discount,$service_charge=0,$paid_amount=0,$payment_type = 1;
    public $name,$phone,$email,$address,$selected_customer,$customers,$customer_search = '',$lang;

    protected $listeners = ['loadCook' => 'loadTodayCooking'];
    /* render the page */
    public function render()
    {
        $query=  Product::latest();
        if($this->search != '')
        {
            $query->where('name','like','%'.$this->search.'%');
        }
        if($this->selected_category != 'all')
        {
            $query->where('category_id',$this->selected_category);
        }
        $this->products = $query->get();
        return view('livewire.admin.orders.pos-screen')->layout('layouts.pos_layout');
    }
    /* process before render */
    public function mount()
    {
        $this->categories = ProductCategory::whereIsActive(1)->get();
        $this->tables = Table::whereIsActive(1)->get();
        $this->taxpercentage = getTaxPercentage();
        $this->lang = getTranslation();
        if(!Auth::user()->can('add_order'))
        {
            abort(404);
        }
    }
    /* Feach Products */
    public function selectProduct(Product $product)
    {
        $this->resetAddonSelection();
        $this->product = $product;
        if($product->addons->count() > 0)
        {
            $this->emit('openmodal','ModalProduct');
            $this->addons = $product->addons;
            $this->calculateTotal();
        }
        else{
            $foundindex = null;
            foreach($this->cart as $key => $item)
            {
                if($item['product']['id'] == $product->id)
                {
                    $foundindex = $key;
                    break;
                }
            }
            if($foundindex != null)
            {
                $this->cart[$foundindex]['quantity']++;
                $this->calculateTotal();
                return;
            }
            $this->cartindex ++;
            $array = [
                'product'   => $this->product,
                'extras'    => null,
                'variant'   => null,
                'quantity'  => 1
            ];
            $this->cart[$this->cartindex] = $array;
            $this->resetAddonSelection();
            $this->calculateTotal();
        }
    }
    /* feach addons from selected product */
    public function selectVariant($id)
    {
        $this->selected_variant = $id;
    }
    /* complete selection process */
    public function completeAddonSelection()
    {
        $this->cartindex ++;
        $variant = Addon::where('id',$this->selected_variant)->first();
        $extras = Addon::whereIn('id',$this->selected_extras)->get();
        if($extras->count() == 0)
        {
            $extras = null;
        }
        $array = [
            'product'   => $this->product,
            'extras'    => $extras,
            'variant'   => $variant,
            'quantity'  => 1
        ];
        $this->cart[$this->cartindex] = $array;
        $this->resetAddonSelection();
        $this->calculateTotal();
        $this->emit('closemodal');
    }
    /* reset addon selection */
    public function resetAddonSelection()
    {
        $this->product = [];
        $this->selected_extras = [];
        $this->selected_variant = null;
        $this->addons = collect();
    }
    /* remove product from cart */
    public function removeFromCart($key)
    {
        unset($this->cart[$key]);
    }
    /* change order types example: Dinning,Delivery,Takeaway */
    public function changeOrderType($type)
    {
        $this->order_type = $type;
    }
    /* calculate sum */
    public function calculateTotal()
    {
        if(count($this->cart) > 0)
        {
            $this->total = 0;
            $this->subtotal = 0;
            $this->tax_amount = 0;
            foreach($this->cart as $key => $item)
            {
                $inlineprice = $item['product']['price'];
                if ($item['variant'] != null) {
                    $inlineprice = $item['variant']['price'];
                }
                $extraprice = 0;
                if ($item['extras'] != null) {
                    foreach ($item['extras'] as $extra) {
                        $extraprice += $extra['price'];
                    }
                }
                $inlinetotal = ($inlineprice * $item['quantity']) + $extraprice;
                $inlineprice += $extraprice;
                $this->subtotal += $inlinetotal;
            }
            $this->total = $this->subtotal;
            $this->total += (is_numeric($this->service_charge) ? $this->service_charge : 0);
            $this->tax_amount = $this->total * $this->taxpercentage /100;
            $this->total += (is_numeric($this->tax_amount) ? $this->tax_amount : 0);
            $this->total -= is_numeric($this->discount) ? $this->discount : 0;
        }
    }
    /* store customer data from pos page */
    public function createCustomer()
    {
        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'nullable|email|unique:customers'
        ]);
        $customer = new Customer();
        $customer->name = $this->name;
        $customer->phone = $this->phone;
        $customer->email = ($this->email == "" ? null : $this->email);
        $customer->address = $this->address;
        $customer->save();
        $this->selectCustomer($customer);
        $this->emit('closemodal');
        $this->resetCustomerFields();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Customer has been created!']);
    }
    /* customer search */
    public function selectCustomer(Customer $customer)
    {
        $this->selected_customer = $customer;
        $this->customer_search = '';
        $this->customers = [];
    }
    /* reset customer data */
    public function resetCustomerFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = null;
        $this->address = '';
        $this->resetErrorBag();
    }
    /* search customers */
    public function updatedCustomerSearch($value)
    {
        if($value != '')
        {
            $this->customers = Customer::where('name','like','%'.$value.'%')->get();
        }
        else{
            $this->customers = [];
        }
    }
    /* service charge and discount */
    public function updated($name,$value)
    {
        if($name == 'discount' || $name =='service_charge')
        {
            if ( $value == '' ) 
            {
                data_set($this, $name, null);
            }
        }
        $this->calculateTotal();
    }
    /* place order */
    public function placeOrder()
    {
        $this->calculateTotal();
        if(count($this->cart) == 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'Select some items!']);
            return;
        }

        if(($this->total) <= 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'Total cannot be less than 0!']);
            return;
        }

        if($this->order_type == Order::DINING && $this->selected_table == '')
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'A dining order must have a table selected.']);
            return;
        }

        if($this->order_type == Order::DELIVERY && !$this->selected_customer)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'A delivery order must have a customer selected']);
            return;
        }

        if(($this->paid_amount < $this->total) && !$this->selected_customer)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'A walk in customer must pay the full amount.']);
            return;
        }

        if($this->paid_amount > $this->total)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error','title' => 'Order Failed!',  'message' => 'Paid amount cannot be greater than total.']);
            return;
        }

        $order = new Order();
        if($this->selected_customer)
        {
            $order->customer_name = $this->selected_customer->name;
            $order->customer_phone = $this->selected_customer->phone;
            $order->customer_id = $this->selected_customer->id;
        }
        if($this->order_type == Order::DINING)
        {
            $table = Table::find($this->selected_table);
            $order->table_id = $this->selected_table;
            $order->table_no = $table->name;
        }
        $order->date = Carbon::now();
        $order->order_number = $this->generateOrderNumber();
        $order->service_charge = $this->service_charge;
        $order->discount = $this->discount;
        $order->total = $this->total;
        $order->subtotal = $this->subtotal;
        $order->order_type = $this->order_type;
        $order->tax_percentage = $this->taxpercentage;
        $order->tax_amount = $this->tax_amount;
        $order->save();

        foreach ($this->cart as $key => $item) 
        {
            $inlineprice = $item['product']['price'];
            if ($item['variant'] != null) {
                $inlineprice = $item['variant']['price'];
               
            }
            $extraprice = 0;
            if ($item['extras'] != null) {
                foreach ($item['extras'] as $extra) {
                    $extraprice += $extra['price'];
                }
            }
            $inlinetotal = ($inlineprice * $item['quantity']) + $extraprice;
            $inlineprice += $extraprice;
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item['product']['id'];
            $orderDetail->product_name = $item['product']['name'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->rate = $inlineprice;
            $orderDetail->total = $inlinetotal;
            $orderDetail->save();
            if ($item['variant'] != null) {
                $orderAddon = new OrderDetailAddon();
                $orderAddon->order_detail_id = $orderDetail->id;
                $orderAddon->addon_id = $item['variant']['id'];
                $orderAddon->addon_name = $item['variant']['name'];
                $orderAddon->addon_price = $item['variant']['price'];
                $orderAddon->type = Addon::VARIANT;
                $orderAddon->save();
            }
            if ($item['extras'] != null) {
                foreach ($item['extras'] as $extra) {
                    $orderAddon = new OrderDetailAddon();
                    $orderAddon->order_detail_id = $orderDetail->id;
                    $orderAddon->addon_id = $extra['id'];
                    $orderAddon->addon_name = $extra['name'];
                    $orderAddon->addon_price = $extra['price'];
                    $orderAddon->type = Addon::EXTRAS;
                    $orderAddon->save();
                }
            }
        }   
        if($this->paid_amount)
        {
            $payment = new OrderPayment();
            $payment->order_id = $order->id;
            $payment->amount = $this->paid_amount;
            if($this->selected_customer)
            {
                $payment->customer_name = $this->selected_customer->name;
                $payment->customer_phone = $this->selected_customer->phone;
                $payment->customer_id = $this->selected_customer->id;
                $payment->created_by = Auth::user()->id;
            }
            $payment->type = $this->payment_type;
            $payment->save();
        }
        $this->dispatchBrowserEvent(
            'swal-alert', ['type' => 'success','title' => 'Order Saved!',  'message' => 'Order #'.$order->order_number.' has been saved..']);
        $this->resetEverything();
        return;
    }
    /* reset pos page */
    public function resetEverything()
    {
        $this->cart = [];
        $this->selected_customer = null;
        $this->customers = [];
        $this->selected_table = '';
        $this->discount = 0;
        $this->service_charge =0;
        $this->payment_type = 1;
        $this->paid_amount = 0;
        $this->total = 0;
        $this->subtotal = 0;
    }
    /* get order numbers */
    private function generateOrderNumber()
    {
        $ordernumber = Order::latest()->first();
        if($ordernumber)
        {
            if($ordernumber && $ordernumber->order_number!=""){
                /* if order code not empty */
                $code=$ordernumber->order_number;
                $new_code = $code + 1;
                return $new_code;
            }
            else{
                return  '1';
            }
        }
        return '1';
    }
    /* Cooking status feach only today data */
    public function loadTodayCooking()
    {
        $this->todaycooking = Order::where('status','!=',3)->whereDate('date',Carbon::today())->get();
    }

}
