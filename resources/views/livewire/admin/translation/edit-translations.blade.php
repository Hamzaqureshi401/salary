<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['edit_translation'] ?? 'Edit Translation'}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            <a href="{{ route('admin.translations') }}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3 ">
                            <label
                                class="form-label required">{{ $lang->data['language_name'] ?? 'Language Name' }}*</label>
                            <div>
                                <input type="text" wire:model="name" class="form-control"
                                    placeholder="{{ $lang->data['enter_language_name'] ?? 'Enter language name' }}">
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3 ">
                            <label
                                class="form-label required">{{ $lang->data['icon'] ?? 'Icon' }}*</label>
                            <div>
                                <input type="file" wire:model="icon" class="form-control"
                                    >
                                @error('icon')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-1 mt-1">
                <form>
                <div class="row">
                    @foreach (config('global.translation.section') as $value)
                    <div class="mb-3 col-md-12">
                            <h3 class="card-title">{{ $value['name'] }}</h3>
                            @foreach ($value['values'] as $key => $default)
                                <div class="form-group mb-3 row">
                                    <label
                                        class="col-3 col-form-label">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            wire:model="data.{{ $key }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                </form>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isVeg" wire:model="default">
                        <label class="form-check-label" for="isVeg">{{$lang->data['is_default'] ?? 'Is Default'}}</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isActive" wire:model="is_active">
                        <label class="form-check-label" for="isActive">{{$lang->data['is_active'] ?? 'isActive'}}</label>
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-end" wire:click.prevent="save">{{$lang->data['submit'] ?? 'Submit'}}</button>
            </div>
        </div>
    </div>
</div>
