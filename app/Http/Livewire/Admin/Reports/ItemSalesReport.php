<?php

namespace App\Http\Livewire\Admin\Reports;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ItemSalesReport extends Component
{
    public $start_date,$end_date,$data=[],$search='',$lang, $expensetype_id, $vehicle_file_no;
     public $reportData = [],$isFetchingData;
     protected $casts = [
    'date' => 'date', // Make sure this is set to date
];
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.item-sales-report');
    }
    /* process before render */
    public function mount()
    {
        $this->start_date = Carbon::today()->startOfMonth()->toDateString();
        $this->end_date = Carbon::today()->toDateString();
        $this->expensetype = Expensetype::all();
        $this->vehicle = Vehicle::all();
        $this->lang = getTranslation();
        if(!Auth::user()->can('item_wise_sales_report'))
        {
            abort(404);
        }
    }
    /* feach Item wise sales report*/
    public function getData()
    {
        $query = Expense::query();

        // Apply filters based on selected parameters
        if ($this->start_date && $this->end_date) {
            $query->whereBetween('date', [$this->start_date, $this->end_date]);
        }

        if ($this->expensetype_id) {
            $query->where('expense_type_id', $this->expensetype_id);
        }

        if ($this->vehicle_file_no) {
            $query->where('vehicle_file_no', $this->vehicle_file_no);
        }

        // Fetch data based on filters
        $this->reportData = $query->orderBy('vehicle_file_no', 'asc')->get();
    }   
}
