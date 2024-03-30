<?php
namespace App\Http\Livewire\Admin\Salarygenerations;
use App\Models\Salarygeneration;
use App\Models\Employee;
use App\Models\Company;
use App\Models\AptSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\ManagesSalaries;

 
class EditSalarygenerations extends Component
{
    use ManagesSalaries;
    


    public function render()
    {
        return view('livewire.admin.salaries.edit-salaries');
    }
    /* process before render */
     public function mount($id)
    {
        $this->calculateLastDayOfMonth();
        $this->getSellaryRecord($id);
        $this->employees = Employee::all();

        if(!Auth::user()->can('add_assigning'))
        {
            abort(404);
        }

    }

    public function getSellaryRecord($id){

        
       $this->editData = Salarygeneration::where('id', $id)->first();
       $this->sallery = Salarygeneration::where('id', $id)
            ->select([
                'salary_date',
                'employee_id',
                'working_hours',
                'fixed_gross_salary as fixed_salary',
                'hourly_gross_salary as gross_salary',
                'atp_tax as atp_amount',
                'am_income',
                'am_contributions',
                'am_tax as am_amount',
                'a_income',
                'personal_deduction',
                'tax_base',
                'draw_percentage',
                'tax_amount',
                'a_tax',
                'traveling_hours',
                'da_rate',
                'driving_allowance',
                'net_salary',
            ])
            ->first()
            ->toArray();


            $this->salary_date = $this->sallery['salary_date'];
        $this->employee_id = $this->sallery['employee_id'];
        $this->working_hours = $this->sallery['working_hours'];
        $this->fixed_salary = $this->sallery['fixed_salary'];

        $this->gross_salary = $this->sallery['gross_salary'];
        $this->atp_amount = $this->sallery['atp_amount'];
        $this->am_income = $this->sallery['am_income'];

        $this->am_contributions = $this->sallery['am_contributions'];
        $this->am_amount = $this->sallery['am_amount'];
        $this->a_income = $this->sallery['a_income'];

        $this->personal_deduction = $this->sallery['personal_deduction'];
        $this->tax_base = $this->sallery['tax_base'];
        $this->draw_percentage = $this->sallery['draw_percentage'];
        $this->tax_amount = $this->sallery['tax_amount'];
        $this->a_tax = $this->sallery['a_tax'];

        $this->traveling_hours = $this->sallery['traveling_hours'];
        $this->da_rate = $this->sallery['da_rate'];
        $this->driving_allowance = $this->sallery['driving_allowance'];
        $this->net_salary = $this->sallery['net_salary'];$this->salary_date = $this->sallery['salary_date'];
        $this->employee_id = $this->sallery['employee_id'];
        $this->working_hours = $this->sallery['working_hours'];
        $this->fixed_salary = $this->sallery['fixed_salary'];

        $this->gross_salary = $this->sallery['gross_salary'];
        $this->atp_amount = $this->sallery['atp_amount'];
        $this->am_income = $this->sallery['am_income'];

        $this->am_contributions = $this->sallery['am_contributions'];
        $this->am_amount = $this->sallery['am_amount'];
        $this->a_income = $this->sallery['a_income'];

        $this->personal_deduction = $this->sallery['personal_deduction'];
        $this->tax_base = $this->sallery['tax_base'];
        $this->draw_percentage = $this->sallery['draw_percentage'];
        $this->tax_amount = $this->sallery['tax_amount'];
        $this->a_tax = $this->sallery['a_tax'];

        $this->traveling_hours = $this->sallery['traveling_hours'];
        $this->da_rate = $this->sallery['da_rate'];
        $this->driving_allowance = $this->sallery['driving_allowance'];
        $this->net_salary = $this->sallery['net_salary'];
            //dd($this->salary_date); 

        
       //dd($this->sallery);
    }
    public function save(){
        $this->create($this->editData);
    }
    
}