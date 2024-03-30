<div>
    
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['create_maintainance'] ?? 'Generate Salaries'}}</strong></h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_assigning')}}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
    </div>
</div>


   @include('livewire.admin.salaries.commonSellaryaddUpdate')

</div>
@if($showNotification)
    <script>
        // Use your preferred notification library or custom JavaScript to show the notification here
        alert('Please enter working hours for hourly employee.');
    </script>
@endif