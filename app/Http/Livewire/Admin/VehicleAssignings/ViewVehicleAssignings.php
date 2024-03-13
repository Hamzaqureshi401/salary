<?php

namespace App\Http\Livewire\Admin\VehicleAssignings;
use App\Models\VehicleAssigning;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewVehicleAssignings extends Component
{
    public $assignings, $vehicleassigning,$date, $expense_type_id, $amount, $lang;
    /* render the page */
    public function render()
    {
        $this->assignings = VehicleAssigning::latest()->get();
        return view('livewire.admin.assignings.view-assignings');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('assigning_list'))
        {
            abort(404);
        }
    }
    /* delete products with foreign key delete restriction */   
    public function end_assigning($vehicleAssigningId)
    {
        // Find the VehicleAssigning record by ID
        $vehicleAssigning = VehicleAssigning::find($vehicleAssigningId);

        if ($vehicleAssigning) {
            $vehicleAssigning->update(['status' => '0']);

            $driver = Driver::find($vehicleAssigning->driver_id);
            if ($driver) {
                $driver->update(['status' => '0']);
            }

            $vehicle = Vehicle::find($vehicleAssigning->vehicle_id);
            if ($vehicle) {
                $vehicle->update(['status' => '0']);
            }

        }
    }


    public function delete(VehicleAssigning $assigning)
    {
       
        $assigning->delete();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Aggrement has been deleted!']);
    }
}
