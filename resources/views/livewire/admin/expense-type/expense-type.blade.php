<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['expensetype'] ?? 'Expense Type'}}</strong></h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_expensetype'))
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalExpenseType" wire:click="resetFields">{{$lang->data['new_expensetype'] ?? 'New
                Expense Type'}}</a>
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
                                <th class="tw-10">{{$lang->data['sl'] ?? 'Sl'}}</th>
                                <th class="tw-60">{{$lang->data['name'] ?? 'Name'}}</th>
                                <th class="tw-20">{{$lang->data['actions'] ?? 'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expensetypes as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if(Auth::user()->can('edit_expensetype'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModelsExpenseType" wire:click='edit({{$item}})'>{{$lang->data['edit'] ?? 'Edit'}}</a>
                                    @endif

                                    @if(Auth::user()->can('delete_expensetype'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete'] ?? 'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($expensetypes) == 0)
                        <x-no-data-component message="{{$lang->data['no_expensetype_found'] ?? 'No expensetype were found..'}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalExpenseType" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_expensetype'] ?? 'Add New Expense Type'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{$lang->data['name'] ?? 'Name'}} <span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['name'] ?? 'Name'}}" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$lang->data['close'] ?? 'Close'}}</button>
                    <button type="button" class="btn btn-success" wire:click='create'>{{$lang->data['save'] ?? 'Save'}}</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="ModelsExpenseType" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
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
                  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$lang->data['close']??'Close'}}</button>
                    <button type="button" class="btn btn-success" wire:click="update">{{$lang->data['save']??'Save'}}</button>
                </div>
            </div>
        </div>
    </div>
</div>