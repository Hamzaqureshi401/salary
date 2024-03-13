<?php


namespace App\Http\Livewire\Admin\vehicles;
use App\Models\Vehicle;
use App\Models\VehicleAssigning;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Vehicles extends Component
{
    public $vehicle,$file_no,$plate_no,$owner_name,$vehicle_type, $vehicle_model, $registration_date,$status = true,$lang;
    public $insurance_start_date,$insurance_end_date, $vehicles,$recordId,$fuel_type,$istamara_end_date ;
    /* render the page */
    public function render()
    {
        $this->vehicles = Vehicle::latest()->get();
        return view('livewire.admin.vehicle.vehicle');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('vehicles_list'))
        {
            abort(404);
        }
    }

    public function abc(){
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Vehicle has been added!']);
    }
    /* store driver data */
    public function create()
    {
        $this->validate([
            'file_no' => 'required|unique:vehicles,file_no',
            'plate_no'  => 'required',
            'registration_date'=>'required',    
            'insurance_start_date'=>'required',
            'istamara_end_date'=>'required',

        ]);
        $vehicle = new Vehicle();
        $vehicle->file_no = $this->file_no;
        $vehicle->plate_no = $this->plate_no;
        $vehicle->owner_name = $this->owner_name;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_model = $this->vehicle_model;
        $vehicle->registration_date = $this->registration_date;
        $vehicle->insurance_end_date = $this->insurance_start_date;
        $vehicle->istamara_end_date = $this->istamara_end_date;
        $vehicle->fuel_type=$this->fuel_type;
        $vehicle->status= 0;
        $vehicle->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Vehicle has been added!']);
    }

    /* reset driver data */
    public function edit(Vehicle $vehicle)
    {
        $this->resetFields();
        $this->vehicle = $vehicle;
        $this->file_no = $vehicle->file_no;
        $this->plate_no = $vehicle->plate_no;
        $this->owner_name = $vehicle->owner_name;
        $this->vehicle_type = $vehicle->vehicle_type;
        $this->vehicle_model = $vehicle->vehicle_model;
        $this->registration_date = $vehicle->registration_date;
        $this->istamara_end_date = $vehicle->istamara_end_date;
        $this->insurance_end_date = $vehicle->insurance_end_date;
        $this->fuel_type=$vehicle->fuel_type;
    }
    /* update driver data */
    public function update()
    {
             $this->validate([
            
            'file_no' =>'required',
            
            'registration_date'=>'required',    
            'istamara_end_date'=>'required',
            'insurance_end_date'=>'required',
        ]);
        
        $vehicle = $this->vehicle;
        $vehicle->file_no = $this->file_no;
        $vehicle->plate_no = $this->plate_no;
        $vehicle->owner_name = $this->owner_name;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_model = $this->vehicle_model;
        $vehicle->registration_date = $this->registration_date;
        $vehicle->istamara_end_date = $this->istamara_end_date;
        $vehicle->insurance_end_date = $this->insurance_end_date;
        $vehicle->fuel_type=$this->fuel_type;
        $vehicle->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Vehicle has been updated!']);
    }
    /* delete driver data */
    public function delete(Vehicle $vehicle)
    {
        if(VehicleAssigning::where('vehicle_id',$vehicle->id)->count() > 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Vehicle Type deletion restricted!']);
            return 0;
        }
        
        $vehicle->delete();
        $this->vehicle = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Vehicle has been deleted!']);
    }
    /* reset driver data */
    public function resetFields()
    {
        $this->resetErrorBag();
        $this->file_no = '';
        $this->plate_no = '';
        $this->owner_name = '';
        $this->vehicle_type = '';
        $this->vehicle_model = '';
        $this->registration_date = '';
        $this->istamara_end_date = '';
        $this->insurance_end_date = '';
        $this->fuel_type='';
    }
}
