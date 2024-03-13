<?php

namespace App\Http\Livewire\Admin\Aptsettings;
use App\Models\AptSetting;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Aptsettings extends Component
{
    public $aptsettings,$updateAptsettings,$lessthan39hours,$between39and77hours,$da_rate,$is_active = true,$lang;
    public $between78and116hours,$morethan117hours, $AptSetting;
    /* render the page */
    public function render()
    {
        $this->aptsettings = AptSetting::latest()->get();
        return view('livewire.admin.aptSettings.aptSettings');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('company_list'))
        {
            abort(404);
        }
    }
    public function edit(AptSetting $aptsettings)
    {
       $this->resetFields();
        $this->lessthan39hours = $aptsettings->lessthan39hours;
        $this->between39and77hours = $aptsettings->between39and77hours;
        $this->between78and116hours = $aptsettings->between78and116hours;
        $this->morethan117hours = $aptsettings->morethan117hours;
        $this->da_rate = $aptsettings->da_rate;
        $this->updateAptsettings = $aptsettings;
    }
    /* update customer data */
    public function update()
    {
        $this->validate([
            'lessthan39hours'  => 'required',
            'between39and77hours'  => 'required',
            'between78and116hours'  => 'required',
            'morethan117hours'  => 'required',
            'da_rate'  => 'required'
        ]);
        $aptsettings = $this->updateAptsettings;
        $aptsettings->lessthan39hours = $this->lessthan39hours;
        $aptsettings->between39and77hours = $this->between39and77hours;
        $aptsettings->between78and116hours = $this->between78and116hours;
        $aptsettings->morethan117hours = $this->morethan117hours;
        $aptsettings->da_rate=$this->da_rate;

        $aptsettings->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Information has been updated!']);
    }
    /* delete customer data */
   
    public function resetFields()
    {
        $this->name = '';
        $this->salary_date = '';
        $this->morethan117hours = '';
        $this->da_rate = '';
        $this->resetErrorBag();
    }
}
