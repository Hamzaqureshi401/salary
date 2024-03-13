<?php

namespace App\Http\Livewire\Admin\Maintainances;
use App\Models\Maintainance as ModelMaintainance;
use App\Models\Vehicle;
use App\Models\PartsType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Maintainances extends Component
{
    public $maintainances, $maintainance, $vehicle_id, $partstype, $vehicle, $date, $parts_type_id, $payment, $garage_services_charges, $description, $total, $lang;

    /* render the page */
    public function render()
    {
        $this->maintainances = ModelMaintainance::latest()->get();
        return view('livewire.admin.maintainance.view-maintainance');
    }
    /* process before render */
    public function mount()
    {
        $this->vehicle = Vehicle::where('status',1)->get();
        $this->partstype = PartsType::all();

        $this->lang = getTranslation();
        if(!Auth::user()->can('maintainance_list'))
        {
            abort(404);
        }
    }
  
    /* delete products with foreign key delete restriction */   
    public function delete(ModelMaintainance $maintainance)
    {       
        $maintainance->delete();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Maintainance has been deleted!']);
    }
}
