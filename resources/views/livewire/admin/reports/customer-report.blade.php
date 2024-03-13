<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['customer_report'] ?? 'Maintainance Report'}}</strong></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-0">
                <div class="card-header p-3">
                    <div class="row">
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
                                <label class="form-label">{{$lang->data['partstype'] ?? 'Parts Type '}}</label>
                                <select class="form-control" wire:model="partstype_id">
                                    <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                                    @foreach ($partstype as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="col-md-3">
                        <label class="form-label">{{$lang->data['vehicle'] ?? 'Bus File no. '}}</label>
                        <select class="form-control" wire:model="vehicle_file_no">
                            <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                            @foreach ($vehicle as $v)
                                <option value="{{$v->file_no }}">
                                      {{$v->file_no}} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                        
                        <div class="col-md-3 d-n-p">
                            <br>
                            <a href="#" class="btn btn-primary" wire:click='getData'>{{$lang->data['search'] ?? 'Search'}}</a>
      <!--                  <div class="col-md-2">
                                <br>
                                <a href="#" class="btn btn-primary" wire:click="exportToExcel">{{$lang->data['excel'] ?? 'Excel'}}</a>
                                <a href="#" class="btn btn-primary" wire:click="exportToPDF">{{$lang->data['pdf'] ?? 'PDF'}}</a>
                        </div>    !-->
                        
                        </div>
                         <div class="col-2"> 
                                    <br>
                                    <a class="btn btn-primary print d-n-p">Print</a>
                                </div>
                    </div>
        </div>
    </div>
                </div>
</div>
<br>
                        @if(count($reportData) > 0)
                <div class="card-body p-0">
                    <table class="table table-striped table-sm table-bordered mb-0">
                        <thead class="bg-secondary-light">
                            <tr>
                                <th class="tw-15">{{$lang->data['date'] ?? 'Date'}}</th>
                                <th class="tw-15">{{$lang->data['vehicle_plate_no'] ?? 'Bus File no.'}}</th>
                                <th class="tw-15">{{$lang->data['parts_type'] ?? 'Parts Type '}}</th>
                                <th class="tw-15">{{$lang->data['amount'] ?? 'Parts Amount'}}</th>
                                <th class="tw-15">{{$lang->data['garage_services_charges'] ?? 'Garage Services Charges'}}</th>
                                <th class="tw-15">{{$lang->data['description'] ?? 'Description'}}</th>
                                <th class="tw-15">{{$lang->data['total'] ?? 'Total'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $superTotal = 0; // Initialize the super total variable
                            @endphp
                    
                            @foreach ($reportData as $item)
                                
                            <tr>
                                 <td>{{$item->date->format('F j, Y') }}</td>
                                <td align="center">{{$item->vehicle_file_no}} </td>
                                <td><span class="badge bg-dark">{{$item->partstype->name}}</span></td>
                                <td>{{$item->payment}}</td>
                                <td>{{$item->garage_services_charges}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->total}}</td>
                               
                            </tr>
                             </tr>
                        @php
                                $superTotal += $item->total; // Add the 'amount' to the super total
                                @endphp
                            @endforeach
                        <tr>
                            <td colspan="6">Super Total:</td>
                            <td>{{ $superTotal }}</td>
                        </tr>
                            
                        </tbody>
                    </table>
                    @else
                        <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data was found..'}}" />
                    @endif
                </div>
            </div>
        
