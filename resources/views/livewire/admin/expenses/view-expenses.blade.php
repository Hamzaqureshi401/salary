<div>
   
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['expense'] ?? 'Salary & Petrol List'}}</strong></h3>
    </div>
    @if(Auth::user()->can('add_expenses'))
    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_expense')}}" class="btn btn-primary">{{$lang->data['new_expense'] ?? 'New Salary & Petrol Expense'}}</a>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-body p-0">
                <table id="table" class="table datatable table-striped table-bordered mb-0">
                        <thead class="bg-secondary-light">
                        <tr>
                            <th class="tw-5">{{$lang->data['sl'] ?? 'Sl'}}</th>
                            <th class="tw-15">{{$lang->data['date'] ?? 'Date'}}</th>
                            <th class="tw-20">{{$lang->data['vehicle_plate_no'] ?? 'File no. & Company'}}</th>
                            <th class="tw-15">{{$lang->data['expense_type'] ?? 'Driver '}}</th>
                            <th class="tw-15">{{$lang->data['expense_type'] ?? 'Expense Type '}}</th>
                            <th class="tw-15">{{$lang->data['amount'] ?? 'Amount'}}</th>
                            <th class="tw-15">{{$lang->data['description'] ?? 'Description'}}</th>
                            <th class="tw-15">{{$lang->data['actions'] ?? 'Actions'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                            
                            <td>{{$item->assigning->vehicle->file_no}}-{{$item->assigning->company->name}} </td>
                            <td><strong>{{$item->assigning->driver->name}}</strong></td>

                            <td><span class="badge bg-dark">{{$item->expensetype->name}}</span></td>
                            <td>{{$item->amount}}</td>
                             <td>{{$item->description}}</td>
                           
                            <td>
                               
                                @if(Auth::user()->can('edit_expenses'))
                                <a href="{{route('admin.edit_expense',$item->id)}}" class="btn btn-sm btn-primary">{{$lang->data['edit'] ?? 'Edit'}}</a>
                                @endif

                                @if(Auth::user()->can('delete_expenses'))
                                <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete'] ?? 'Delete'}}</a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($expenses) == 0)
                    <x-no-data-component message="{{$lang->data['no_products_found'] ?? 'No Expenses were found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>
</div>
