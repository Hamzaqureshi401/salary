<div>
   <div class="row mb-2 mb-xl-3">
      <div class="card ">
         <div class="card-body ">
            <div class="col-auto d-none d-sm-block text-center mb-4">
               <h3><strong style="color: blue;">{{ 'Salary Report'}}</strong></h3>
               <!-- <p>{{ $currentMonthName . '-' .$currentYear}}</p> -->
               <div class="row">
                  <div class="mb-3 col-md-4">
                     <label class="form-label">{{$lang->data['employee'] ?? 'Select a Employee '}}<span class="text-danger"><strong>*</strong></span></label>
                     <select class="form-control" wire:change="filerSalary" wire:model="employee_id">
                        <option selected value="">{{$lang->data['choose'] ?? 'Choose...'}}</option>
                        @foreach ($employees as $item)
                        <option value="{{$item->id}}">{{$item->name}} </option>
                        @endforeach
                     </select>
                     @error('employee_id')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="mb-3 col-md-4">
                     <label class="form-label" for="inputEmail4">
                     {{  'Start Date' }}
                     <span class="text-danger"><strong>*</strong></span>
                     </label>
                     <input type="date" class="form-control" wire:model="start_date" wire:change="filerSalary">
                     @error('start_date')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="mb-3 col-md-4">
                     <label class="form-label" for="inputEmail4">
                     {{  'End Date' }}
                     <span class="text-danger"><strong>*</strong></span>
                     </label>
                     <input type="date" class="form-control" id="lastDay" wire:model="end_date" wire:change="filerSalary">
                     @error('end_date')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@include('livewire.admin.common-salary-page')
</div>