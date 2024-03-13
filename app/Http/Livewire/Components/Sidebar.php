<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $lang;
    /* render the page */
    public function render()
    {
        return view('livewire.components.sidebar');
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
    }
    /* logout */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
