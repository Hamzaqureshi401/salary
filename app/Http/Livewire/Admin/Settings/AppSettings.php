<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\MasterSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;
class AppSettings extends Component
{
    use WithFileUploads;
    public $name,$logo,$favicon,$phone,$email,$currency_symbol,$tax_percentage,$address,$lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.settings.app-settings');
    }
    /* process before render */
    public function mount()
    {
        $setting = new MasterSetting();
        $settings = $setting->siteData();
        $this->name = $settings['store_name'] ?? '';
        $this->phone = $settings['store_phone'] ?? '';
        $this->email = $settings['store_email'] ?? '';
        $this->currency_symbol = $settings['currency_symbol'] ?? '';
        $this->tax_percentage = $settings['tax_percentage'] ?? '';
        $this->address = $settings['address'] ?? '';
        $this->lang = getTranslation();
        if(!Auth::user()->can('app_settings'))
        {
            abort(404);
        }
    }
    /* save app settings */
    public function save()
    {
        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'currency_symbol'   => 'required',
            'tax_percentage'    => 'required'
        ]);
        $setting = new MasterSetting();
        $settings = $setting->siteData();
        $settings['store_name'] = $this->name;
        $settings['store_phone'] = $this->phone;
        $settings['store_email'] = $this->email;
        $settings['currency_symbol'] = $this->currency_symbol;
        $settings['tax_percentage'] = $this->tax_percentage;
        $settings['address'] = $this->address;
        if($this->logo){
            $default_image = $this->logo;
            $input['file'] = time().'.'.$default_image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/logo/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imgFile = Image::make($this->logo->getRealPath());
            $imgFile->resize(1000,1000,function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath.'/'.$input['file']);
            $imageurl = '/uploads/logo/'.$input['file'];
            $settings['logo'] = $imageurl;
        }
        if($this->favicon){
            $default_image = $this->favicon;
            $input['file'] = time().'.'.$default_image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/site/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imgFile = Image::make($this->favicon->getRealPath());
            $imgFile->resize(1000,1000,function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath.'/'.$input['file']);
            $imageurl = '/uploads/site/'.$input['file'];
            $settings['favicon'] = $imageurl;
        }
        foreach ($settings as $key => $value) {
            MasterSetting::updateOrCreate(['master_title' => $key], ['master_value' => $value]);
        }
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success', 'message' => 'Settings have been saved..']);
    }
}
