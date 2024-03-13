<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['companies']??'Companies'}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_company'))
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCustomer" wire:click="resetFields">{{$lang->data['new_company']??'New
                Company'}}</a>
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
                                <th class="tw-20">{{$lang->data['name']??'Company Name'}}</th>
                                <th class="tw-20">{{$lang->data['site_branch']??'Site Branch'}}</th>
                                <th class="tw-20">{{$lang->data['project_area']??'Project Area'}}</th>
                                <th class="tw-20">{{$lang->data['project_owner']??'Contact Person'}}</th>
                                <th class="tw-10">{{$lang->data['actions']??'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->site_branch}}</td>
                                <td>{{$item->project_area}}</td>
                                <td>{{$item->project_owner}}</td>
                                <td>
                                    @if(Auth::user()->can('edit_company'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#EditModalCustomer" wire:click='edit({{$item}})'>{{$lang->data['edit']??'Edit'}}</a>
                                    @endif
                                    @if(Auth::user()->can('delete_company'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete']??'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($companies) == 0)
                        <x-no-data-component message="No Customers were found" messageindex="no_customers_found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalCustomer" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_new_company']??'Add New Company'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Company Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['name']??'Company Name'}}" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['site_branch']??'Site Branch'}}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['site_branch']??'Site Branch'}}" wire:model="site_branch">
                        
                        </div>
                    </div>
                    <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['project_area']??'Project Area'}}</label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['project_area']??'Project Area'}}" wire:model="project_area">
                        
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['project_owner']??'Contact Person'}}</label>
                        <input type="text" class="form-control resize-none" placeholder="{{$lang->data['project_owner']??'Contact Person'}}" wire:model="project_owner">
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
    <div class="modal fade" id="EditModalCustomer" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['edit_customer']??'Edit Customer'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Company Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['name']??'Company Name'}}" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['site_branch']??'Site Branch'}}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['site_branch']??'Site Branch'}}" wire:model="site_branch">
                        
                        </div>
                    </div>
                    <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['project_area']??'Project Area'}}</label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['project_area']??'Project Area'}}" wire:model="project_area">
                        
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['project_owner']??'Contact Person'}}</label>
                        <input type="text" class="form-control resize-none" placeholder="{{$lang->data['project_owner']??'Contact Person'}}" wire:model="project_owner">
                    </div>
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