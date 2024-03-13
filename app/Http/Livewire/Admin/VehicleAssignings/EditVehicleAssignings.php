<?php
namespace App\Http\Livewire\Admin\VehicleAssignings;
use App\Models\VehicleAssigning;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class EditVehicleAssignings extends Component
{
    public $assigning, $vehicleassigning,$date, $driver_id, $driver, $company_id, $vehicle_id, $end_of_time,  $amount, $lang,$file_no,$plate_no;
    /* render the page */  
    public function render()
    {
        return view('livewire.admin.assignings.edit-assignings');
    }
    /* process before render */
    public function mount($id)
    {
        $this->company = Company::get();
        $this->vehicle = Vehicle::get();
        $this->assigning = Vehicleassigning::find($id);
        $this->driver = Driver::where('id',$this->assigning->driver_id)->orWhere('status',0)->get();
        if(!$this->assigning)
        {
            abort(404);
        }
        $this->date= $this->assigning->date;
        $this->vehicle_id=$this->assigning->vehicle_id;
        $this->driver_id=$this->assigning->driver_id;
        $this->company_id=$this->assigning->company_id;
        $this->amount=$this->assigning->amount;
        $this->end_of_time=$this->assigning->end_of_time;
        if(!Auth::user()->can('edit_assigning'))
        {
            abort(404);
        }
    }
    /* update product data */
    public function update()
    {
        $this->validate([
            'date'  => 'required',
            'vehicle_id'  => 'required',
            'company_id'  => 'required',
            'driver_id'  => 'required',
            'amount' => 'required',
            'end_of_time' => 'required',
        ]);
        $previousDriver = Driver::find($this->assigning->driver_id);

        // Update the status of the previous driver to 0
        if ($previousDriver) {
            $previousDriver->update(['status' => '0']);
        }
        $this->assigning = $this->assigning;
        $this->assigning->date = $this->date;
        $this->assigning->vehicle_id = $this->vehicle_id;
        $this->assigning->company_id = $this->company_id;
        $this->assigning->driver_id = $this->driver_id;
        $this->assigning->amount= $this->amount;
        $this->assigning->end_of_time= $this->end_of_time;
        $this->assigning->save();

        $driver = Driver::find($this->driver_id);
        if ($driver) {
            $driver->update(['status' => '1']);
        }

        return redirect()->route('admin.view_assigning');
    }

    public function vehicleData(){
        $vehicle = Vehicle::find($this->vehicle_id);
        $this->file_no=$vehicle->file_no;
        $this->plate_no=$vehicle->plate_no;
    }
    public function companyData(){
        $cmp = Company::find($this->company_id);
        $this->contact_person=$cmp->project_owner;    
    }
}