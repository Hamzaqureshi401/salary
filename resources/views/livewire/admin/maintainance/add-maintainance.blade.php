<div>
    
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['create_maintainance'] ?? 'Add Maintainance'}}</strong></h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.maintainance')}}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
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
                    <label class="form-label" for="inputEmail4">{{$lang->data['date'] ?? 'Date'}} <span
                            class="text-danger"><strong>*</strong></span></label>
                            <input type="date" class="form-control" placeholder="{{$lang->data['date'] ?? 'Date'}}" wire:model="date" value="{{ date('Y-m-d') }}">
                            @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['vehicle'] ?? 'File no. - Company- Driver '}}<span class="text-danger"><strong>*</strong></span></label>
                        <select class="form-control" wire:change="assignfileno" wire:model="assignment_id">
                            <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                           @foreach ($assigning->sortBy('vehicle.file_no') as $assignment)
                                <option value="{{ $assignment->id }}">
                                      {{ $assignment->vehicle->file_no }} - {{ $assignment->company->name }} - {{ $assignment->driver->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" wire:model="vehicleFileNo">
                        @error('vehicle')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{$lang->data['partstype'] ?? 'Parts Type '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:model="partstype_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($partstype as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('partstype_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'Parts Amount'}} <span
                            class="text-danger"><strong>*</strong></span></label>
                    <input type="number" class="form-control" wire:change="totalAmount" wire:model="payment">
                    @error('amount')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['garage_services_charges'] ?? 'Garage Services Charges'}} <span
                            class="text-danger"><strong>*</strong></span></label>
                    <input type="number" class="form-control" wire:change="totalAmount" wire:model="garage_services_charges">
                    @error('garage_services_charges')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['total'] ?? 'Total Maintainance Cost'}} </label>       
                    <input type="number" class="form-control" wire:model="total" readonly>
                </div>
            </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputZip">{{$lang->data['description'] ?? 'Description'}} </label>
                    <textarea type="text" class="form-control" wire:model="description"></textarea>
                </div>
            


                <button type="button" class="btn btn-primary float-end" :disabled="isUploading == true" wire:click.prevent="create">{{$lang->data['submit'] ?? 'Submit'}}</button>
            </form>
        </div>
    </div>
</div>
</div>
