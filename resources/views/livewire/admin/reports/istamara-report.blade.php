<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['customer_report'] ?? 'Istamara End Date Report'}}</strong></h3>
        </div>
        <div class="col-2"> 
                                    
                                    <a class="btn btn-primary print d-n-p">Print</a>
                                </div>
    </div>

                <br>


<div class="card">
    <div class="card-body p-0">
        @if(count($reportData) > 0)
            <table id="table" class="table-striped table-sm table-bordered mb-0">
                <thead class="bg-secondary-light">
                    <tr>
                        <th class="tw-2">{{$lang->data['sl'] ?? 'Sl'}}</th>
                        <th>{{$lang->data['file_no'] ?? 'File No.'}}</th>
                        <th class="tw-12">{{$lang->data['plate_no'] ?? 'Plate No.'}}</th>
                        <th class="tw-12">{{$lang->data['owner'] ?? 'Owner'}}</th>
                        <th class="tw-12">{{$lang->data['vehicle_type'] ?? 'Vehicle Type'}}</th>
                        <th class="tw-15"><strong>{{$lang->data['insurance_start_date'] ?? 'Istamara End Date'}}</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$item->file_no}}</td>
                            <td>{{$item->plate_no}}</td>
                            <td>{{$item->owner_name}}</td>
                            <td>{{$item->vehicle_type}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->istamara_end_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data was found..'}}" />
        @endif
    </div>
</div>
