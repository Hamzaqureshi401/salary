<?php

namespace App\Http\Livewire\Admin\Translation;

use App\Models\Translation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Translations extends Component
{
    public $translations,$translation,$lang;
    /* render the page */
    public function render()
    {
        $this->translations = Translation::latest()->get();
        return view('livewire.admin.translation.translations');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
        if(!Auth::user()->can('translations_list'))
        {
            abort(404);
        }
    }
    /* delete translations */
    public function delete()
    {
        $this->translation->delete();
        $this->translation = null;
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Translation has been deleted!']);
    }
}
