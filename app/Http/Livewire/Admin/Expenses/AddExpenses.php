<?php

namespace App\Http\Livewire\Admin\Expenses;

use App\Models\Expense;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Company;
use App\Models\VehicleAssigning;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;



class AddExpenses extends Component
{
    public $expenses, $expense, $vehicle_id, $assignment_id, $date, $description, $expensetype_id, $expensetype, $vehicle_file_no,$vehicles, $amount, $lang;
    public $selectedAssignment;
    public $vehicleFileNo;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.expenses.add-expenses');
    }
    /* process before render */
    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->assigning = VehicleAssigning::with(['vehicle', 'company', 'driver'])->where('status', 1)->get();
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->driver = Driver::where('status',1)->get();
        $this->company = Company::all();
        $this->expensetype = Expensetype::all();

        if(!Auth::user()->can('add_expenses'))
        {
            abort(404);
        }
    }
    /* store products*/
    public function create()
    {
        $this->validate([
            'date'  => 'required',
            'assignment_id'=>'required',
            'expensetype_id'  => 'required',
            'amount' => 'required',
        ]);
        $expense = new Expense();
        $expense->date = $this->date;
        $expense->assignment_id = $this->assignment_id;
        $expense->vehicle_file_no = $this->vehicleFileNo;
        $expense->expense_type_id = $this->expensetype_id;
        $expense->amount= $this->amount;
        $expense->description= $this->description;
        $expense->save();
        return redirect()->route('admin.view_expense');
    }
    public function updatedSelectedAssignment($value)
    {
        // When the user selects an assignment, set the vehicleFileNo property
        $this->vehicleFileNo = $value ? $value->vehicle->file_no : '';
    }

    public function assignfileno(){
        $file = VehicleAssigning::where('id',$this->assignment_id)->first();
        
        $this->vehicleFileNo = $file->vehicle->file_no;
    }
    
}
