<?php

namespace App\Http\Livewire\Admin\ExpenseTypes;
use App\Models\Expense;
use App\Models\ExpenseType as ModelsExpenseType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpenseTypes extends Component
{
    public $expensetype,$name,$expensetypes,$is_active = true,$lang;
    /* render the page */
    public function render()
    {
        $this->expensetypes = ModelsExpenseType::latest()->get();
        return view('livewire.admin.expense-type.expense-type');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('expensetypes_list'))
        {
            abort(404);
        }
    }
    /* store category */
    public function create()
    {
        $this->validate([
            'name'  => 'required',
        ]);
        $expensetype = new ModelsExpenseType();
        $expensetype->name = $this->name;
        $expensetype->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Expense Type has been created!']);
    }
    /* edit category */
    public function edit(ModelsExpenseType $expensetype)
    {
        $this->resetFields();
        $this->expensetype = $expensetype;
        $this->name = $expensetype->name;
    }
    /* update category details */
    public function update()
    {
        $this->validate([
            'name'  => 'required',
        ]);
        $expensetype = $this->expensetype;
        $expensetype->name = $this->name;
        $expensetype->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Expense Type has been updated!']);
    }
    /* delete category with foreign key delete restriction */
    public function delete(ModelsExpenseType $expensetype)
    {
        if(Expense::where('expense_type_id',$expensetype->id)->count() > 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Expense Type deletion restricted!']);
            return 0;
        }
        $expensetype->delete();
        $this->expensetype = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Expense Type has been deleted!']);
    }
    /* reset fields */
    public function resetFields()
    {
        $this->resetErrorBag();
        $this->name = '';
    }
}
