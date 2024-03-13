<div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['translations'] ?? 'Translations'}}</strong></h3>
        </div>
        @if(Auth::user()->can('add_translation'))
        <div class="col-auto ms-auto text-end mt-n1">
            <a href="{{route('admin.add_translation')}}" class="btn btn-primary" >{{$lang->data['new_translation'] ?? 'New Translation'}}</a>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="bg-secondary-light">
                            <tr>
                                <th class="tw-5">{{$lang->data['sl'] ?? 'Sl'}}</th>
                                <th class="tw-40">{{$lang->data['name'] ?? 'Name'}}</th>
                                <th class="tw-20">{{$lang->data['actions'] ?? 'Actions'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($translations as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    {{$item->name}} @if($item->is_default) <span class="badge badge-primary">{{$lang->data['default'] ??  'Default'}}</span> @endif
                                </td>
                                <td>
                                    @if(Auth::user()->can('edit_translation'))
                                    <a href="{{route('admin.edit_translation',$item->id)}}" class="btn btn-sm btn-primary" >{{$lang->data['edit'] ?? 'Edit'}}</a>
                                    @endif
                                    @if(Auth::user()->can('delete_translation'))
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="delete({{$item}})">{{$lang->data['delete'] ?? 'Delete'}}</a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    @if(count($translations) == 0)
                        <x-no-data-component message="{{$lang->data['no_translations_found'] ?? 'No translations were found..'}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
