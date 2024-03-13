<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateStaff extends Component
{
    public $name, $phone, $email, $password, $address, $is_active = 1, $staffs, $staff, $inputi, $selected_permissions = [];
    /* render the page */
    public function render()
    {
        $this->lang = getTranslation();
        if (Auth::user()->can('add_staff')) {
        return view('livewire.admin.staff.create-staff');
        } else {
            abort(404);
        }
    }
    /* reset the properties */
    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->address = '';
        $this->is_active = 1;
        $this->staff = null;
    }

   /* save staff data */
   public function save()
   {
       $validator = Validator::make([
           'name' => $this->name,
           'phone' => $this->phone,
           'email' => $this->email,
           'password' => $this->password,
       ], [
           'name' => 'required',
           'phone' => 'required',
           'email' => 'required|unique:users',
           'password' => 'required'
       ]);

       $validator->validate();
       $count_user_permission = 0;
       foreach ($this->selected_permissions as $key => $value) {
           if ($value === true) {
               $count_user_permission++;
           }
       }
       if ($count_user_permission > 0) {
           $user = User::create([
               'name'  => $this->name,
               'phone' => $this->phone,
               'email' => $this->email,
               'address' => $this->address,
               'password'  => Hash::make($this->password),
               'user_type' => 2,
           ]);
           /* add permissions */
           if ($this->selected_permissions) {
               foreach ($this->selected_permissions as $key => $value) {
                   if ($value === true) {
                       \App\Models\ModelPermission::create([
                           'user_id'  => $user->id,
                           'permission_id'    => $key,
                       ]);
                   }
               }
           }
           $this->emit('savemessage', ['type' => 'success', 'title' => 'Success', 'message' => 'Staff' . $this->name . ' Was Successfully Added!']);
           redirect()->route('admin.staffs');
       } else {
           $this->dispatchBrowserEvent(
               'alert',
               ['type' => 'error',  'message' => 'Please Choose atleaset 1 permission.']
           );
           return 1;
       }
   }
}
