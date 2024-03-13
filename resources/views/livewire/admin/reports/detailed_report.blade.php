<div>
   <div class="row mb-2 mb-xl-3">
    <div class="col-10 d-none d-sm-block">
        <h3><strong>{{$lang->data['day_wise_report'] ?? 'Detailed Bus Report:'}}{{ date('F , Y', strtotime($data['assignings']->first()->date)) }}</strong></h3>
    </div>
    <div class="col-2 d-none d-sm-block text-right"> <!-- Use the text-right class for right alignment -->
        <a class="btn btn-primary print d-n-p">Print</a>
    </div>
</div>

   <!-- ... (other HTML) ... -->
   <!-- Display data from VehicleAssigning table -->
   @if($data)
   <div class="card-body p-0">
      <!-- <h2>Vehicle Assigning Data</h2> -->
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
               <td>{{ date('F , Y', strtotime($assignment['date'])) }}</td>
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
               <td>{{  date('F , Y', strtotime($maintenance['date'])) }}</td>
               <td>{{ $maintenance['partstype']['name'] }}</td>
               <td>{{ $maintenance['payment'] }}</td>
               <td>{{ $maintenance['garage_services_charges'] }}</td>
               <td>{{ $maintenance['total'] }}</td>
            </tr>
            @php
            $superTotal += $maintenance['total']; // Add the 'amount' to the super total
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
               <td>{{ date('F , Y', strtotime($expense['date'])) }}</td>
               <td>{{ $expense['expensetype']['name']}}</td>
               <td>{{ $expense['description'] }}</td>
               <td>{{ $expense['amount'] }}</td>
            </tr>
            @php
            $superTotal1 += $expense['amount']; // Add the 'amount' to the super total
            @endphp
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
               <th>Total Petrol Cost</th>
               <th>Total Driver Cost</th>
               <th>Total Expenses</th>
               <th>Rent Received</th>
               <th>Profit</th>
            </tr>
         </thead>
         <tbody>
            <tr>

               <td>{{ $superTotal }}</td>
               <td>{{ $data['expenses']->where('expense_type_id' , 1)->sum('amount') }}</td>
               <td>{{ $data['expenses']->where('expense_type_id' , 2)->sum('amount') }}</td>
               <td>{{ ($superTotal + $data['expenses']->where('expense_type_id' , 1)->sum('amount') + $data['expenses']->where('expense_type_id' , 2)->sum('amount')) }}</td>
               <td>{{ $assignment_amount }}</td>
               <td>{{ $assignment_amount - ($superTotal + $data['expenses']->where('expense_type_id' , 1)->sum('amount') + $data['expenses']->where('expense_type_id' , 2)->sum('amount')) }}</td>
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
