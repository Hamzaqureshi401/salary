<?php

namespace App\Http\Livewire\Admin;

//use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component
{
    public $latestorders,$pendingorders,$lang;
    /* render the page */
    public function render()
    {
       // $this->latestorders = Order::whereDate('date',Carbon::today())->get();
        //$this->pendingorders = Order::whereStatus(Order::PENDING)->get();
        return view('livewire.admin.home');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
    }
}
