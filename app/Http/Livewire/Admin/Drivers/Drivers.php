<?php


namespace App\Http\Livewire\Admin\Drivers;
use App\Models\Driver;
use App\Models\Limousine;
use App\Models\VehicleAssigning;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Drivers extends Component
{
    public $driver,$name,$mobile_no,$registration_date,$status = true,$lang;
    public $monthly_salary, $drivers ;
    /* render the page */
    public function render()
    {
        $this->drivers = Driver::latest()->get();
        return view('livewire.admin.driver.driver');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('driver_list'))
        {
            abort(404);
        }
    }
    /* store driver data */
    public function create()
    {
        $this->validate([
            'name'  => 'required',
            'mobile_no'  => 'required',
            'registration_date'  => 'required',
            'monthly_salary'  => 'required',
        ]);
        $driver = new Driver();
        $driver->name = $this->name;
        $driver->mobile_no = $this->mobile_no;
        $driver->registration_date = $this->registration_date;
        $driver->monthly_salary = $this->monthly_salary;
        $driver->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Driver has been added!']);
    }

    /* reset driver data */
    public function edit(Driver $driver)
    {
        $this->resetFields();
        $this->driver = $driver;
        $this->name = $driver->name;
        $this->mobile_no = $driver->mobile_no;
        $this->registration_date = $driver->registration_date;
        $this->monthly_salary = $driver->monthly_salary;
    }
    /* update driver data */
    public function update()
    {
        $this->validate([
            'name'  => 'required',
            'mobile_no'  => 'required',
            'registration_date'  => 'required',
            'monthly_salary'  => 'required',
        ]);
        $driver = $this->driver;
        $driver->name = $this->name;
        $driver->mobile_no = $this->mobile_no;
        $driver->registration_date = $this->registration_date;
        $driver->monthly_salary = $this->monthly_salary;
        $driver->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Driver has been updated!']);
    }
    /* delete driver data */
    public function delete(Driver $driver)
    {   
        if(VehicleAssigning::where('driver_id',$driver->id)->count() > 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Driver deletion restricted!  Driver is Assigned to Vehicle']);
            return 0;
        }
        elseif(Limousine::where('driver_id',$driver->id)->count() > 0)
         {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Driver deletion restricted!  Driver is Assigned to Vehicle']);
            return 0;
        }
        $driver->delete();
        $this->driver = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Driver has been deleted!']);
    }
    /* reset driver data */
    public function resetFields()
    {
        $this->name = '';
        $this->mobile_no = '';
        $this->registration_date = '';
        $this->monthly_salary = '';
        $this->resetErrorBag();
    }
}
