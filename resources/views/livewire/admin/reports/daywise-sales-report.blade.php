<div>
   <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
         <h3><strong>{{$lang->data['day_wise_report'] ?? 'Bus Assigning Report'}}</strong></h3>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <div class="card p-0">
            <div class="card-header p-3">
               <div class="row">
                  <div class="col-md-3">
                     <label>{{$lang->data['start_date'] ?? 'Start Date'}}</label>
                     <input type="date" class="form-control" wire:model="start_date">
                  </div>
                  <div class="col-md-3">
                     <label>{{$lang->data['end_date'] ?? 'End Date'}}</label>
                     <input type="date" class="form-control" wire:model="end_date">
                  </div>
                  <!-- ... (other HTML) ... -->
                  <div class="col-md-4">
                     <label class="form-label">{{$lang->data['vehicle'] ?? 'Bus File no. - Company - Driver '}}<span class="text-danger"><strong>*</strong></span></label>
                     <select class="form-control" wire:model="assignment_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($assigning->sortBy('vehicle.file_no') as $assignment)
                        <option value="{{ $assignment->id }}">
                           {{ $assignment->vehicle->file_no }} --> {{ $assignment->company->name }} --> {{ $assignment->driver->name }}
                        </option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-2 d-n-p">
                     <br>
                     <a href="#" class="btn btn-primary" wire:click='getData'>{{$lang->data['search'] ?? 'Search'}}</a>
                  </div>
                  <div class="col-md-8 d-n-p">
                  </div>
                  <div class="col-md-4 d-n-p">
                     <br>
                     <a href="#" class="btn btn-primary" wire:click="exportToExcel">{{$lang->data['excel'] ?? 'Excel'}}</a>
                     <a href="#" class="btn btn-primary" wire:click="exportToPDF">{{$lang->data['pdf'] ?? 'PDF'}}</a>
                     <a class="btn btn-primary print">Print</a>
                  </div>
                  <!-- ... (other HTML) ... -->
               </div>
            </div>
            <!-- ... (other HTML) ... -->
            <!-- Display data from VehicleAssigning table -->
            @if($data)
            <div class="card-body p-0">
               <h2>Vehicle Assigning Data</h2>
               @php
               $assignment_amount = 0; // Initialize the super total variable
               @endphp
               <table class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th>Date</th>
                        <th>Bus File No</th>
                        <th>Company</th>
                        <th>Driver</th>
                        <th>Rent Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($data['assignings'] as $assignment)
                     <tr>
                        <td>{{ date('l, F j, Y', strtotime($assignment['date'])) }}</td>
                        <td>{{ $assignment['vehicle']['file_no'] }}</td>
                        <td>{{ $assignment['company']['name'] }}</td>
                        <td>{{ $assignment['driver']['name'] }}</td>
                        <td>{{ $assignment['amount'] }}</td>
                     </tr>
                     @php
                     $assignment_amount += $assignment['amount']; // Add the 'amount' to the super total
                     @endphp
                     @endforeach
                  </tbody>
               </table>
               <!-- Display data from Maintenance table -->
               <!-- Assuming $data['assigning'] contains the assignments data -->
               @php
               $superTotal = 0; // Initialize the super total variable
               @endphp
               <h2>Maintenance Cost</h2>
               <table class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th>Date</th>
                        <th>Parts Name</th>
                        <th>Amount</th>
                        <th>Garage Services</th>
                        <th>Total Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($data['maintenances'] as $maintenance)
                     <tr>
                        <td>{{ date('l, F j, Y', strtotime($maintenance['date'])) }}</td>
                        <td>{{ $maintenance['partstype']['name'] }}</td>
                        <td>{{ $maintenance['payment'] }}</td>
                        <td>{{ $maintenance['garage_services_charges'] }}</td>
                        <td>{{ $maintenance['total'] }}</td>
                     </tr>
                     @php
                     $superTotal += $maintenance['total']; // Add the 'amount' to the 
                     @endphp
                     @endforeach
                     <tr>
                        <td colspan="4">Super Total:</td>
                        <td>{{ $superTotal }}</td>
                     </tr>
                  </tbody>
               </table>
               <!-- Display data from Expenses table -->
               @php
               $superTotal1 = 0; // Initialize the super total variable
               @endphp
               <h2>Petrol & Driver Expense</h2>
               <table class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th>Date</th>
                        <th>Expense Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($data['expenses'] as $expense)
                     <tr>
                        <td>{{ date('l, F j, Y', strtotime($expense['date'])) }}</td>
                        <td>{{ $expense['expensetype']['name']}}</td>
                        <td>{{ $expense['description'] }}</td>
                        <td>{{ $expense['amount'] }}</td>
                     </tr>
                    
                     @endforeach
                     <tr>
                        <td colspan="3">Super Total:</td>
                        <td>{{ $superTotal1 }}</td>
                     </tr>
                  </tbody>
               </table>
               <!-- Calculate the sum of maintenance and expenses -->
               <h2>Sum of Maintenance and Expenses</h2>
               <table class="table table-bordered table-striped table-hover">
                   <thead>
                     <tr>
                        <th>Maintenance Cost</th>
                        <th>Total Petrol Expense</th>
                        <th>Total Driver Cost</th>
                        <th>Total Expenses</th>
                        <th>Rent Received</th>
                        <th>Profit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{ $superTotal }}</td>
                        <td>{{ $total_petrol }}</td>
                        <td>{{ $total_driver_cost }}</td>
                        <td>{{ $superTotal + $total_petrol + $total_driver_cost }}</td>
                        <td>{{ $assignment_amount }}</td>
                        <td>{{ $assignment_amount - ($superTotal +  $total_petrol + $total_driver_cost) }}</td>
                     </tr>
                  </tbody>
               </table>
               @else
               <p>No data available. Please click the "Search" button to retrieve data.</p>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>