<?php

namespace App\Http\Livewire\Admin\Salaries;

use Livewire\Component;

class SalaryView extends Component
{
    public function render()
    {
        return view('livewire.admin.salaries.salary-view');
    }
     public function mount($id){

     dd($id);   
    }
}
