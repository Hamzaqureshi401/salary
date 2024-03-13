<?php


namespace App\Http\Livewire\Admin\Limousines;
use App\Models\Limousine;
use App\Models\Driver;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Limousines extends Component
{
    public $limousine,$file_no,$plate_no,$owner_name,$vehicle_type, $vehicle_model, $registration_date,$status = true,$lang;
    public $driver_id, $driver, $rent_amount, $limousines, $getdriver ;
    /* render the page */
    public function render()
    {
        $this->limousines = Limousine::latest()->get();
        return view('livewire.admin.limousine.limousine');
    }
    /* process before render */
    public function mount()
    {
        $this->getdriver = Driver::all();
        

        $this->lang = getTranslation();
        if(!Auth::user()->can('limousine_list'))
        {
            abort(404);
        }
    }

    public function abc(){
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Limousine has been added!']);
    }
    /* store driver data */
    public function create()
    {
        $this->validate([
            'file_no'  => 'required',
            'plate_no'  => 'required',
            'registration_date'=>'required',
            'driver_id'=>'required',
            'rent_amount' => 'nullable|numeric',

        ]);
        $limousine = new Limousine();
        $limousine->file_no = $this->file_no;
        $limousine->plate_no = $this->plate_no;
        $limousine->owner_name = $this->owner_name;
        $limousine->vehicle_type = $this->vehicle_type;
        $limousine->vehicle_model = $this->vehicle_model;
        $limousine->registration_date = $this->registration_date;
        $limousine->driver_id = $this->driver_id;
        $limousine->rent_amount = $this->rent_amount;
        $limousine->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Limousine has been added!']);
    }

    /* reset driver data */
    public function edit(limousine $limousine)
    {
        $this->resetFields();
        $this->limousine = $limousine;
        $this->file_no = $limousine->file_no;
        $this->plate_no = $limousine->plate_no;
        $this->owner_name = $limousine->owner_name;
        $this->vehicle_type = $limousine->vehicle_type;
        $this->vehicle_model = $limousine->vehicle_model;
        $this->registration_date = $limousine->registration_date;
        $this->driver_id = $limousine->driver_id;
        $this->rent_amount= $limousine->rent_amount;

    }
    /* update driver data */
    public function update()
    {
        $this->validate([
            'file_no'  => 'required',
            'plate_no'  => 'required',
            'driver_id'  => 'required',
            'rent_amount' => 'nullable|integer', // Ensure it's nullable if you want to allow empty values


            
        ]);
        $limousine = $this->limousine;
        $limousine->file_no = $this->file_no;
        $limousine->plate_no = $this->plate_no;
        $limousine->owner_name = $this->owner_name;
        $limousine->vehicle_type = $this->vehicle_type;
        $limousine->vehicle_model = $this->vehicle_model;
        $limousine->registration_date = $this->registration_date;
        $limousine->driver_id = $this->driver_id;
        $limousine->rent_amount = $this->rent_amount;
        $limousine->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Limousine has been updated!']);
    }
    /* delete driver data */
    public function delete(Limousine $limousine)
    {
        $limousine->delete();
        $this->limousine = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Limousine has been deleted!']);
    }
    /* reset driver data */
    public function resetFields()
    {
        $this->file_no = '';
        $this->plate_no = '';
        $this->owner_name = '';
        $this->vehicle_type = '';
        $this->vehicle_model = '';
        $this->registration_date = '';
        $this->driver_id = '';
        $this->rent_amount = '';
        $this->resetErrorBag();
    }
}
