<?php

namespace App\Http\Livewire\Admin\Companies;
use App\Models\VehicleAssigning;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Companies extends Component
{
    public $companies,$company,$name,$site_branch,$is_active = true,$lang;
    public $project_area,$project_owner;
    /* render the page */
    public function render()
    {
        $this->companies = Company::latest()->get();
        return view('livewire.admin.companies.companies');
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
    /* store customer data */
    public function create()
    {
        $this->validate([
            'name'  => 'required',
            'site_branch'  => 'required'

        ]);
        $company = new Company();
        $company->name = $this->name;
        $company->site_branch = $this->site_branch;
        $company->project_area = $this->project_area;
        $company->project_owner = $this->project_owner;
        $company->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Customer has been created!']);
    }

    /* reset customer data */
    public function edit(Company $company)
    {
        $this->resetFields();
        $this->company = $company;
        $this->name = $company->name;
        $this->site_branch = $company->site_branch;
        $this->project_area = $company->project_area;
        $this->project_owner = $company->project_owner;
    }
    /* update customer data */
    public function update()
    {
        $this->validate([
            'name'  => 'required',
            'site_branch'  => 'required'
        ]);
        $company = $this->company;
        $company->name = $this->name;
        $company->site_branch = $this->site_branch;
        $company->project_area = $this->project_area;
        $company->project_owner = $this->project_owner;
        $company->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Company has been updated!']);
    }
    /* delete customer data */
    public function delete(Company $company)
    {   
        if(VehicleAssigning::where('company_id',$company->id)->count() > 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Company deletion restricted! This Company Using our Vehicle']);
            return 0;
        }
        $company->delete();
        $this->company = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Company has been deleted!']);
    }
    /* reset customer data */
    public function resetFields()
    {
        $this->name = '';
        $this->site_branch = '';
        $this->project_area = '';
        $this->project_owner = '';
        $this->resetErrorBag();
    }
}
