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
                        <td>{{$item->employee->name}} Kr</td>
                        <td>
                           @if ($item->employee->working_nature == 1)
                           <span style="font-weight: bold; color: blue;">Monthly Fixed</span>
                           @else
                           <span style="font-weight: bold; color: red;">Hourly</span>
                           @endif
                         </td>
                        <td>{{$item->working_hours}} </td>
                        <td>{{ number_format($item->atp_tax, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->am_income, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->am_contributions, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->a_income, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->a_tax, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->driving_allowance, 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($item->net_salary, 2, ',', '.') }} Kr</td>
                        <!--  <td>
                           @if(Auth::user()->can('delete_assigning') && Auth::user()->can('edit_assigning'))
                               <a href="{{ route('admin.salaries.view', $item->id) }}" class="btn btn-success btn-sm" >{{ $lang->data['delete'] ?? 'Salary Slip' }}</a>
                               <a href="{{ route('admin.edit_assigning', $item->id) }}" class="btn btn-sm btn-primary">{{ $lang->data['edit'] ?? 'Edit' }}</a>
                           @endif
                            Kr</td>  -->
                     </tr>
                     @endforeach
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="3"></td>
                        <td><strong>Total:</strong></td>
                        <td>{{ number_format($assignings->sum('working_hours'), 2, ',', '.') }} </td>
                        <td>{{ number_format($assignings->sum('atp_tax'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('am_income'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('am_contributions'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('a_income'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('a_tax'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('driving_allowance'), 2, ',', '.') }} Kr</td>
                        <td>{{ number_format($assignings->sum('net_salary'), 2, ',', '.') }} Kr</td>
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