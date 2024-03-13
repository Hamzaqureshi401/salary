<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountSettings extends Component
{
    public $name,$contact,$email,$password,$address,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.settings.account-settings');
    }
    /* process before render */
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->contact = $user->phone;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->lang = getTranslation();
        if(!Auth::user()->can('account_settings'))
        {
            abort(404);
        }
    }
    /* save master settings */
    public function save()
    {
        $this->validate([
            'name'  => 'required',
            'email' => 'email|required|unique:users,email,'.Auth::user()->id,
            'contact'   => 'required'
        ]);
        $user = User::find(Auth::user()->id);
        if($this->password != "" && $this->password != null)
        {   
            $user->password = Hash::make($this->password);
        }
        $user->name = $this->name;
        $user->phone = $this->contact;
        $user->email = $this->email;
        $user->address = $this->address;
        $user->save();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success', 'message' => 'Settings have been saved..']);
    }
}
