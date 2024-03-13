<?php

namespace App\Http\Livewire\Components;

use App\Models\Translation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $translations,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.components.header');
    }
    /* process before render */
    public function mount()
    {
        $this->translations = Translation::where('is_active',1)->select('name','id','image')->get();
        if (session()->has('selected_language')) {   /*if session has selected language */
            $this->lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $this->lang = Translation::where('default', 1)->first();
        }
    }

    /* change the language */
    public function changeLanguage($id)
    {
        $language = Translation::where('id',$id)->first();
        session()->put('selected_language',$language->id);
        $this->emit('reloadpage');
    }
    /* logout */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
