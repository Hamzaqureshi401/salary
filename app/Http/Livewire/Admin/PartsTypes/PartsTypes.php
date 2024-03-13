<?php

namespace App\Http\Livewire\Admin\PartsTypes;
use App\Models\Maintainance;
use App\Models\PartsType as ModelsPartsType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PartsTypes extends Component
{
    public $partstype,$name,$partstypes,$is_active = true,$lang;
    /* render the page */
    public function render()
    {
        $this->partstypes = ModelsPartsType::latest()->get();
        return view('livewire.admin.parts-type.parts-type');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('parts_list'))
        {
            abort(404);
        }
    }
    /* store category */
    public function create()
    {
        $this->validate([
            'name'  => 'required',
        ]);
        $partstype = new ModelsPartsType();
        $partstype->name = $this->name;
        $partstype->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Parts Type has been created!']);
    }
    /* edit category */
    public function edit(ModelsPartsType $partstype)
    {
        $this->resetFields();
        $this->partstype = $partstype;
        $this->name = $partstype->name;
    }
    /* update category details */
    public function update()
    {
        $this->validate([
            'name'  => 'required',
        ]);
        $partstype = $this->partstype;
        $partstype->name = $this->name;
        $partstype->save();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Parts Type has been updated!']);
    }
    /* delete category with foreign key delete restriction */
    public function delete(ModelsPartsType $partstype)
    {
        if(Maintainance::where('parts_type_id',$partstype->id)->count() > 0)
        {
            $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Parts Type deletion restricted!']);
            return 0;
        }
        $partstype->delete();
        $this->partstype = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Parts Type has been deleted!']);
    }
    /* reset fields */
    public function resetFields()
    {
        $this->resetErrorBag();
        $this->name = '';
    }
}
