<?php
namespace App\Http\Livewire\Admin\Expenses;
use App\Models\Expense;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Company;
use App\Models\VehicleAssigning;
use App\Models\ExpenseType;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewExpenses extends Component
{
    public $expenses, $expense, $driver, $company, $vehicle_id,$date, $expense_type_id, $amount, $lang;
    /* render the page */
    public function render()
    {
        $this->expenses = Expense::latest()->get();
        return view('livewire.admin.expenses.view-expenses');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('expenses_list'))
        {
            abort(404);
        }
    }
    /* delete products with foreign key delete restriction */   
    public function delete(Expense $expense)
    {
       
        $expense->delete();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Expense has been deleted!']);
    }
}
