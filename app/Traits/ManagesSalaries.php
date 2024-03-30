<?php

namespace App\Traits;

use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\Company;
use App\Models\AptSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ManagesSalaries
{
    protected $debug = true;

    public  $salary_date, $cmp, $employees,$atpSetting, $gross_salary, $employee_id, $working_hours, $lang;
    public $atp_amount, $am_income, $am_amount, $a_income, $transportExpense, $personal_deduction ,$tax_amount, $tax_base;
    public $aptTax, $am_contributions, $fixed_salary,$lastDay,$working_nature,$a_tax,$traveling_hours,$employee;
    public $driving_allowance,$net_salary,$a_tax_numeric,$nature_hourly, $nature_monthly,$draw_percentage,$da_rate,$final_salary, $sallery , $editData;
    public $showNotification = false;
    public $isReadOnly = false;

    /**
     * Update or add an employee's salary.
     *
     * @param Employee $employee
     * @param float $salary
     * @return bool
     */
    public function calculateLastDayOfMonth(){

        $year = date('Y');
        $month = date('n');
        $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $lastDay = $numDaysInMonth;

        while (date('N', mktime(0, 0, 0, $month, $lastDay, $year)) >= 6) {
            $lastDay--;
        }

        // Format the date as 'YYYY-MM-DD'
        $this->salary_date = date('Y-m-d', mktime(0, 0, 0, $month, $lastDay, $year));
    }


    /* store products*/
    public function create($assigning)
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
        
        
        $this->a_tax = str_replace(',', '', $this->a_tax);
        $this->net_salary = str_replace(',', '', $this->net_salary);
        $this->gross_salary = str_replace(',', '', $this->gross_salary);
        $this->a_income = str_replace(',', '', $this->a_income);
        $this->am_income = str_replace(',', '', $this->am_income);
        $this->driving_allowance = str_replace(',', '', $this->driving_allowance);
        $this->tax_base = str_replace(',', '', $this->tax_base);
        $this->tax_amount = str_replace(',', '', $this->tax_amount);
        $this->am_amount = str_replace(',', '', $this->am_amount);
       
        $assigning->salary_date = $this->salary_date ?? $assigning->salary_date ?? 0;
        $assigning->employee_id = $this->employee_id ?? $assigning->employee_id ?? 0;
        $assigning->working_hours = $this->working_hours ?? $assigning->working_hours ?? 0;
        $assigning->fixed_gross_salary = $this->fixed_salary ?? $assigning->fixed_gross_salary ?? 0;

        $assigning->hourly_gross_salary = $this->gross_salary ?? $assigning->hourly_gross_salary ?? 0;
        $assigning->atp_tax = $this->atp_amount ?? $assigning->atp_tax ?? 0;
        $assigning->am_income = $this->am_income ?? $assigning->am_income ?? 0;

        $assigning->am_contributions = $this->am_contributions ?? $assigning->am_contributions ?? 0;
        $assigning->am_tax = $this->am_amount ?? $assigning->am_tax ?? 0;
        $assigning->a_income = $this->a_income ?? $assigning->a_income ?? 0;

        $assigning->personal_deduction = $this->personal_deduction ?? $assigning->personal_deduction ?? 0;
        $assigning->tax_base = $this->tax_base ?? $assigning->tax_base ?? 0;
        $assigning->draw_percentage = $this->draw_percentage ?? $assigning->draw_percentage ?? 0;
        $assigning->tax_amount = $this->tax_amount ?? $assigning->tax_amount ?? 0;
        $assigning->a_tax = $this->a_tax ?? $assigning->a_tax ?? 0;

        $assigning->traveling_hours = $this->traveling_hours ?? $assigning->traveling_hours ?? 0;
        $assigning->da_rate = $this->da_rate ?? $assigning->da_rate ?? 0;
        $assigning->driving_allowance = $this->driving_allowance ?? $assigning->driving_allowance ?? 0;
        $assigning->net_salary = $this->net_salary ?? $assigning->net_salary ?? 0;
        $assigning->save();
    
    
        return redirect()->route('admin.view_salaries');
    }
    public function changeType(){

        $this->salarycalculation();
        $this->traveling_hours = 0;
        $this->calculateDrivingAllowence();

        $employee = Employee::where('id',$this->employee_id)->first();
        if ($employee->working_nature != 1) {
            $this->net_salary = 0;
        }
    }
    public function salarycalculation(){

        $this->isReadOnly = false;    

        $aptSetting = AptSetting::first();    
        $employee = Employee::where('id',$this->employee_id)->first();
        //dd($this->employee_id , $employee);
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
                    if($employee->working_nature == 0){
                        $this->working_hours = null;
                    }else{
                        $this->working_hours = $this->working_hours ?  $this->working_hours : 0;
                    }
                    
                    // Call calculateHourlySalary to update gross_salary and perform hourly employee calculations
                    $this->calculateHourlySalary($employee);

                }
        $this->tax_base = number_format(floatval($this->tax_base), 2);
        $this->tax_amount = number_format(round(floatval($this->tax_amount)), 2);

    
                
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


    public function calculatefixedsalary($employee){

        $this->isReadOnly = !$this->isReadOnly;    
        $aptSetting = AptSetting::first(); 

        $this->atp_amount = $this->calculateAtpTax($this->working_hours, $aptSetting);
        $am_income = $this->gross_salary - $this->atp_amount;
        $this->am_income = number_format($am_income,2);
        $this->gross_salary = number_format($this->gross_salary,2);

        // Third step is to calculate the am contribution value & deduct this from am_income
        $this->am_contributions = 8;
        $this->am_amount = $am_income * 0.08;
        //$this->am_amount = number_format($this->am_amount, 2);
        $this->a_income = $am_income - $this->am_amount;

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
        $this->a_tax = number_format(round($this->a_tax_numeric), 2);
        $this->a_income = number_format($this->a_income ,2);
        $this->am_amount = number_format($this->am_amount ,2);

        // Fifth step is to calculate the driving allowance
        $this->traveling_hours = is_numeric($this->traveling_hours) ? $this->traveling_hours : 0;
        $this->da_rate = $aptSetting->da_rate;
        $this->driving_allowance = $this->traveling_hours * $this->da_rate;

        // Finally Net Salary Completion
        if (is_numeric($this->a_tax_numeric) && is_numeric($this->driving_allowance)) {
            $this->net_salary = number_format(round($this->a_tax_numeric + $this->driving_allowance), 2);
        } else {
            $this->net_salary = 0; // Adjust this based on your specific logic
        }
        $this->driving_allowance = number_format(round($this->driving_allowance),2);
    }

    public function updatedWorkingHours($value){

        $this->working_hours = is_numeric($value) ? (float) $value : 0;
        $employee = Employee::find($this->employee_id);
        // Update gross_salary when working hours are changed
        $this->gross_salary = number_format($this->calculateHourlyGrossSalary($employee->hourly_price, $this->working_hours),2);

        // Recalculate hourly salary when working hours are updated
        $this->calculateHourlySalary($employee);
    }


    public function calculateHourlySalary($employee)
    {
        $aptSetting = AptSetting::first();

        // Update the gross_salary calculation here
        $gross_salary = $this->calculateHourlyGrossSalary($employee->hourly_price, $this->working_hours);
        $this->gross_salary = number_format($gross_salary,2);


        $this->atp_amount = $this->calculateAtpTax($this->working_hours, $aptSetting);
        $am_income = $gross_salary - $this->atp_amount;
        $this->am_income = number_format($am_income , 2);

        // Third step is to calculate the am contribution value & deduct this from am_income
        $this->am_contributions = 8;
        $this->am_amount = $am_income * 0.08;
        //$this->am_amount = number_format($this->am_amount, 2);
        $this->a_income = $am_income - $this->am_amount;

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
        $this->a_income = number_format($this->a_income ,2);


        // Fifth step is to calculate the driving allowance
        $this->traveling_hours = is_numeric($this->traveling_hours) ? $this->traveling_hours : 0;
        $this->da_rate = $aptSetting->da_rate;
        $this->driving_allowance = $this->traveling_hours * $this->da_rate;

        // Finally Net Salary Completion
        if (is_numeric($this->a_tax_numeric) && is_numeric($this->driving_allowance)) {
            $this->net_salary = number_format(round($this->a_tax_numeric + $this->driving_allowance), 2);
        } else {
            $this->net_salary = 0; // Adjust this based on your specific logic
        }
        $this->driving_allowance = number_format(round($this->driving_allowance),2);

        $this->tax_base = number_format($this->tax_base , 2);
        $this->tax_amount = number_format($this->tax_amount , 2);
        $this->am_amount = number_format($this->am_amount ,2);

        $a_income = str_replace(',', '', $this->a_income);

        if($this->personal_deduction > $a_income){

            $tax_base = 0.00;
            $tax_amount = 0.00;
            $a_tax = str_replace(',', '', $a_income);

        
        }
        $this->a_income = number_format(round($a_income),2);
        $this->a_tax = number_format(round($a_tax ?? str_replace(',', '', $this->a_tax)),2);
        $this->tax_base = number_format(round($tax_base ?? str_replace(',', '', $this->tax_base)),2);
        $this->tax_amount = number_format(round($tax_amount ?? str_replace(',', '', $this->tax_amount)),2);
        if($this->working_hours != 0){
            $this->net_salary = $this->net_salary;
        }else{
            $this->net_salary = 0;
        }
        

    }

    public function calculateDrivingAllowence(){
        //dd($this->sallery);
        $aptSetting = AptSetting::first();
         $this->traveling_hours = is_numeric($this->traveling_hours) ? $this->traveling_hours : 0;
        $this->da_rate = $aptSetting->da_rate;
        $driving_allowance = $this->traveling_hours * $this->da_rate;
        $this->driving_allowance = number_format(round($driving_allowance) , 2);

        $this->traveling_hours = ltrim($this->traveling_hours, '0');
        if($this->working_hours != 0){
            $this->net_salary = number_format(round($this->a_tax_numeric + $driving_allowance), 2);
        }else{
            $this->net_salary = 0;
        }
        
    }
}
