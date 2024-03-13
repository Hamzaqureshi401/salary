<?php

namespace App\Http\Livewire\Admin\Translation;

use App\Models\Translation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class AddTranslations extends Component
{
    use WithFileUploads;
    public $data = [], $default, $name, $is_active = 1,$lang,$icon;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.translation.add-translations');
    }

    /*Get translations from global.php file. */
    public function mount()
    {
        if (session()->has('selected_language')) {   /*if session has selected language */
            $this->lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            /* if session has no selected language */
            $this->lang = Translation::where('default', 1)->first();
        }
        foreach (config('global.translation.section') as $value) {
            foreach ($value['values'] as $key => $default) {
                $this->data[$key] = $default;
            }
        }
        if(!Auth::user()->can('add_translation'))
        {
            abort(404);
        }
    }

    /* Save translation. */
    public function save()
    {
        $this->validate([
            'name'  => 'required',
            'data.*' => 'required',
            'icon'  => 'image|required'
        ]);

        /* Set as default. */
        if ($this->default) {
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
        }

        Translation::create([
            'name'  => $this->name,
            'is_active' => $this->is_active,
            'default'   => $this->default,
            'data'  => $this->data,
            'image' => $imageurl
        ]);
        return redirect()->route('admin.translations');
    }
}
