<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use App\Models\Salarygeneration;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class Home extends Component
{
    public $currentMonth;
    public $currentYear;
    public $currentMonthName;
    public $employees;
    public $assignings;

    public function render()
    {
       return view('livewire.admin.home');
    }
    
    public function mount(){
        setlocale(LC_TIME, 'en');     
        $this->getData();
        $this->employees = Employee::all();
         Artisan::call('migrate');
    }

    public function getData(){
         $this->currentMonth = Carbon::now()->month;
         $this->currentYear = Carbon::now()->year;
         $this->currentMonthName = Carbon::now()->formatLocalized('%B');

         $this->assignings = Salarygeneration::whereMonth('salary_date', $this->currentMonth)
        ->whereYear('salary_date', $this->currentYear)
        ->get();
    }
}
