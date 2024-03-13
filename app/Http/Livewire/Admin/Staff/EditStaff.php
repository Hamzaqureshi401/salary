<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelPermission;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;

class EditStaff extends Component
{
    public $name, $phone, $email, $password, $address, $is_active, $staffs, $selected_permissions, $current_id;
    /* render the page */
    public function render()
    {
        $this->lang = getTranslation();
        if (Auth::user()->can('edit_staff')) {
        return view('livewire.admin.staff.edit-staff');
        } else {
            abort(404);
        }
    }
    /* process before render */
    public function mount($id){
        $this->selected_permissions = [];
        $current_id = $id;
        $this->staff = User::where('id', $id)->where('user_type', 2)->first();
        if ($this->staff) {
            $this->staff = User::find($id);
            $this->name = $this->staff->name;
            $this->email = $this->staff->email;
            $this->phone = $this->staff->phone;
            $this->address = $this->staff->address;
            $selected_permissions = ModelPermission::where('user_id', $id)->get();
            foreach ($selected_permissions as $row) {
                $this->selected_permissions[$row->permission_id] = true;
            }
        } else {
            abort(404);
        }
        $count_permission = Permission::count();
        $count_user_permission = ModelPermission::where('user_id', $this->staff->id)->count();
        if ($count_permission == $count_user_permission) {
            $this->check_all = true;
        } else {
            $this->check_all = false;
        }
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
              'email' => 'required|unique:users,email,' . $this->staff->id,
          ]);
          $validator->validate();
          $count_user_permission = 0;
          foreach ($this->selected_permissions as $key => $value) {
              if ($value === true) {
                  $count_user_permission++;
              }
          }
          if ($count_user_permission > 0) {
              $this->staff->name = $this->name;
              $this->staff->email = $this->email;
              $this->staff->phone = $this->phone;
              $this->staff->address = $this->address ?? 0;
              if ($this->password != '') {
                  $this->staff->password = Hash::make($this->password);
              }
              $this->staff->save();
              $previous_permissions = ModelPermission::where('user_id', $this->staff->id)->get();
              foreach ($previous_permissions as $row) {
                  $row->delete();
              }
              /* add permissions */
              if ($this->selected_permissions) {
                  foreach ($this->selected_permissions as $key => $value) {
                      if ($value === true) {
                          \App\Models\ModelPermission::create([
                              'user_id'  => $this->staff->id,
                              'permission_id'    => $key,
                          ]);
                      }
                  }
              }
              $this->emit('savemessage', ['type' => 'success', 'title' => 'Success', 'message' => 'Staff' . $this->name . ' Was Successfully Updated!']);
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
