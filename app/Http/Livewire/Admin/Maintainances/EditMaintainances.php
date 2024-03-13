<?php
namespace App\Http\Livewire\Admin\Maintainances;

use App\Models\Driver;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\PartsType;
use App\Models\ExpenseType;
use App\Models\Maintainance;
use App\Models\VehicleAssigning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EditMaintainances extends Component
{
    public $maintainances, $maintainance,$vehicleFileNo, $vehicle_id, $partstype, $assignment_id,$partstype_id, $vehicle, $date, $parts_type_id, $payment=0, $garage_services_charges=0, $description, $total, $lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.maintainance.edit-maintainance');
    }
    /* process before render */
    public function mount($id)
    {
        $this->date = date('Y-m-d');
        $this->assigning = VehicleAssigning::with(['vehicle', 'company', 'driver'])->get();
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->driver = Driver::where('status',1)->get();
        $this->company = Company::all(); 
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->partstype = PartsType::all();
       
        $this->maintainance = Maintainance::find($id);
        if(!$this->maintainance)
        {
            abort(404);
        }
        $this->date = $this->maintainance->date;
        $this->assignment_id = $this->maintainance->assignment_id;
        $this->vehicle_file_no= $this->maintainance->vehicleFileNo;
        $this->partstype_id = $this->maintainance->parts_type_id;
        $this->payment= $this->maintainance->payment;
        $this->garage_services_charges= $this->maintainance->garage_services_charges;
        $this->description= $this->maintainance->description ;
        $this->total= $this->maintainance->total;
        if(!Auth::user()->can('edit_maintainance'))
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
            'partstype_id'  => 'required',
            'payment' => 'required',
            'garage_services_charges'=>'required'
         

        ]);
        $maintainance = $this->maintainance;
        $maintainance->date = $this->date;
        $maintainance->assignment_id = $this->assignment_id;
        $maintainance->vehicle_file_no= $this->vehicleFileNo;
        $maintainance->parts_type_id = $this->partstype_id;
        $maintainance->payment= $this->payment;
        $maintainance->garage_services_charges= $this->garage_services_charges;
        $maintainance->description=$this->description ;
        $maintainance->total=$this->total;
        $maintainance->save();
        return redirect()->route('admin.maintainance');
    }

    public function assignfileno(){
        $file = VehicleAssigning::where('id',$this->assignment_id)->first();
        
        $this->vehicleFileNo = $file->vehicle->file_no;
    }

    public function totalAmount(){
        $this->total=$this->payment + $this->garage_services_charges;
    }
}