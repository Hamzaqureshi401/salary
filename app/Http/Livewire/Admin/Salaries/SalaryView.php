<?php

namespace App\Http\Livewire\Admin\Salaries;
use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\MasterSetting;
use Livewire\Component;
use DB;

class SalaryView extends Component
{ 
    public $salaryGeneration, $record, $company_setting ,$salarySummary;

    public function render()
    {
        return view('livewire.admin.salaries.salary-view');
    }
    public function mount($id){
        $company_setting = new MasterSetting();        
        $this->record = Salarygeneration::where('id', $id)->with('employee')->first();
        if($this->record) {
            $employeeId = $this->record->employee_id;
            $this->salarySummary = Salarygeneration::select(
                DB::raw('SUM(am_income)         as total_am_income, 
                         SUM(a_income)          as total_a_income, 
                         SUM(a_tax)             as total_a_tax, 
                         SUM(am_contributions)  as total_am_contributions, 
                         SUM(atp_tax)           as total_atp_taxl, 
                         SUM(driving_allowance) as total_driving_allowance, 
                         SUM(working_hours)     as total_working_hours'))
                ->whereYear('created_at', '>=', now()->year) // Filter from January of current year
                ->whereMonth('created_at', '>=', 1)
                ->where('employee_id', $employeeId)
                ->first();
        }
    }

}
