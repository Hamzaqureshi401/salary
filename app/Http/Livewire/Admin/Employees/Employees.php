<?php


namespace App\Http\Livewire\Admin\Employees;
use App\Models\Employee;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Employees extends Component
{
    public $employee,$name,$position,$adress,$cpr_no,$draw_percentage,$monthly_deduction, $status = true,$lang; 
    public  $employees, $email, $working_nature,$monthly_salary,$hourly_price,$monthly_hours, $registration_no, $account_no,$bank_name;
    /* render the page */
    public function render()
    {
        $this->employees = Employee::latest()->get();
        return view('livewire.admin.employee.employee');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('employee_list'))
        {
            abort(404);
        }
    }
    
    /* store Employee data */
    public function create()
    {
        $this->validate([
            'name'  => 'required',
            'adress'  => 'required',
            'cpr_no' => 'required|regex:/^\d{6}-\d{4}$/',
            'draw_percentage'  => 'required',
            'monthly_deduction'  => 'required',
            
        ]);
        $employee = new Employee();
        $employee->name = $this->name;
        $employee->	adress = $this->adress;
        $employee->cpr_no = $this->cpr_no;
        $employee->draw_percentage = $this->draw_percentage;
        $employee->monthly_deduction = $this->monthly_deduction;
        $employee->email = $this->email;
        $employee->position = $this->position;
        $employee->account_no = $this->account_no;
        $employee->registration_no = $this->registration_no;
        $employee->bank_name = $this->bank_name;
        $employee->working_nature = $this->working_nature;
        $employee->monthly_salary = $this->monthly_salary;
        $employee->monthly_hours = $this->monthly_hours;
        $employee->hourly_price = $this->hourly_price;
    
        $employee->status='1';
        $employee->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Employee has been added!']);
    }

    /* reset Employee data */
    public function edit(Employee $employee)
    {
        $this->resetFields();
        $this->employee = $employee;
        $this->name = $employee->name;
        $this->adress = $employee->adress;
        $this->cpr_no = $employee->cpr_no;
        $this->draw_percentage = $employee->draw_percentage;
        $this->monthly_deduction = $employee->monthly_deduction;
        $this->email = $employee->email;
        $this->position = $employee->position;

    }
    /* update driver data */
    public function update()
    {
        $this->validate([
            'name'  => 'required',
            
        ]);
        $employee = $this->employee;
        $employee->name = $this->name;
        $employee->	adress = $this->adress;
        $employee->cpr_no = $this->cpr_no;
        $employee->draw_percentage = $this->draw_percentage;
        $employee->monthly_deduction = $this->monthly_deduction;
        $employee->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Employee has been updated!']);
    }
    /* delete driver data */
    public function delete(Employee $employee)
    {
        $employee->delete();
        $this->employee = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Employee has been deleted!']);
    }
    /* reset driver data */
    public function resetFields()
    {
        $this->name = '';
        $this->adress = '';
        $this->cpr_no = '';
        $this->draw_percentage = '';
        $this->monthly_deduction = '';
        $this->email = '';
        $this->position = '';
        $this->resetErrorBag();
    }
     public function debugValue($value)
    {
        $this->working_nature = $value;
    }
}
