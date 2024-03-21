<?php

namespace App\Http\Livewire\Admin\Salaries;
use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\MasterSetting;
use Livewire\Component;

class SalaryView extends Component
{ 
    public $salaryGeneration, $record, $company_setting;

    public function render()
    {
        return view('livewire.admin.salaries.salary-view');
    }
     public function mount($id){
      $company_setting = new MasterSetting();        
      $this->record = Salarygeneration::where('id' , $id)->with('employee')->first();
      //dd($this->query);
     
    }
}
