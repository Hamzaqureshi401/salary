<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\Employee;
use App\Models\Salarygeneration;
use Carbon\Carbon;
use Livewire\Component;

class SalaryReport extends Component
{
    public $currentMonth;
    public $currentYear;
    public $currentMonthName;
    public $employees;
    public $employee_id;
    public $assignings;
    public $start_date;
    public $end_date;

    public function render()
    {
        return view('livewire.admin.reports.salary-report');
    }

    public function mount(){
        setlocale(LC_TIME, 'en');     
        $this->getData();
        $this->employees = Employee::all();
    }

    public function getData(){
         $this->currentMonth = Carbon::now()->month;
         $this->currentYear = Carbon::now()->year;
         $this->currentMonthName = Carbon::now()->formatLocalized('%B');
         $this->assignings = Salarygeneration::get();
    }


    public function filerSalary(){

        $this->assignings = Salarygeneration::query()
        ->when($this->employee_id, function ($query) {
            return $query->where('employee_id', $this->employee_id);
        })
        ->when($this->start_date, function ($query) {
            // Set the start date to the first day of the selected month
            $startDate = Carbon::parse($this->start_date)->startOfMonth();
            return $query->where('salary_date', '>=', $startDate);
        })
        ->when($this->end_date, function ($query) {
            // Set the end date to the last day of the selected month
            $endDate = Carbon::parse($this->end_date)->endOfMonth();
            return $query->where('salary_date', '<=', $endDate);
        })
        ->get();
    }


}
