<?php

namespace App\Http\Livewire\Admin\Salarygenerations;
use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\Company;
use App\Models\AptSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class AddSalarygenerations extends Component
{   protected $debug = true;

    public  $salary_date, $cmp, $employees,$atpSetting, $gross_salary, $employee_id, $working_hours, $lang;
    public $atp_amount, $am_income, $am_amount, $a_income, $transportExpense, $personal_deduction ,$tax_amount, $tax_base;
    public $aptTax, $am_contributions, $fixed_salary,$lastDay,$working_nature,$a_tax,$traveling_hours,$employee;
    public $driving_allowance,$net_salary,$a_tax_numeric,$nature_hourly, $nature_monthly,$draw_percentage,$da_rate,$final_salary;
    public $showNotification = false;
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
        $this->traveling_hours = 0;
        
        if(!Auth::user()->can('add_assigning'))
        {
            abort(404);
        }
    }
    public function calculateLastDayOfMonth()
    {
        $year = date('Y');
        $month = date('n');
        $lastDay = date('t', strtotime("last day of $year-$month"));

        // Loop to find the last working day
        while (date('N', strtotime("$year-$month-$lastDay")) >= 6) {
            $lastDay--;
        }

        $this->salary_date = "$year-$month-$lastDay";

            // Dump the value for debugging
            dump($this->salary_date);
   
    }
    /* store products*/
    public function create()
    {
        $this->validate([
            'salary_date'  => 'required',
            'employee_id'  => 'required',
            'working_hours'  => 'required',
            'fixed_salary'  => 'required',
            'gross_salary' => 'required',
            'atp_amount' => 'required',
            'am_income'  => 'required',
            'am_contributions'  => 'required',
            'am_amount'  => 'required',
            'a_income'  => 'required',
            'personal_deduction' => 'required',
            'tax_base' => 'required',
            'draw_percentage'  => 'required',
            'tax_amount'  => 'required',
            'a_tax'  => 'required',   
            'da_rate' => 'required',  
            'net_salary' => 'required',
          
        ]);
        
        $assigning = new Salarygeneration();
        $assigning->salary_date = $this->salary_date;
        $assigning->employee_id = $this->employee_id;
        $assigning->working_hours = $this->working_hours;
        $assigning->fixed_gross_salary = $this->fixed_salary;

        $assigning->hourly_gross_salary = $this->gross_salary;
        $assigning->atp_tax = $this->atp_amount;
        $assigning->am_income = $this->am_income;

        $assigning->am_contributions = $this->am_contributions;
        $assigning->am_tax = $this->am_amount;
        $assigning->a_income = $this->a_income;

        $assigning->personal_deduction = $this->personal_deduction;
        $assigning->tax_base = $this->tax_base;
        $assigning->draw_percentage = $this->draw_percentage;
        $assigning->tax_amount = $this->tax_amount;
        $assigning->a_tax = $this->a_tax;

        $assigning->traveling_hours = $this->traveling_hours;
        $assigning->da_rate = $this->da_rate;
        $assigning->driving_allowance = $this->driving_allowance;
        $assigning->net_salary = $this->net_salary;
        $assigning->save();
    
    
        return redirect()->route('admin.view_salaries');
    }
        public function salarycalculation(){
        $aptSetting = AptSetting::first();    
        $employee = Employee::where('id',$this->employee_id)->first();
        if ($employee->working_nature == 1) {
                $this->nature_monthly = $employee->working_nature;
                $this->nature_hourly = null;
                $this->fixed_salary = $employee->monthly_salary;
                $this->working_hours = $employee->monthly_hours;
                $this->gross_salary = $employee->monthly_salary;
                $this->calculatefixedsalary($employee);
        
                } else {
                    // Hourly Employee Calculation                    
                    $this->nature_hourly = $employee->working_nature;
                    $this->nature_monthly = null;
                    $this->fixed_salary = $employee->hourly_price;
                    $this->working_hours = $this->working_hours ?  $this->working_hours : 0;
                    // Call calculateHourlySalary to update gross_salary and perform hourly employee calculations
                    $this->calculateHourlySalary($employee);
                }
                
    }
    private function calculateAtpTax($workingHours, $atpSetting)
    {
        if ($workingHours < 39) {
            return $atpSetting->lessthan39hours;
        } elseif ($workingHours >= 39 && $workingHours <= 77) {
            return $atpSetting->between39and77hours;
        } elseif ($workingHours >= 78 && $workingHours <= 116) {
            return $atpSetting->between78and116hours;
        } else {
            return $atpSetting->morethan117hours;
        }
    }
    public function calculateHourlyGrossSalary($hourlyRate, $workingHours)
    {
        return (float) $hourlyRate * (float) $workingHours;
    }


    public function calculatefixedsalary($employee)
{
    $aptSetting = AptSetting::first(); 

    $this->atp_amount = $this->calculateAtpTax($this->working_hours, $aptSetting);
    $this->am_income = $this->gross_salary - $this->atp_amount;

    // Third step is to calculate the am contribution value & deduct this from am_income
    $this->am_contributions = 8;
    $this->am_amount = $this->am_income * 0.08;
    //$this->am_amount = number_format($this->am_amount, 2);
    $this->a_income = $this->am_income - $this->am_amount;

    // Forth Step is to Calculate the A Tax after deduction value of Monthly Deduction
    $this->personal_deduction = $employee->monthly_deduction;
    $this->tax_base = $this->a_income - $this->personal_deduction;

    // $this->tax_base = number_format($this->tax_base, 2);

    $this->draw_percentage = $employee->draw_percentage;
    $this->tax_base = is_numeric($this->tax_base) ? $this->tax_base : 0;
    $this->tax_amount = $this->tax_base * $this->draw_percentage / 100;
    //$this->tax_amount = number_format($this->tax_amount, 2);
    // $this->a_tax = $this->a_income - $this->tax_amount;
    $this->a_tax_numeric = $this->a_income - $this->tax_amount;
    $this->a_tax = number_format($this->a_tax_numeric, 2);

    // Fifth step is to calculate the driving allowance
    $this->traveling_hours = is_numeric($this->traveling_hours) ? $this->traveling_hours : 0;
    $this->da_rate = $aptSetting->da_rate;
    $this->driving_allowance = $this->traveling_hours * $this->da_rate;

    // Finally Net Salary Completion
    if (is_numeric($this->a_tax_numeric) && is_numeric($this->driving_allowance)) {
        $this->net_salary = number_format($this->a_tax_numeric + $this->driving_allowance, 2);
    } else {
        $this->net_salary = 0; // Adjust this based on your specific logic
    }
}

    public function updatedWorkingHours($value)
{
    $this->working_hours = is_numeric($value) ? (float) $value : 0;
    $employee = Employee::find($this->employee_id);
    // Update gross_salary when working hours are changed
    $this->gross_salary = $this->calculateHourlyGrossSalary($employee->hourly_price, $this->working_hours);

    // Recalculate hourly salary when working hours are updated
    $this->calculateHourlySalary($employee);
}


