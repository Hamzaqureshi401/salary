<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['parts-type'] ?? 'Parts Type'}}</strong></h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_parts'))
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModelsPartsType" wire:click="resetFields">{{$lang->data['new_parts'] ?? 'New
                Parts Type'}}</a>
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
                            @foreach ($partstypes as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if(Auth::user()->can('edit_parts'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModelsPartsType" wire:click='edit({{$item}})'>{{$lang->data['edit'] ?? 'Edit'}}</a>
                                    @endif

                                    @if(Auth::user()->can('delete_parts'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete'] ?? 'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($partstypes) == 0)
                        <x-no-data-component message="{{$lang->data['no_expensetype_found'] ?? 'No Partstype were found..'}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModelsPartsType" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_partstype'] ?? 'Add New Parts Type'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{$lang->data['name'] ?? 'Parts Name'}} <span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" placeholder="{{$lang->data['name'] ?? 'Parts Name'}}" wire:model="name">
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

    
    <div class="modal fade" id="ModelsPartsType" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['edit_partstype']??'Edit Parts'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Parts Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['name']??'Parts Name'}}" wire:model="name">
                            @error('name')
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