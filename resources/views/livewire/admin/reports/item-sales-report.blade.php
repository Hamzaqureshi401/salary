<div>
    
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['expense_report'] ?? 'Expense Report'}}</strong></h3>
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
                    
                    <div class="col-md-3">
                        <label class="form-label">{{$lang->data['expensetype'] ?? 'Expense Type '}}<span class="text-danger"><strong>*</strong></span></label>
                        <select class="form-control" wire:model="expensetype_id">
                            <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                            @foreach ($expensetype as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                            </div>
                    <div class="col-md-3">
                        <label class="form-label">{{$lang->data['vehicle'] ?? 'Bus File no. '}}<span class="text-danger"><strong>*</strong></span></label>
                        <select class="form-control" wire:model="vehicle_file_no">
                            <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                            @foreach ($vehicle as $v)
                                <option value="{{$v->file_no }}">
                                      {{$v->file_no}} 
                                </option>
                            @endforeach
                        </select>
                        </div>
                </div>
                    
                    <div class="col-md-12">
                       <form wire:submit.prevent="getData">
                            <!-- Your search form goes here -->
                            <div class="row">
                                <!-- Other form fields -->
                                <div class="col-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary d-n-p">
                                        @if ($isFetchingData)
                                            Loading...
                                        @else
                                            {{$lang->data['search'] ?? 'Search'}}
                                        @endif
                                    </button>
                                </div>
                                
                                <div class="col-2"> 
                                    <br>
                                    <a class="btn btn-primary print d-n-p">Print</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
                    @php
                        $superTotal = 0; // Initialize the super total variable
                    @endphp
                        @if(count($reportData) > 0)
            <div class="card-body p-0">
            
                <table class="table table-striped table-sm table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Expense Type</th>
                            <th align="center">Vehicle File No</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <!-- Add more table headers as needed -->
                        </tr>
                    </thead>
                   <tbody>

                        @foreach ($reportData as $expenses)
                        <tr>
                            <td>{{ $expenses->date->format('F j, Y') }}</td>

                            <td>{{ $expenses->expenseType->name }}</td>
                            <td align="center">{{ $expenses->vehicle_file_no }}</td>
                            <td>{{ $expenses->description }}</td>
                            <td>{{ $expenses->amount }}</td>
                            <!-- Add more table columns to display additional data -->
                        </tr>
                        @php
                                $superTotal += $expenses->amount; // Add the 'amount' to the super total
                                @endphp
                            @endforeach
                        <tr>
                            <td colspan="4">Super Total:</td>
                            <td>{{ $superTotal }}</td>
                        </tr>
                   </tbody>
                </table>
                @else()
                    <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>

</div>
