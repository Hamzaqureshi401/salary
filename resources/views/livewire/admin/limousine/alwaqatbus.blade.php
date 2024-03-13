<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['vehicle']??'Alwaqt Bus'}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_alwaqatbus'))
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AlwaqatBus" wire:click="resetFields">{{$lang->data['new_vehicle']??'New
                Alwaqt Bus'}}</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <table id="table" class="table datatable table-striped table-bordered mb-0">
                        <thead class="bg-secondary-light">
                            <tr>
                                <th class="tw-5">{{$lang->data['sl']??'Sl'}}</th>
                                <th class="tw-8">{{$lang->data['file_no']??'File No.'}}</th>
                                <th class="tw-12">{{$lang->data['plate_no']??'Plate No.'}}</th>
                                <th class="tw-12">{{$lang->data['owner']??'Owner'}}</th>
                                <th class="tw-15">{{$lang->data['registration_date']??'Mobile No.'}}</th>
                                <th class="tw-12">{{$lang->data['vehicle_type']??'Vehicle Type'}}</th>
                                <th class="tw-12">{{$lang->data['vehicle_model']??'Vehicle Model'}}</th>
                                <th class="tw-15">{{$lang->data['registration_date']??'Registration Date'}}</th>
                                <th class="tw-10">{{$lang->data['actions']??'Actions'}}</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($limousines as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->file_no}}</td>
                                <td>{{$item->plate_no}}</td>
                                <td>{{$item->owner_name}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->vehicle_type}}</td>
                                <td>{{$item->vehicle_model}}</td>
                                
                                <td>{{$item->registration_date}}</td>
                           
                                <td>
                                    @if(Auth::user()->can('edit_alwaqatbus'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#EditAlwaqatBus" wire:click='edit({{$item}})'>{{$lang->data['edit']??'Edit'}}</a>
                                    @endif
                                    @if(Auth::user()->can('delete_alwaqatbus'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete']??'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($limousines) == 0)
                        <x-no-data-component message="No AlWaqt Bus were found" messageindex="no_vehicles_found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AlwaqatBus" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_new_vehicle']??'Add Alwaqt Bus'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                       
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['file_no']??'File No.'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['file_no']??'1234'}}" wire:model="file_no">
                            @error('file_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>                         
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['plate_no']??'Plate No.'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['plate_no']??'2321'}}" wire:model="plate_no">
                            @error('plate_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['owner_name']??'Owner Name'}}<span class="text-danger"></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['owner_name']??'Baba'}}" wire:model="owner_name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['mobile']??'Mobile No. '}}<span class="text-danger"><strong>*</strong></span></label>
                            <input type="number" class="form-control"   wire:model="mobile" required>
                            @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>    
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['vehicle_type']??'Vehicle Type '}}</label>
                            <input type="text" class="form-control" wire:model="vehicle_type">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['vehicle_model']??'Vehicle Model '}}</label>
                            <input type="text" class="form-control"  wire:model="vehicle_model">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">{{$lang->data['registration_date']??'Registration Date '}}<span class="text-danger"><strong>*</strong></span></label>
                            <input type="date" class="form-control"   wire:model="registration_date" required>
                            @error('registration_date')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>    
                        
                    
                        
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$lang->data['close']??'Close'}}</button>
                    <button type="button" class="btn btn-success" wire:click="create">{{$lang->data['save']??'Save'}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditAlwaqatBus" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_new_driver']??'Edit Alwaqt Bus'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['file_no']??'File No.'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['file_no']??'1'}}" wire:model="file_no">
                            @error('file_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>                         
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['plate_no']??'Plate No.'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['plate_no']??'QT-2321'}}" wire:model="plate_no">
                            @error('plate_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['owner_name']??'Owner Name'}}<span class="text-danger"></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['owner_name']??'Mr al khalid'}}" wire:model="owner_name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['mobile']??'Mobile No. '}}<span class="text-danger"><strong>*</strong></span></label>
                            <input type="number" class="form-control"   wire:model="mobile" required>
                            @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['vehicle_type']??'Vehicle Type '}}</label>
                            <input type="text" class="form-control"placeholder="{{$lang->data['owner_name']??' 12 seets Limosuine'}}"  wire:model="vehicle_type">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['vehicle_model']??'Vehicle Model '}}</label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['owner_name']??'2018'}}" wire:model="vehicle_model">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">{{$lang->data['registration_date']??'Registration Date '}}</label>
                            <input type="date" class="form-control"   wire:model="registration_date" required>
                            @error('registration_date')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>    
                        
                            

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$lang->data['close']??'Close'}}</button>
                    <button type="button" class="btn btn-success" wire:click="update">{{$lang->data['save']??'Save'}}</button>
                </div>
            </div>
        </div>
    </div>
</div>