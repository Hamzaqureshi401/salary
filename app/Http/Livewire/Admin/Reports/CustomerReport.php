<?php

namespace App\Http\Livewire\Admin\Reports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\PartsType;
use App\Models\Maintainance;
use App\Exports\DaywiseReportExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CustomerReport extends Component
{
    public $start_date,$end_date,$data=[],$reportData=[],$search='',$lang,$partstype_id, $vehicle_file_no;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.customer-report');
    }
    /* process before render */
    public function mount()
    {
        $this->start_date = Carbon::today()->startOfMonth()->toDateString();
        $this->end_date = Carbon::today()->toDateString();
        $this->partstype = Partstype::all();
        $this->maintain = Maintainance::all();
        $this->vehicle = Vehicle::orderBy('file_no', 'asc')->get();
        $this->lang = getTranslation();
        if(!Auth::user()->can('customer_report'))
        {
            abort(404);
        }
    }
    /* feach customer sales report*/
    public function getData()
    {
        $query = Maintainance::query();

        // Apply filters based on selected parameters
        if ($this->start_date && $this->end_date) {
            $query->whereBetween('date', [$this->start_date, $this->end_date]);
        }

        if ($this->partstype_id) {
            $query->where('parts_type_id', $this->partstype_id);
        }

        if ($this->vehicle_file_no) {
            $query->where('vehicle_file_no', $this->vehicle_file_no);
        }

        // Fetch data based on filters
        $this->reportData = $query->orderBy('vehicle_file_no', 'asc')->get();
        $this->data[]=$this->reportData;
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