public function calculateHourlySalary($employee)
{
    $aptSetting = AptSetting::first();

    // Update the gross_salary calculation here
    $this->gross_salary = $this->calculateHourlyGrossSalary($employee->hourly_price, $this->working_hours);


    $this->atp_amount = $this->calculateAtpTax($this->working_hours, $aptSetting);
    $this->am_income = $this->gross_salary - $this->atp_amount;

    // Third step is to calculate the am contribution value & deduct this from am_income
    $this->am_contributions = 8;
    $this->am_amount = $this->am_income * 0.08;
    //$this->am_amount = number_format($this->am_amount, 2);
    $this->a_income = $this->am_income - $this->am_amount;

    // Forth Step is to Calculate the A Tax after deduction value of Monthly Deduction
    $this->personal_deduction = $employee->monthly_deduction;
    $this->tax_base = $this->a_income - $this->personal_deduction;

    // $this->tax_base = number_format($this->tax_base, 2);

    $this->draw_percentage = $employee->draw_percentage;
    $this->tax_base = is_numeric($this->tax_base) ? $this->tax_base : 0;
    $this->tax_amount = $this->tax_base * $this->draw_percentage / 100;
    //$this->tax_amount = number_format($this->tax_amount, 2);
    // $this->a_tax = $this->a_income - $this->tax_amount;
    $this->a_tax_numeric = $this->a_income - $this->tax_amount;
    $this->a_tax = number_format($this->a_tax_numeric, 2);

    // Fifth step is to calculate the driving allowance
    $this->traveling_hours = is_numeric($this->traveling_hours) ? $this->traveling_hours : 0;
    $this->da_rate = $aptSetting->da_rate;
    $this->driving_allowance = $this->traveling_hours * $this->da_rate;

    // Finally Net Salary Completion
    if (is_numeric($this->a_tax_numeric) && is_numeric($this->driving_allowance)) {
        $this->net_salary = number_format($this->a_tax_numeric + $this->driving_allowance, 2);
    } else {
        $this->net_salary = 0; // Adjust this based on your specific logic
    }

}

}
