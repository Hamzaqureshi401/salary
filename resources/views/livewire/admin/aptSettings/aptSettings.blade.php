<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['companies']??'APT Settings'}}</strong></h3>
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
                                <th class="tw-20">{{$lang->data['lt']??'Less than 39 hours'}}</th>
                                <th class="tw-20">{{$lang->data['lt']??'Between 39 and 77 hours'}}</th>
                                <th class="tw-20">{{$lang->data['lt']??'Between 78 and 116 hour'}}</th>
                                <th class="tw-20">{{$lang->data['lt']??'More than 117 hours'}}</th>
                                <th class="tw-20">{{$lang->data['lt']??'Driving Allowance Rate'}}</th>
                                <th class="tw-10">{{$lang->data['actions']??'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aptsettings as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->lessthan39hours}}</td>
                                <td>{{$item->between39and77hours}}</td>
                                <td>{{$item->between78and116hours}}</td>
                                <td>{{$item->morethan117hours}}</td>
                                <td>Dkk {{$item->da_rate}}</td>
                                <td>
                                    @if(Auth::user()->can('edit_company'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#EditModalAptSetting" wire:click='edit({{$item}})'>{{$lang->data['edit']??'Edit'}}</a>
                                    @endif
                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($aptsettings) == 0)
                        <x-no-data-component message="No Settings  were found" messageindex="no_customers_found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditModalAptSetting" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$lang->data['add_new_company']??'Add New Company'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Less Than 39 hours amount'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="{{$lang->data['lessthan39hours']??'Less Than 39 hours amount'}}" wire:model="lessthan39hours">
                            @error('lessthan39hours')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['site_branch']??'Between 39 and 77 hours amount'}}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['between39and77hours']??'between39and77hours'}}" wire:model="between39and77hours">
                            @error('between39and77hours')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['project_area']??'Between 78 and 116 hours amount'}}</label>
                            <input type="text" class="form-control" placeholder="{{$lang->data['project_area']??'between78and116hours'}}" wire:model="between78and116hours">
                            @error('between78and116hours')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['project_owner']??'morethan117hours'}}</label>
                            <input type="text" class="form-control resize-none" placeholder="{{$lang->data['morethan117hours']??'morethan117hours'}}" wire:model="morethan117hours">
                            @error('morethan117hours')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{$lang->data['project_owner']??'Driving Allowance Rate'}}</label>
                        <input type="text" class="form-control resize-none" placeholder="{{$lang->data['da_rate']??'3.69'}}" wire:model="da_rate">
                        @error('da_rate')
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