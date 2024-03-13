<?php

namespace App\Http\Livewire\Admin\Reports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;
use App\Exports\DaywiseReportExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SalesReport extends Component
{
    public $start_date,$end_date,$data=[],$reportData=[],$search='',$lang,$partstype_id, $vehicle_file_no;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.istamara-report');
    }
    /* process before render */
    public function mount()
    {
        $this->getData();
        $this->lang = getTranslation();
        
        if(!Auth::user()->can('sales_report'))
        {
            abort(404);
        }
    }
    /* feach customer sales report*/
    public function getData(){
        $query = Vehicle::query()->orderBy('istamara_end_date', 'asc');
        $this->reportData = $query->get();
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
