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


class EditExpenses extends Component
{
    public $expenses, $expense, $vehicle_id, $date,$description,$assignment_id, $expensetype_id, $expensetype, $vehicle,$vehicles, $amount, $lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.expenses.edit-expenses');
    }
    /* process before render */
    public function mount($id)
    {
        $this->date = date('Y-m-d');
        $this->assigning = VehicleAssigning::with(['vehicle', 'company', 'driver'])->get();
        $this->driver = Driver::where('status',1)->get();
        $this->company = Company::all(); 
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->expensetype = Expensetype::all();
       
        $this->expense = Expense::find($id);
        if(!$this->expense)
        {
            abort(404);
        }
        $this->date = $this->expense->date;
        $this->assignment_id=$this->expense->assignment_id;
        $this->expensetype_id=$this->expense->expense_type_id ;
        $this->amount= $this->expense->amount;
        $this->description=$this->expense->description;
        if(!Auth::user()->can('edit_expenses'))
        {
            abort(404);
        }
    }
    /* update product data */
    public function update()
    {
        $this->validate([
            'date'  => 'required',
            'assignment_id'  => 'required',
            'expensetype_id'  => 'required',
            'amount' => 'required',
        ]);
        $expense = $this->expense;
        $expense->date = $this->date;
        $expense->assignment_id = $this->assignment_id;
        $expense->expense_type_id = $this->expensetype_id;
        $expense->amount= $this->amount;
        $expense->description= $this->description;
        $expense->save();
        return redirect()->route('admin.view_expense');
    }
}