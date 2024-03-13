<div>
   
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['expense'] ?? 'Vehicle Assigning List'}}</strong></h3>
    </div>
    @if(Auth::user()->can('add_assigning'))
    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_assigning')}}" class="btn btn-primary">{{$lang->data['new_assigning'] ?? 'Assign New Contract'}}</a>
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
                            <th class="tw-10">{{$lang->data['vehicle_file_no'] ?? 'Vehicle File No'}}</th>
                            <th class="tw-15">{{$lang->data['vehicle_plate_no'] ?? 'Vehicle Plate No'}}</th>
                            <th class="tw-10">{{$lang->data['company'] ?? 'Company'}}</th>
                            <th class="tw-10">{{$lang->data['driver'] ?? 'Driver'}}</th>
                            <th class="tw-10">{{$lang->data['amount'] ?? 'Amount'}}</th>
                            <th class="tw-10">{{$lang->data['agreement'] ?? 'End of Aggrement'}}</th>
                            <th class="tw-10">{{$lang->data['status'] ?? 'Status'}}</th>
                            <th class="tw-15">{{$lang->data['actions'] ?? 'Actions'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignings as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                            <td>{{$item->vehicle->file_no}}</td>
                            <td>{{$item->vehicle->plate_no}}</td>
                            <td>{{$item->company->name}}</td>
                            <td>{{$item->driver->name}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->end_of_time)) }}</td>
                            
                            <td>
                                @if ($item->status == 1)
                                    <span style="font-weight: bold; color: blue;">booked</span>
                                @else
                                    <span style="font-weight: bold; color: red;">Stop</span>
                                @endif
                            </td>

                            <td>
                                
                                @if(Auth::user()->can('delete_assigning')&& (Auth::user()->can('edit_assigning')) && ($item->status == 1))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="end_assigning({{ $item->id }})">{{ $lang->data['delete'] ?? 'End Assigning' }}</a>
                                    <a href="{{route('admin.edit_assigning',$item->id)}}" class="btn btn-sm btn-primary">{{$lang->data['edit'] ?? 'Edit'}}</a>
                                 @else
                                    <span style="font-weight: bold; color: red;">Stop</span>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($assignings) == 0)
                    <x-no-data-component message="{{$lang->data['no_products_found'] ?? 'No Assigning were found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>
</div>
