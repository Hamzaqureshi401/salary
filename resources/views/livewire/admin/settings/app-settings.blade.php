<div>
   
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['app_settings'] ?? 'App Settings'}}</strong></h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.dashboard')}}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['store_name'] ?? 'Store Name '}}<span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['enter_store_name'] ?? 'Enter Store Name'}}" wire:model='name'>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['application_logo'] ?? 'Application Logo'}} </label>
                        <input type="file" class="form-control" wire:model='logo'>
                        @error('logo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['fav_icon'] ?? 'Fav Icon '}}</label>
                        <input type="file" class="form-control" wire:model='favicon'>
                        @error('favicon')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['contact_number'] ?? 'Contact Number'}}<span
                                class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['enter_contact_number'] ?? 'Enter Contact Number'}}" wire:model='phone'>
                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['email'] ?? 'Email'}}<span class="text-danger"><strong>*</strong></span></label>
                        <input type="email" class="form-control" placeholder="{{$lang->data['enter_email'] ?? 'Enter Email'}}" wire:model='email'>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['currency_symbol'] ?? 'Currency Symbol'}}<span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['enter_currency_symbol'] ?? 'Enter Currency Symbol'}}" wire:model='currency_symbol'>
                        @error('currency_symbol')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label">{{$lang->data['tax_percentage'] ?? 'Tax Percentage'}}<span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['enter_tax_percentage'] ?? 'Enter Tax Percentage'}}" wire:model='tax_percentage'>
                        @error('tax_percentage')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{$lang->data['address'] ?? 'Address'}}</label>
                    <textarea class="form-control resize-none" rows="4" wire:model='address'></textarea>
                </div>
                <button type="submit" class="btn btn-primary float-end" wire:click.prevent='save'>{{$lang->data['save_changes'] ?? 'Save Changes'}}</button>
            </form>
        </div>
    </div>
</div>
</div>
