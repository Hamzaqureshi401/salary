<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{ $lang->data['edit_staff'] ?? 'Edit Staff' }}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            <a href="{{route('admin.staffs')}}" class="btn btn-dark">{{ $lang->data['back'] ?? 'Back' }}</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{ $lang->data['staff_name'] ?? 'Satff Name' }}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" placeholder="{{ $lang->data['enter_staff_name'] ?? 'Enter Staff Name' }}" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{ $lang->data['contact_number'] ?? 'Contact Number' }}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control" placeholder="{{ $lang->data['enter_contact_number'] ?? 'Enter Contact Number' }}" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{ $lang->data['email'] ?? 'Email' }}<span class="text-danger"><strong>*</strong></span></label>
                            <input type="email" class="form-control" placeholder="{{ $lang->data['enter_email'] ?? 'Enter Email' }}"wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{ $lang->data['password'] ?? 'Password' }}<span
                                    class="text-danger"><strong>*</strong></span></label>
                            <input type="password" class="form-control" placeholder="{{ $lang->data['enter_password'] ?? 'Enter Password' }}" wire:model="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ $lang->data['address'] ?? 'Address' }}</label>
                        <textarea class="form-control resize-none" rows="4" wire:model="address"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ $lang->data['permissions'] ?? 'Permissions' }}:</label>
                    </div>

                    <div class="row px-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="tw-20">{{ $lang->data['menu_title'] ?? 'Menu Title' }}</th>
                                    <th class="tw-80">{{ $lang->data['actions'] ?? 'Actions' }}</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                                    $permission_individual = App\Models\Permission::latest()->get();
                                    $permission_group = App\Models\Permission::groupBy('list','category')->select('list','category', DB::raw('count(*) as total'))->orderBy('list')->get();
                            @endphp
                            @foreach ($permission_group as $permission)
                            <tr>
                                    <td>{{$permission->category}}</td>
                                    <td>
                                    @foreach ($permission_individual as $row)
                                    @if($permission->list == $row->list)
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $row->id }}" wire:model="selected_permissions.{{ $row->id }}">
                                            <span class="form-check-label">
                                               {{$row-> name }}
                                            </span>
                                        </label>
                                    @endif
                            @endforeach
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary float-end" wire:click.prevent="save">{{ $lang->data['save'] ?? 'Save' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
