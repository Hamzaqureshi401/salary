<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;
use App\Models\User;
use App\Models\ModelPermission;
use Illuminate\Support\Facades\Auth;

class ViewStaffs extends Component
{
    /* render the page */
    public function render()
    {
        $this->staffs =User::where('user_type',2)->latest()->get();
        $this->lang = getTranslation();
        if (Auth::user()->can('staffs_list')) {
            return view('livewire.admin.staff.view-staffs');
            } else {
                abort(404);
            }
    }
    /* delete staff */
    public function delete($id)
    {
        $staff = User::find($id);
        if($staff) {
        $previous_permissions = ModelPermission::where('user_id',$staff->id)->get();
        foreach($previous_permissions as $row) {
            $row->delete();
        }
        $staff->delete();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Staff was deleted!']);
        }
    }
}
