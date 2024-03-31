<div>
    <style type="text/css">
        .modal-body{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
    </style>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['employee']??'Employee'}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            @if(Auth::user()->can('add_employee'))
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCustomer" wire:click="resetFields">{{$lang->data['new_employee']??'New
                Employee'}}</a>
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
                                <th class="tw-35">{{$lang->data['name']??'Name'}}</th>
                                <th class="tw-15">{{$lang->data['adress']??'Address'}}</th>
                                <th class="tw-15">{{$lang->data['email']??'Email'}}</th>
                                <th class="tw-15">{{$lang->data['position']??'Position'}}</th>
                                <th class="tw-15">{{$lang->data['cpr_no']??'CPR No '}}</th>
                                <th class="tw-15">{{$lang->data['draw_percentage']??'Draw percentage'}}</th>
                                <th class="tw-15">{{$lang->data['monthly_deduction']??'Monthly deduction'}}</th>
                                
                                <th class="tw-10">{{$lang->data['actions']??'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->adress}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->position}}</td>
                                <td>{{$item->cpr_no}}</td>
                                <td>{{$item->draw_percentage}}</td>
                                <td>{{$item->monthly_deduction}}</td>
                                                   
                                <td>
                                    @if(Auth::user()->can('edit_employees'))
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#EditModalCustomer" wire:click='edit({{$item}})'>{{$lang->data['edit']??'Edit'}}</a>
                                    @endif
                                    @if(Auth::user()->can('delete_employees'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete']??'Delete'}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($employees) == 0)
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
                    <h5 class="modal-title">{{$lang->data['add_new_employee']??'Add New Employee'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Full Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4"  wire:model="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['adres']??'Address'}}<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control"  wire:model="adress">
                            @error('adress')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['email']??'Email'}}<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control"  wire:model="email">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    
                        </div> 
                        <div class="mb-3 col-md-6">
                                <label class="form-label">{{$lang->data['position']??'Position.'}}</label>
                                <input type="text" class="form-control"  wire:model="position">
                                @error('position')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                     </div>

                    <div class="row">
                       <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['cpr_no']??'CPR No.'}}</label>
                            <input type="text" class="form-control" wire:model="cpr_no" id="cpr_no_input"placeholder="xxxxxx-xxxx">
                            @error('cpr_no')
                                <span class="text-danger">{{"The CPR number must be in the format XXXXXX-XXXX."}}</span>
                            @enderror
                            </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['draw_percentage']??'Draw percentage:'}}</label>
                            <input type="text" class="form-control"  wire:model="draw_percentage">
                            @error('draw_percentage')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Monthly deduction:'}}</label>
                            <input type="text" class="form-control"  wire:model="monthly_deduction">
                            @error('monthly_deduction')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                       
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Registraion No:'}}</label>
                            <input type="text" class="form-control"  wire:model="registration_no">
                            @error('registration_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Account No:'}}</label>
                            <input type="text" class="form-control"  wire:model="account_no">
                            @error('account_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Bank Name:'}}</label>
                            <input type="text" class="form-control"  wire:model="bank_name">
                            @error('bank_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Employee Nature</label>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="nature_monthly" name="working_nature" wire:model="working_nature" value="1" wire:click="debugValue(1)">
                            <label class="form-check-label" for="nature_monthly">Monthly Fixed Salary</label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="nature_hourly" name="working_nature" wire:model="working_nature" value="0" wire:click="debugValue(0)">
                            <label class="form-check-label" for="nature_hourly">Hourly Basis</label>
                            </div>
                            @error('working_nature')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                     @if($working_nature === 1)
                    <div class="row">
                            <div id="salary_fields"> 
                                <div class="mb-3 col-md-6">
                                <label class="form-label">Monthly Salary</label>
                                <input type="number" class="form-control" wire:model="monthly_salary">
                                @error('monthly_salary')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Monthly Hours</label>
                                <input type="number" class="form-control" wire:model="monthly_hours">
                                @error('monthly_hours')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                        </div>
                        @elseif($working_nature === 0)
                        
                        <div id="hourly_fields" > <div class="mb-3 col-md-6">
                            <label class="form-label">Hourly Rate</label>
                            <input type="number" value="{{$working_nature}}" class="form-control" wire:model="hourly_price">
                            @error('hourly_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        </div>
                        @endif
           
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
                    <h5 class="modal-title">{{$lang->data['edit_driver']??'Edit Driver'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['name']??'Full Name'}} <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" id="inputEmail4"  wire:model="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['adres']??'Address'}}<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control"  wire:model="adress">
                            @error('adress')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['email']??'Email'}}<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control"  wire:model="email">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    
                        </div> 
                        <div class="mb-3 col-md-6">
                                <label class="form-label">{{$lang->data['position']??'Position.'}}</label>
                                <input type="text" class="form-control"  wire:model="position">
                                @error('position')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                     </div>

                    <div class="row">
                       <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['cpr_no']??'CPR No.'}}</label>
                            <input type="text" class="form-control" wire:model="cpr_no" id="cpr_no_input"placeholder="xxxxxx-xxxx">
                            @error('cpr_no')
                                <span class="text-danger">{{"The CPR number must be in the format XXXXXX-XXXX."}}</span>
                            @enderror
                            </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['draw_percentage']??'Draw percentage:'}}</label>
                            <input type="text" class="form-control"  wire:model="draw_percentage">
                            @error('draw_percentage')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Monthly deduction:'}}</label>
                            <input type="text" class="form-control"  wire:model="monthly_deduction">
                            @error('monthly_deduction')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                       
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Registraion No:'}}</label>
                            <input type="text" class="form-control"  wire:model="registration_no">
                            @error('registration_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Account No:'}}</label>
                            <input type="text" class="form-control"  wire:model="account_no">
                            @error('account_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{$lang->data['monthly_deduction']??'Bank Name:'}}</label>
                            <input type="text" class="form-control"  wire:model="bank_name">
                            @error('bank_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Employee Nature</label>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="nature_monthly" name="working_nature" wire:model="working_nature" value="1" wire:click="debugValue(1)">
                            <label class="form-check-label" for="nature_monthly">Monthly Fixed Salary</label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="nature_hourly" name="working_nature" wire:model="working_nature" value="0" wire:click="debugValue(0)">
                            <label class="form-check-label" for="nature_hourly">Hourly Basis</label>
                            </div>
                            @error('working_nature')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                     @if($working_nature === 1)
                    <div class="row">
                            <div id="salary_fields"> 
                                <div class="mb-3 col-md-6">
                                <label class="form-label">Monthly Salary</label>
                                <input type="number" class="form-control" wire:model="monthly_salary">
                                @error('monthly_salary')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Monthly Hours</label>
                                <input type="number" class="form-control" wire:model="monthly_hours">
                                @error('monthly_hours')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                        </div>
                        @elseif($working_nature === 0)
                        
                        <div id="hourly_fields" > <div class="mb-3 col-md-6">
                            <label class="form-label">Hourly Rate</label>
                            <input type="number" value="{{$working_nature}}" class="form-control" wire:model="hourly_price">
                            @error('hourly_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        </div>
                        @endif
           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$lang->data['close']??'Close'}}</button>
                    <button type="button" class="btn btn-success" wire:click="update">{{$lang->data['save']??'Save'}}</button>
                </div>
            </div>
        </div>
    
    </div>
</div>

