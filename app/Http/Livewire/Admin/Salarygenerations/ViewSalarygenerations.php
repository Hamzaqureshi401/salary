<?php

namespace App\Http\Livewire\Admin\Salarygenerations;
use App\Models\Salarygeneration;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewSalarygenerations extends Component
{
    public $assignings, $vehicleassigning,$date, $expense_type_id, $amount, $lang;
    /* render the page */
    public function render()
    {
        $this->assignings = Salarygeneration::latest()->get();
        return view('livewire.admin.salaries.view-salaries');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('assigning_list'))
        {
            abort(404);
        }
    }

    public function salaryslip($sgid)
    {
        $query = Salarygeneration::find($sgid);
        dump($query);
     
    }


}
