<div>
<div class="row mb-2 mb-xl-3">
   <div class="col-auto d-none d-sm-block">
      <h3><strong>{{$lang->data['day_wise_report'] ?? 'Bus Owner Report'}}</strong></h3>
   </div>
</div>
<div class="row">
<div class="col-12">
<div class="card p-0">
   <div class="card-header p-3">
      <div class="row">
         <div class="col-md-2">
            <label>{{$lang->data['start_date'] ?? 'Start Date'}}</label>
            <input type="date" class="form-control" wire:model="start_date">
         </div>
         <div class="col-md-2">
            <label>{{$lang->data['end_date'] ?? 'End Date'}}</label>
            <input type="date" class="form-control" wire:model="end_date">
         </div>
         <!-- ... (other HTML) ... -->
         <div class="col-md-4">
            <label class="form-label">{{$lang->data['vehicle'] ?? 'Bus Owner Name '}}<span class="text-danger"><strong>*</strong></span></label>
            <select class="form-control" wire:model.lazy="selectedOwner">
               <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
               @foreach ($vehicle as $owner)
               <option value="{{ $owner }}">
                  {{ $owner }}
               </option>
               @endforeach
            </select>
         </div>
         <div class="col-md-2 d-n-p">
            <br>
            <a href="#" class="btn btn-primary" wire:click='getData'>{{$lang->data['search'] ?? 'Search'}}</a>
            <!--     </div>
               <div class="col-md-10">
               </div>
               <div class="col-md-2">
               <br>
               <a href="#" class="btn btn-primary" wire:click="exportToExcel">{{$lang->data['excel'] ?? 'Excel'}}</a>
               <a href="#" class="btn btn-primary" wire:click="exportToPDF">{{$lang->data['pdf'] ?? 'PDF'}}</a>
               </div>!-->            <!-- ... (other HTML) ... -->
         </div>
         <div class="col-2"> 
            <br>
            <a class="btn btn-primary print d-n-p">Print</a>
         </div>
      </div>
   </div>
</div>
<!-- ... (other HTML) ... -->
<!-- Display data from VehicleAssigning table -->
<!-- Display data from VehicleAssigning table -->
@if ($reportData && count($reportData) > 0)
<div>
   <div class="card-body p-0">
      <table class="table table-striped table-sm table-bordered mb-0">
         <thead class="bg-secondary-light">
            <tr>
               <th class="tw-15">{{$lang->data['date'] ?? 'Owner Name'}}</th>
               <th class="tw-15">{{'Month'}}</th>
               <th class="tw-15">{{ 'Bus No.'}}</th>
               <th class="tw-15">{{$lang->data['amount'] ?? 'Petrol'}}</th>
               
               <!-- <th class="tw-15">{{$lang->data['vehicle_plate_no'] ?? 'Bus No.'}}</th> -->
               <th class="tw-15">{{$lang->data['garage_services_charges'] ?? 'Maintainance'}}</th>
               <th class="tw-15">{{$lang->data['parts_type'] ?? 'Salaries '}}</th>
               
               <th class="tw-15">{{$lang->data['total'] ?? 'Total Exe'}}</th>
               <th class="tw-15">{{$lang->data['description'] ?? 'Rent'}}</th>
               <th class="tw-15">{{$lang->data['total'] ?? 'Balance'}}</th>
            </tr>
         </thead>
         @php
         $SupertotalPetrol = 0; // Initialize the super total variable
         $SupertotalMaintainance = 0;
         $SupertotalSalray = 0;
         $SupertotalRent = 0;
         $Supertotal= 0;
         $SuperProfitLoss= 0;
         
         @endphp
         <tbody>
            @foreach ($reportData as $ownerData)
            <tr>
                @php
                $dates = $ownerData->assigning->where('status' , 1);
                $total_salary_expenses = $ownerData->expenses->where('expense_type_id' , 2)->whereBetween('date', [$start_date.' 00:00:00', $end_date.' 23:59:59'])->sum('amount');

                $total_petrol_expenses = $ownerData->expenses->where('expense_type_id' , 1)->whereBetween('date', [$start_date.' 00:00:00', $end_date.' 23:59:59'])->sum('amount');
               
                $total_maintenance_cost = $ownerData->assigning->flatMap->maintainance->whereBetween('date', [$start_date, $end_date])->sum('total');

                $total_rent = $ownerData->assigning->where('status' , 1)->sum('amount'); 

                

                //dd($reportData);

                @endphp
               <!-- !-->
               <td>
                  
               @foreach($dates as $date)
                <a href="{{ route('admin.detailed_report', ['id' => $ownerData['id'], 'start_date' => $start_date , 'end_date' => $end_date]) }}">{{ $ownerData['owner_name'] }}</a><br>
               @endforeach
                

                                 
            </td>
            <td>
               
                {{ date('F , Y', strtotime($start_date)) }}
               
               </td>
               <td>{{ $ownerData['file_no'] }}</td>
               <td>{{ $total_petrol_expenses }}</td>
               <td>{{ $total_maintenance_cost }}</td>
               <td>{{ $total_salary_expenses }}</td>
               <td>{{ $total_salary_expenses + $total_petrol_expenses + $total_maintenance_cost }}</td>
               <td>{{ $total_rent}}</td>
               <td>{{ $total_rent- ($total_salary_expenses + $total_petrol_expenses + $total_maintenance_cost)}}</td>
            </tr>
            @php
            $SupertotalPetrol       += $total_petrol_expenses;
            $SupertotalMaintainance += $total_maintenance_cost;
            $SupertotalSalray       += $total_salary_expenses ;
            $SupertotalRent         += $total_rent;
            $Supertotal             = ($SupertotalPetrol +$SupertotalMaintainance +$SupertotalSalray) ;
            $SuperProfitLoss        += $total_rent- ($total_salary_expenses + $total_petrol_expenses + $total_maintenance_cost);
            @endphp
            @endforeach
            <strong>
               <tr>
                  <td>توتل</td>
                  <td>--</td>
                  <td>--</td>
                  <td>{{ $SupertotalPetrol }}</td>
                  <td>{{ $SupertotalMaintainance }}</td>
                  <td>{{ $SupertotalSalray }}</td>
                  <td>{{ $Supertotal }}</td>
                  <td>{{ $SupertotalRent }}</td>
                  <td>{{ $SuperProfitLoss }}</td>

               </tr>
            </strong>
         </tbody>
      </table>
   </div>
   @else
   <p>No data found.</p>
   @endif
</div>