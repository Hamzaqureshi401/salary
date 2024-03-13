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

class BusOwnerReport extends Component
{
    public $start_date, $selectedOwner,$reportData,$total_petrol_expense,$maintenances,$end_date, $owners, $assignment_id,$vehicle_id, $data=[],$lang,$vehicle;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.bus_owner_report');
    }
    public function mount()
    {
        $this->start_date = Carbon::today()->startOfMonth()->toDateString();
        $this->end_date = Carbon::today()->toDateString();
        $this->vehicle = array_unique(Vehicle::pluck('owner_name')->toArray());

        //dd($this->vehicle);


        $this->lang = getTranslation();
        if(!Auth::user()->can('customer_report'))
        {
            abort(404);
        }
    }
public function getData()
{
    $start_date = $this->start_date;
    $end_date = $this->end_date;

    if(empty($this->selectedOwner)){
        $owner = array_unique(Vehicle::pluck('owner_name')->toArray());
        $qur = 'whereIn';
    }else{
        $owner = $this->selectedOwner;
        $qur = 'where';
    }

    $this->reportData = Vehicle::with(['assigning.expenses', 'assigning.maintainance'])
    ->$qur('owner_name', $owner)
    ->whereHas('assigning.expenses', function ($query) use ($start_date, $end_date) {
        $query->whereBetween('date', [$start_date, $end_date]);
    })
    // ->whereHas('assigning.maintainance', function ($query) use ($start_date, $end_date) {
    //     $query->whereBetween('date', [$start_date, $end_date]);
    // })
     ->get();

    //dd($this->reportData , $owner , $qur);

    

    // dd($this->reportData->assigning->sum('amount') 
    //     , $this->reportData->
    //     , $this->reportData->
    //     , $this->reportData->);


    // $this->reportData = DB::table('vehicles')
    //     ->select(
    //         'vehicles.id',
    //         'vehicles.owner_name',
    //         'vehicles.file_no',
    //         'vehicle_assignings.id',
    //         'vehicle_assignings.amount',
    //         'maintainances.total as total_maintenance_cost',
    //         DB::raw('SUM(CASE WHEN expenses.expense_type_id = 2 THEN expenses.amount ELSE 0 END) AS total_salary_expenses'),
    //         DB::raw('SUM(CASE WHEN expenses.expense_type_id = 1 THEN expenses.amount ELSE 0 END) AS total_petrol_expenses'),
    //         // DB::raw('SUM(CASE WHEN maintainances.assignment_id = vehicle_assignings.id THEN maintainances.total ELSE 0 END) AS total_maintenance_cost'),
    //         'vehicle_assignings.amount AS total_rent'
    //     )
    //     ->leftJoin('vehicle_assignings', 'vehicles.id', '=', 'vehicle_assignings.vehicle_id')
    //     ->leftJoin('expenses', 'vehicle_assignings.id', '=', 'expenses.assignment_id')
    //     ->leftJoin('maintainances', 'vehicle_assignings.id', '=', 'maintainances.assignment_id')
    //     ->where('vehicles.id', $this->selectedOwner)
    //     ->whereBetween('vehicle_assignings.date', [$this->start_date, $this->end_date])
    //     ->groupBy(
    //         'vehicles.id',
    //         'vehicles.owner_name',
    //         'vehicles.file_no',
    //         'vehicle_assignings.id',
    //         'vehicle_assignings.amount',
    //         'maintainances.total'
    //     )
    //     ->get();
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
