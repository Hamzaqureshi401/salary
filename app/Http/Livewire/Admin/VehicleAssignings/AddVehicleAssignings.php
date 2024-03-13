<?php

namespace App\Http\Livewire\Admin\VehicleAssignings;
use App\Models\VehicleAssigning;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class AddVehicleAssignings extends Component
{
    public $assigning, $date, $cmp, $vehicleassigning,$selectedVehicle, $selectedVehicleDetails, $driver_id, $company_id, $vehicle_id, $end_of_time,  $amount, $lang,$file_no,$plate_no;
    
    /* render the page */
    public function render()
     {
        return view('livewire.admin.assignings.add-assignings');
    }
    /* process before render */
    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->vehicle = Vehicle::where('status',0)->get();
        $this->driver = Driver::where('status',0)->get();
        $this->company = company::all();

        if(!Auth::user()->can('add_assigning'))
        {
            abort(404);
        }
    }
    /* store products*/
    public function create()
    {
        $this->validate([
            'date'  => 'required',
            'vehicle_id'  => 'required',
            'company_id'  => 'required',
            'driver_id'  => 'required',
            'amount' => 'required',
            'end_of_time' => 'required',
        ]);
        
        $assigning = new VehicleAssigning();
        $assigning->date = $this->date;
        $assigning->vehicle_id = $this->vehicle_id;
        $assigning->vehicle_file_no = $this->file_no;
        $assigning->company_id = $this->company_id;
        $assigning->driver_id = $this->driver_id;
        $assigning->amount = $this->amount;
        $assigning->end_of_time = $this->end_of_time;
        $assigning->status = '1';
        $assigning->save();
    
        $driver = Driver::find($this->driver_id);
        $vehicle = Vehicle::find($this->vehicle_id);
        $company = Company::find($this->company_id);
    
        if ($driver) {
            $driver->update(['status' => '1']);
        }
    
        if ($vehicle) {
            $vehicle->update(['status' => '1']);
        }
    
        return redirect()->route('admin.view_assigning');
    }
        public function vehicleData(){
        $file = Vehicle::where('id',$this->vehicle_id)->first();
        
        $this->file_no = $file->file_no;
        $this->owner_name= $file->owner_name;
    }
    public function companyData(){
        $file = Company::where('id',$this->company_id)->first();
        
        $this->contact_person = $file->site_branch;
        
    }


}
