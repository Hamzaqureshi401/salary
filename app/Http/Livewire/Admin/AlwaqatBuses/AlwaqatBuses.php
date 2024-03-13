<?php
namespace App\Http\Livewire\Admin\AlwaqatBuses
;
use App\Models\AlwaqatBus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AlwaqatBuses extends Component
{
    public $limousine,$file_no,$plate_no,$mobile,$owner_name,$vehicle_type, $vehicle_model, $registration_date,$status = true,$lang;
    public $limousines ;
    /* render the page */
    public function render()
    {
        $this->limousines = AlwaqatBus::latest()->get();
        return view('livewire.admin.limousine.alwaqatbus');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('alwaqatbus_list'))
        {
            abort(404);
        }
    }

    public function abc(){
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Alwaqat Bus has been added!']);
    }
    /* store driver data */
    public function create()
    {
        $this->validate([
            'file_no'  => 'required',
            'plate_no'  => 'required',
            'registration_date'=>'required',
        ]);
        $limousine = new AlwaqatBus();
        $limousine->file_no = $this->file_no;
        $limousine->plate_no = $this->plate_no;
        $limousine->owner_name = $this->owner_name;
        $limousine->vehicle_type = $this->vehicle_type;
        $limousine->vehicle_model = $this->vehicle_model;
        $limousine->registration_date = $this->registration_date;
        $limousine->mobile = $this->mobile;
  
        $limousine->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Alwaqat Bus has been added!']);
    }

    /* reset driver data */
    public function edit(AlwaqatBus $limousine)
    {
        $this->resetFields();
        $this->AlwaqatBus = $limousine;
        $this->file_no = $limousine->file_no;
        $this->plate_no = $limousine->plate_no;
        $this->owner_name = $limousine->owner_name;
        $this->vehicle_type = $limousine->vehicle_type;
        $this->vehicle_model = $limousine->vehicle_model;
        $this->registration_date = $limousine->registration_date;
        $this->mobile = $limousine->mobile;
    
        
    }
    /* update driver data */
    public function update()
    {
        $this->validate([
            'file_no'  => 'required',
            'plate_no'  => 'required',
            'registration_date'=>'required',
          
            
        ]);
        $limousine = $this->AlwaqatBus;
        $limousine->file_no = $this->file_no;
        $limousine->plate_no = $this->plate_no;
        $limousine->owner_name = $this->owner_name;
        $limousine->vehicle_type = $this->vehicle_type;
        $limousine->vehicle_model = $this->vehicle_model;
        $limousine->registration_date = $this->registration_date;
        $limousine->mobile = $this->mobile;
        $limousine->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Alwaqat Bus has been updated!']);
    }
    /* delete driver data */
    public function delete(AlwaqatBus $limousine)
    {
        $limousine->delete();
        $this->AlwaqatBus = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Alwaqat Bus has been deleted!']);
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
        $this->resetErrorBag();
    }
}
