<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['maintainance']??'Maintainance'}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_maintainance'))
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('admin.add_maintainance')}}" class="btn btn-primary">{{$lang->data['new_maintainance'] ?? 'New Maintainance'}}</a>
            </div>
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
                                <th class="tw-15">{{$lang->data['date'] ?? 'Date'}}</th>
                                 
                                 <th class="tw-15">{{$lang->data['vehicle_plate_no'] ?? 'File no. & Company'}}</th>
                                 <th class="tw-10">{{$lang->data['vehicle_file_no'] ?? 'Driver'}}</th>
                                <th class="tw-15">{{$lang->data['parts_type'] ?? 'Parts Type '}}</th>
                                <th class="tw-15">{{$lang->data['amount'] ?? 'Parts Amount'}}</th>
                                <th class="tw-15">{{$lang->data['garage_services_charges'] ?? 'Garage Services Charges'}}</th>
                                <th class="tw-15">{{$lang->data['description'] ?? 'Description'}}</th>
                                <th class="tw-15">{{$lang->data['total'] ?? 'Total'}}</th>
                                
                                <th class="tw-10">{{$lang->data['actions']??'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maintainances as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                                
                                <td>{{$item->assigning->vehicle->file_no}}-{{$item->assigning->company->name}} </td>
                                <td><strong>{{$item->assigning->driver->name}}</strong></td>
                                <td><span class="badge bg-dark">{{$item->partstype->name}}</span></td>
                                <td>{{$item->payment}}</td>
                                <td>{{$item->garage_services_charges}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->total}}</td>
                                <td>
                                    @if(Auth::user()->can('edit_maintainance'))
                                    <a href="{{route('admin.edit_maintainance',$item->id)}}" class="btn btn-sm btn-primary" >{{$lang->data['edit']??'Edit'}}</a>
                                    @endif
                                    @if(Auth::user()->can('delete_maintainance'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete']??'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($maintainances) == 0)
                        <x-no-data-component message="No Maintainance Record were found" messageindex="not_found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="EditModelMaintainance" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['edit_driver']??'Edit Driver'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['name']??'Name'}}" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['mobile_number']??'Mobile Number'}}<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['mobile']??'mobile_no'}}" wire:model="mobile_no">
                            @error('mobile_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{$lang->data['registraion_date']??'Registration Date'}}</label>
                        <input type="date" class="form-control"  wire:model="registration_date">
                        @error('registraion_date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{$lang->data['monthly_salary']??'Monthly Salary'}}</label>
                        <input type="text"class="form-control resize-none" placeholder="{{$lang->data['monthly_salary']??'Monthly Salary'}}" wire:model="monthly_salary">
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