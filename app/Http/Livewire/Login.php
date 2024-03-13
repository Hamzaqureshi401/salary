<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email,$password,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.login')->layout('layouts.login_layout');
    }
    /* login check */
    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password'  => 'required'
        ]);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        }
        else{
            $this->addError('login_error','Failed to login, check your credentials.');
        }
    }
    /* process before render */
    public function mount()
    {
        $this->lang = getTranslation();
    }
}
