<div>
    
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{$lang->data['create_maintainance'] ?? 'Generate Salaries'}}</strong></h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <a href="{{route('admin.add_assigning')}}" class="btn btn-dark">{{$lang->data['back'] ?? 'Back'}}</a>
    </div>
</div>

<div class="col-md-12">
    <div class="card">

        <div class="card-body">
            <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label" for="inputEmail4">
                    {{ $lang->data['date'] ?? 'Salary Given Date (Defaults to Last Weekday of Month)' }}
                    <span class="text-danger"><strong>*</strong></span>
                </label>
                <input type="date" class="form-control" id="lastDay" placeholder="{{$lang->data['date'] ?? 'Date'}}" wire:model="salary_date" wire:change="calculateLastDayOfMonth">
                @error('salary_date')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">{{$lang->data['employee'] ?? 'Select a Employee '}}<span class="text-danger"><strong>*</strong></span></label>
                    <select class="form-control" wire:change="salarycalculation" wire:model="employee_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($employees as $item)
                            <option value="{{$item->id}}">{{$item->name}} </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-4"><label class="form-label">Employee Nature</label>
                <div class="form-check">
    <input class="form-check-input" type="radio" name="nature_monthly" wire:model="nature_monthly" value="1" disabled>
    <label class="form-check-label" for="nature_monthly">Monthly Fixed Salary</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="nature_hourly" wire:model="nature_hourly" value="0" disabled>
    <label class="form-check-label" for="nature_hourly">Hourly Basis</label>
</div>

                @error('working_nature')
                <span class="text-danger">{{$message}}
                    
                </span>@enderror</div>
            </div>
            <div class="row">
                 <div class="mb-3 col-md-4">
                    <label class="form-label">Working Hours:</label>
                    <input type="text" class="form-control" wire:model="working_hours" required>
                </div>
                
                <div class="mb-3 col-md-4">
                    <label class="form-label">Fixed Salary/ Hourly Rate:</label>
                    <input type="text" class="form-control" wire:model="fixed_salary" >
                    @error('contact_person')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">Gross Salary:</label>
                    <input type="text" class="form-control" wire:model="gross_salary" readonly>
                </div>
            </div>
            <div class="row">
            <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'Working Hours'}} </label>       
                    <input type="number" class="form-control" wire:model="working_hours" wire:input="salarycalculation">
                     @error('working_hours')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'ATP Amount'}}</label>
                    <input type="text" class="form-control" wire:model="atp_amount" readonly>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">AM Income:</label>
                    <input type="text" class="form-control" wire:model="am_income" readonly>
                </div>
            </div>
            <div class="row">
            <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'AM Contribution%'}} </label>       
                    <input type="number" class="form-control" wire:model="am_contributions">
                </div>
                
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'AM Amount'}}</label>
                    <input type="text" class="form-control" wire:model="am_amount" readonly>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">A Income:</label>
                    <input type="text" class="form-control" wire:model="a_income" readonly>
                </div>
            </div>
            <div class="row">
            <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'Personal deduction'}} </label>       
                    <input type="number" class="form-control" wire:model="personal_deduction">
                </div>
                
                <div class="mb-3 col-md-2">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'Tax Base'}}</label>
                    <input type="text" class="form-control" wire:model="tax_base" readonly>
                </div>
                <div class="mb-3 col-md-1">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'Draw %'}}</label>
                    <input type="text" class="form-control" wire:model="draw_percentage" readonly>
                </div>
                <div class="mb-3 col-md-1">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'Tax Amount'}}</label>
                    <input type="text" class="form-control" wire:model="tax_amount" readonly>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">A Tax:</label>
                    <input type="text" class="form-control" wire:model="a_tax" readonly>
                </div>
            </div>
            <div class="row">
            <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputZip">{{$lang->data['amount'] ?? 'Traveling Hours in Km.'}} </label>       
                    <input type="number" class="form-control" wire:model="traveling_hours" wire:input="calculateDrivingAllowence">
                </div>
                
                <div class="mb-3 col-md-2">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'Driving Allowance Rate'}}</label>
                    <input type="text" class="form-control" wire:model="da_rate" readonly>
                </div> 
                <div class="mb-3 col-md-2">
                    <label class="form-label" for="inputZip">{{$lang->data['contact_person'] ?? 'Driving Allowance'}}</label>
                    <input type="text" class="form-control" wire:model="driving_allowance" readonly>
                </div> 
                <div class="mb-3 col-md-4">
                    <label class="form-label">Net Salary:</label>
                    <input type="text" class="form-control" wire:model="net_salary" readonly>
                </div>
                
            </div>

                <button type="button" class="btn btn-primary float-end" :disabled="isUploading == true" wire:click.prevent="create">{{$lang->data['submit'] ?? 'Submit'}}</button>
            </form>
        </div>
    </div>
</div>
</div>
@if($showNotification)
    <script>
        // Use your preferred notification library or custom JavaScript to show the notification here
        alert('Please enter working hours for hourly employee.');
    </script>
@endif