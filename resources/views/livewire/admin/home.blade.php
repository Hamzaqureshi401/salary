<div>
   
<div class="row mb-2 mb-xl-3">
   
         <div class="card ">
            <div class="card-body ">
                 <div class="col-auto d-none d-sm-block text-center mb-4">
        <h3><strong style="color: blue;">{{ 'Salary List'}}</strong></h3>
        <p>{{ $currentMonthName . '-' .$currentYear}}</p>
       <!--  <div class="row">
        <div class="mb-3 col-md-6">
                    <label class="form-label">{{$lang->data['employee'] ?? 'Select a Employee '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:change="changeType" wire:model="employee_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($employees as $item)
                            <option value="{{$item->id}}">{{$item->name}} </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                   
                </div>
        <div class="mb-3 col-md-6">
                <label class="form-label" for="inputEmail4">
                    {{  'Salary Given Date (Defaults to Last Weekday of Month)' }}
                    <span class="text-danger"><strong>*</strong></span>
                </label>
                <input type="date" class="form-control" id="lastDay" wire:model="salary_date" wire:change="calculateLastDayOfMonth">
                @error('salary_date')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            </div> -->
    </div>
</div>
    </div>
   
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
                            <!-- <th class="tw-15">{{$lang->data['actions'] ?? 'Actions'}}</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignings as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{ date('d/m/Y', strtotime($item->salary_date)) }}</td>
                                <td>{{$item->employee->name}}</td>
                                <td>
                                    @if ($item->employee->working_nature == 1)
                                        <span style="font-weight: bold; color: blue;">Monthly Fixed</span>
                                    @else
                                        <span style="font-weight: bold; color: red;">Hourly</span>
                                    @endif
                                </td>
                                <td>{{$item->working_hours}}</td>
                                <td>Kr {{ number_format($item->atp_tax, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->am_income, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->am_contributions, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->a_income, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->a_tax, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->driving_allowance, 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($item->net_salary, 2, ',', '.') }}</td>
                               <!--  <td>
                                    @if(Auth::user()->can('delete_assigning') && Auth::user()->can('edit_assigning'))
                                        <a href="{{ route('admin.salaries.view', $item->id) }}" class="btn btn-success btn-sm" >{{ $lang->data['delete'] ?? 'Salary Slip' }}</a>
                                        <a href="{{ route('admin.edit_assigning', $item->id) }}" class="btn btn-sm btn-primary">{{ $lang->data['edit'] ?? 'Edit' }}</a>
                                    @endif
                                </td>  -->
                            </tr>
                        @endforeach

                    </tbody>
                     <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><strong>Total:</strong></td>
                                <td>Kr {{ number_format($assignings->sum('working_hours'), 2, ',', '.') }}</td>
                                 <td>Kr {{ number_format($assignings->sum('atp_tax'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('am_income'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('am_contributions'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('a_income'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('a_tax'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('driving_allowance'), 2, ',', '.') }}</td>
                                <td>Kr {{ number_format($assignings->sum('net_salary'), 2, ',', '.') }}</td>
                                <!-- Action column if needed -->
                            </tr>
                        </tfoot>
                </table>
                @if(count($assignings) == 0)
                    <x-no-data-component message="{{$lang->data['no_products_found'] ?? 'No Salaries Data were found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>
</div>
