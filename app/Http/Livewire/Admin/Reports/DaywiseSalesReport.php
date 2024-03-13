<?php

namespace App\Http\Livewire\Admin\Reports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\ExpenseType;
use App\Models\Maintainance;
use App\Models\VehicleAssigning;
use Illuminate\Support\Facades\DB;
use App\Exports\DaywiseReportExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DaywiseSalesReportExport;


class DaywiseSalesReport extends Component
{
    public $start_date, $assignings,$expenses,$maintenances,$end_date, $assignment_id,$vehicle_id, $data=[],$lang,$vehicle,$total_petrol,
$total_driver_cost;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.daywise-sales-report');
    }
    /* process before render */
    public function mount()
    {
        $this->start_date = Carbon::today()->startOfMonth()->toDateString();
        $this->end_date = Carbon::today()->toDateString();
        $this->assigning = VehicleAssigning::with(['vehicle', 'company', 'driver'])->where('status', 1)->get();
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->driver = Driver::where('status',1)->get();
        $this->company = Company::all();
        $this->expensetype = Expensetype::all();
        $this->lang = getTranslation();
        if(!Auth::user()->can('day_wise_sales_report'))
        {
            abort(404);
        }

    }
    /* feach daily sales report */
    public function getData()
    {

        // Fetch data from Expenses and Maintenances tables
        $assignings = VehicleAssigning::where('id', $this->assignment_id)
            // ->whereBetween('date', [$this->start_date, $this->end_date])->with('vehicle', 'company', 'driver')
            ->get();

            //dd($assignings , $this->assignment_id , $this->start_date, $this->end_date);

        $expenses = Expense::where('assignment_id', $this->assignment_id)
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->with('expensetype')
            ->get();

        $maintenances = Maintainance::where('assignment_id', $this->assignment_id)
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->get();

        $this->total_petrol = $expenses->where('expense_type_id' , 1)->sum('amount') ?? 0;
        $this->total_driver_cost =  $expenses->where('expense_type_id' , 2)->sum('amount') ?? 0;

        // Combine data from all three tables
        $this->data = [
            'assignings' => $assignings,
            'expenses' => $expenses,
            'maintenances' => $maintenances
        ];

        //dd($this->data);
    }   
    
    public function exportToExcel(){
        $this->getData();
        return Excel::download(new DaywiseReportExport($this->data ), 'bus-report.xlsx');
    }

    public function exportToPDF(){
        $this->getData();
        return Excel::download(new DaywiseReportExport($this->data ), 'bus-report.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
