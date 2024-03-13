<div>
    
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['create_maintainance'] ?? 'Edit Vehicle Assignment'}}</strong></h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_assigning')}}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
    </div>
</div>

<div class="col-md-12">
    <div class="card">

        <div class="card-body">
            <form x-data="{ isUploading: false, progress: 0 }" 
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">{{$lang->data['date'] ?? 'Assigning Date'}} <span
                            class="text-danger"><strong>*</strong></span></label>
                            <input type="date" class="form-control" placeholder="{{$lang->data['date'] ?? 'Date'}}" wire:model="date">

                            @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{$lang->data['vehicle'] ?? 'Vehicle File no. & Plate no. '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:change="vehicleData" wire:model="vehicle_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($vehicle as $item)
                            <option value="{{$item->id}}">{{$item->file_no}} {{$item->plate_no}}</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">File Number:</label>
                    <input type="text" class="form-control" wire:model="file_no" readonly>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label class="form-label">Plate Number:</label>
                    <input type="text" class="form-control" wire:model="plate_no" readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{$lang->data['company_id'] ?? 'Company '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:change="companyData" wire:model="company_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($company as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['company owner'] ?? 'Company Owner'}}</label>
                    <input type="number" class="form-control" wire:model="company_owner" readonly>
                    @error('company_owner')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{$lang->data['driver'] ?? 'Driver '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:model="driver_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($driver as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'Monthly Rent'}} </label>       
                    <input type="number" class="form-control" wire:model="amount">
                </div>
            </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['agrement'] ?? 'End of Agreement'}} </label>
                    <input type="date" class="form-control" wire:model="end_of_time">
                    @error('end_of_time')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
            


                <button type="button" class="btn btn-primary float-end" :disabled="isUploading == true" wire:click.prevent="update">{{$lang->data['submit'] ?? 'Submit'}}</button>
            </form>
        </div>
    </div>
</div>
</div>
