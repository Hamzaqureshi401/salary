<?php

namespace App\Http\Livewire\Admin\Maintainances;
use App\Models\Maintainance as ModelMaintainance;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Company;
use App\Models\VehicleAssigning;
use App\Models\PartsType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class AddMaintainances extends Component
{
    
    public $maintainances, $maintainance,$vehicleFileNo, $vehicle_id, $partstype, $assignment_id,$partstype_id, $vehicle, $date, $parts_type_id, $payment=0, $garage_services_charges=0, $description, $total, $lang;

    /* render the page */
    public function render()
    {
        return view('livewire.admin.maintainance.add-maintainance');
    }
    /* process before render */
    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->assigning = VehicleAssigning::with(['vehicle', 'company', 'driver'])
    ->where('status', 1)
    ->orderBy('vehicle_file_no', 'asc')
    ->get();

        $this->vehicle = Vehicle::where('status',1)->get();
        $this->driver = Driver::where('status',1)->get();
        $this->company = Company::all(); 
      
        $this->partstype = PartsType::all();

        if(!Auth::user()->can('add_maintainance'))
        {
            abort(404);
        }
    }
    /* store products*/
    public function create()
    {
        $this->validate([
            'date'  => 'required',
            'assignment_id'  => 'required',
            'partstype_id'  => 'required',
            'payment' => 'required',
            'garage_services_charges'=>'required'
         

        ]);
        $maintainance = new ModelMaintainance();
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
