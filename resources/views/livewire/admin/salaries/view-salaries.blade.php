<div>
   
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['expense'] ?? 'Salary List'}}</strong></h3>
    </div>
    @if(Auth::user()->can('add_assigning'))
    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_salaries')}}" class="btn btn-primary">{{$lang->data['new_assigning'] ?? 'Generate New Salary'}}</a>
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
                            <th class="tw-10">{{$lang->data['date'] ?? 'Date'}}</th>
                            <th class="tw-10">{{$lang->data['vehicle_file_no'] ?? 'Name'}}</th>
                            <th class="tw-10">{{$lang->data['vehicle_plate_no'] ?? 'Nature'}}</th>
                            <th class="tw-10">{{$lang->data['vehicle_plate_no'] ?? 'Working Hours'}}</th>
                            <th class="tw-10">{{$lang->data['company'] ?? 'ATP'}}</th>
                            <th class="tw-10">{{$lang->data['driver'] ?? 'Am Income'}}</th>
                            <th class="tw-10">{{$lang->data['amount'] ?? 'Am contributions'}}</th>
                            <th class="tw-10">{{$lang->data['agreement'] ?? 'A Income'}}</th>
                            <th class="tw-10">{{$lang->data['amount'] ?? 'A Tax'}}</th>
                            <th class="tw-10">{{$lang->data['agreement'] ?? 'Driving Allowance'}}</th>
                            <th class="tw-10">{{$lang->data['status'] ?? 'Net Salary'}}</th>
                            <th class="tw-15">{{$lang->data['actions'] ?? 'Actions'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignings as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->salarydate)) }}</td>
                            <td>{{$item->employee->name}}</td>
                            <td>
                                @if ($item->employee->working_nature== 1)
                                    <span style="font-weight: bold; color: blue;">Monthly Fixed</span>
                                @else
                                    <span style="font-weight: bold; color: red;">Hourly</span>
                                @endif
                            </td>

                            <td>{{$item->working_hours}}</td>
                            <td>DKK {{$item->atp_tax}}</td>
                            <td>DKK {{$item->am_income}}</td>
                            <td>DKK {{$item->am_contributions}}</td>
                            <td>DKK {{$item->a_income}}</td>
                            <td>DKK {{$item->a_tax}}</td>
                            <td>DKK {{$item->driving_allowance}}</td>
                            <td>DKK {{$item->net_salary}}</td>
         
                            
                            
                            <td>
                                
                                @if(Auth::user()->can('delete_assigning')&& (Auth::user()->can('edit_assigning')))
                                <a href="#" class="btn btn-success btn-sm" wire:click="salaryslip({{ $item->id }})">{{ $lang->data['delete'] ?? 'Salary Slip' }}</a>
                                <a href="{{route('admin.edit_assigning',$item->id)}}" class="btn btn-sm btn-primary">{{$lang->data['edit'] ?? 'Edit'}}</a>                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($assignings) == 0)
                    <x-no-data-component message="{{$lang->data['no_products_found'] ?? 'No Salaries Data were found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>
</div>
