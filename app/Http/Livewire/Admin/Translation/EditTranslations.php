<?php

namespace App\Http\Livewire\Admin\Translation;

use App\Models\Translation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Image;
use Livewire\WithFileUploads;

class EditTranslations extends Component
{
    use WithFileUploads;
    public $data = [], $default, $name, $is_active = 1, $lang,$translation,$icon;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.translation.edit-translations');
    }
    /* process before render */
    public function mount($id)
    {
        if (session()->has('selected_language')) {   /*if session has selected language */
            $this->lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $this->lang = Translation::where('default', 1)->first();
        }
        $translation = Translation::where('id', $id)->first();
        /* if translation is not empty */
        if (!$translation) {
            abort(404);
        }
        $this->data = $translation->data;
        $this->name = $translation->name;
        $this->is_active = $translation->is_active;
        $this->default = $translation->default;
        $this->translation = $translation;
        if(!Auth::user()->can('edit_translation'))
        {
            abort(404);
        }
    }

    /* save the content */
    public function save()
    {
        $this->validate([
            'name'  => 'required',
            'data.*' => 'required',
            'icon'  => 'nullable|image'
        ]);
        if ($this->default && $this->translation->default == 0) {
            Translation::where('default', 1)->update(
                [
                    'default' => 0
                ]
            );
        }
        $imageurl = '';
        if($this->icon){
            $default_image = $this->icon;
            $input['file'] = time().'.'.$default_image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/translations/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imgFile = Image::make($this->icon->getRealPath());
            $imgFile->resize(1000,1000,function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath.'/'.$input['file']);
            $imageurl = '/uploads/translations/'.$input['file'];
            $this->translation->image = $imageurl;
        }
        $this->translation->name = $this->name;
        $this->translation->data = $this->data;
        $this->translation->is_active = $this->is_active;
        $this->translation->default = $this->default;
        $this->translation->save();
        return redirect()->route('admin.translations');
    }
}
