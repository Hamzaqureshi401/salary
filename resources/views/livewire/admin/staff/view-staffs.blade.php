<div>
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['staffs']??'Staffs'}}</strong></h3>
    </div>
    @if (Auth::user()->can('add_staff'))
    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.create_staff')}}" class="btn btn-primary">{{ $lang->data['new_staff'] ?? 'New Staff' }}</a>
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
                            <th class="tw-5">{{ $lang->data['sl'] ?? 'Sl' }}</th>
                            <th class="tw-40">{{ $lang->data['name'] ?? 'Name' }}</th>
                            <th class="tw-15">{{ $lang->data['contact_number'] ?? 'Contact Number' }}</th>
                            <th class="tw-15">{{ $lang->data['email'] ?? 'Email' }}</th>
                            <th class="tw-15">{{ $lang->data['actions'] ?? 'Actions' }}</th>
                        </tr>
                    </thead>
                    @if (Auth::user()->can('staffs_list'))
                    <tbody>
                    @foreach ($staffs as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                            @if (Auth::user()->can('edit_staff'))
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.edit_staff',$row->id) }}"> {{ $lang->data['edit'] ?? 'Edit' }}</a>
                            @endif
                            @if (Auth::user()->can('delete_staff'))
                                <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{ $row->id }})"> {{ $lang->data['delete'] ?? 'Delete' }}</a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    @endif
                </table>
                @if(count($staffs) == 0)
                    <x-no-data-component message="{{$lang->data['no_staffs_found']??'No staffs were found..'}}" />
                @endif
            </div>
        </div>
    </div>
</div>
</div>