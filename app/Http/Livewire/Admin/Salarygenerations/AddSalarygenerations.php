<?php

namespace App\Http\Livewire\Admin\Salarygenerations;
use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\Company;
use App\Models\AptSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\ManagesSalaries;



class AddSalarygenerations extends Component
{   
    use ManagesSalaries;
    

    /* render the page */
    public function render()
     {
        return view('livewire.admin.salaries.add-salaries');
    }
    /* process before render */
    public function mount()
    {
        $this->calculateLastDayOfMonth();
        $this->employees = Employee::all();
        //$this->traveling_hours = 0;
        
        if(!Auth::user()->can('add_assigning'))
        {
            abort(404);
        }

    }
    public function save(){

        $assigning = new Salarygeneration();
        $this->create($assigning);
    }
    
}
