<style>
.arabic-text {
    font-size: 18px; /* Adjust the font size as needed */
    
    
}
.sidebar-nav,.sidebar-content,.sidebar-brand{
background-color: #171D3F !important;
    
}
</style>
<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
                <span class="sidebar-brand-text align-middle">
                    {{getStoreName()}}
                     </span>
                <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter"
                    color="#171D3F" class="mm-3">
                    <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                    <path d="M20 12L12 16L4 12"></path>
                    <path d="M20 16L12 20L4 16"></path>
                </svg>
            </a>

            

            <ul class="sidebar-nav">
                
                <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{$lang->data['dashboard'] ?? 'Dashboard'}}</span>
                    </a>
                </li>
            @if (Auth::user()->can('company_list'))
            <li class="sidebar-item {{ Request::is('admin/companies*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.companies') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['companies']??'Company'}}</span>&nbsp;
                </a>
            </li>
            @endif    
            @if (Auth::user()->can('employee_list'))
            <li class="sidebar-item {{ Request::is('admin/employee*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.employees') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Employee']??'Employees'}}</span>
               
                </a>
            </li>
            @endif       
            @if (Auth::user()->can('assigning_list'))
                <li class="sidebar-item {{ Request::is('admin/VehicleAssignings*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.view_salaries') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['bus_assigning']??'Salary Generation'}}</span>
                        
                    </a>
                </li>
                @endif

               <style>
.arabic-text {
    font-size: 18px; /* Adjust the font size as needed */
    
    
}
.sidebar-nav,.sidebar-content,.sidebar-brand{
background-color: #171D3F !important;
    
}
</style>
<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
                <span class="sidebar-brand-text align-middle">
                    {{getStoreName()}}
                     </span>
                <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter"
                    color="#171D3F" class="mm-3">
                    <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                    <path d="M20 12L12 16L4 12"></path>
                    <path d="M20 16L12 20L4 16"></path>
                </svg>
            </a>

            

            <ul class="sidebar-nav">
                
                <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{$lang->data['dashboard'] ?? 'Dashboard'}}</span>
                    </a>
                </li>
            @if (Auth::user()->can('company_list'))
            <li class="sidebar-item {{ Request::is('admin/settings/app') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.app_settings') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['companies']??'Company'}}</span>&nbsp;
                </a>
            </li>
            @endif    
            @if (Auth::user()->can('employee_list'))
            <li class="sidebar-item {{ Request::is('admin/employee*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.employees') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Employee']??'Employees'}}</span>
               
                </a>
            </li>
            @endif       
            @if (Auth::user()->can('assigning_list'))
                <li class="sidebar-item {{ Request::is('admin/VehicleAssignings*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.view_salaries') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['bus_assigning']??'Salary Generation'}}</span>
                        
                    </a>
                </li>
                @endif
                @if (Auth::user()->can('driver_list'))
                <li class="sidebar-item {{ Request::is('admin/driver*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.Aptsettings') }}">
                        <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{$lang->data['driver']??' APT Setting '}} </span> &nbsp;
            
                    </a>
                </li>
                @endif
                @if (Auth::user()->can('account_settings'))
                 <li class="sidebar-item {{ Request::is('admin/settings') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.account_settings') }}">
                            <i class="align-middle" data-feather="settings"></i> 
                            <span class="align-middle">{{$lang->data['settings'] ?? 'User Settings'}}</span>&nbsp;
                        </a>
                    </li>
                @endif

     @if (Auth::user()->can('sales_report') || Auth::user()->can('day_wise_sales_report') || Auth::user()->can('item_wise_sales_report') || Auth::user()->can('customer_report'))
                <li class="sidebar-item {{ Request::is('admin/reports*') ? 'active' : '' }}">
                    <a data-bs-target="#reports" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">{{$lang->data['reports']??'Reports'}}</span>&nbsp;
                    <span class="arabic-text"></span>
                    </a>
                    <ul id="reports" class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/reports*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                        @if (Auth::user()->can('day_wise_sales_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/salary-report*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('salary.report')}}">{{$lang->data['day_wise_report']??'Salary Report 
                                    '}}&nbsp;
                                    <span class="aarabic-text"></span>
                                    </a></li>
                        @endif
                  
                    </ul>
                </li>
                @endif
<!--
                @if (Auth::user()->can('sales_report') || Auth::user()->can('day_wise_sales_report') || Auth::user()->can('item_wise_sales_report') || Auth::user()->can('customer_report'))
                <li class="sidebar-item {{ Request::is('admin/reports*') ? 'active' : '' }}">
                    <a data-bs-target="#reports" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">{{$lang->data['reports']??'Reports'}}</span>&nbsp;
                    <span class="arabic-text"></span>
                    </a>
                    <ul id="reports" class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/reports*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                        @if (Auth::user()->can('day_wise_sales_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/day-wise*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.daywise_report')}}">{{$lang->data['day_wise_report']??'Assigned Bus 
                                    '}}&nbsp;
                                    <span class="aarabic-text"></span>
                                    </a></li>
                        @endif
                        @if (Auth::user()->can('item_wise_sales_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/item-sales*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.item_sales_report')}}">{{$lang->data['item_wise_report']??'Salary & Petrol
                                     '}}&nbsp;
                                     <span class="arabic-text"></span>
                                     </a></li>
                        @endif
                        @if (Auth::user()->can('customer_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/customer*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.customer_report')}}">{{$lang->data['customer_report']??'Maintainance '}}&nbsp;
                            <span class="arabic-text"></span>
                            </a></li>
                        @endif
                        @if (Auth::user()->can('customer_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/istamara-report*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.sales_report')}}">{{$lang->data['customer_report']??'Istamara '}}&nbsp;
                            <span class="arabic-text">استمارا</span>
                            </a></li>
                        @endif
                         @if (Auth::user()->can('customer_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/bus-owner-report*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.bus_owner_report')}}">{{$lang->data['customer_report']??'Bus Owner '}}&nbsp;
                            <span class="arabic-text">مالك الحافلة</span>
                            </a></li>
                        @endif
                        @if (Auth::user()->can('customer_report'))
                            <li class="sidebar-item {{ Request::is('admin/reports/company-owner-report*') ? 'active' : '' }} "><a class="sidebar-link" href="{{route('admin.company_report')}}">{{$lang->data['customer_report']??'Company Owner '}}&nbsp;
                            <span class="aarabic-text"></span>
                            </a></li>
                        @endif
                    </ul>
                </li>
                @endif
    
      
          
                @if (Auth::user()->can('vehicles_list'))
                <li class="sidebar-item {{ Request::is('admin/vehicles*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.vehicles') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Bus']??'Buses'}}</span> &nbsp;
                        <span class="arabic-text">باصات</span>
                    </a>
                </li>
                @endif
            
                
                !-->

              
               <!--
                 @if (Auth::user()->can('expenses_list') || Auth::user()->can('expensetypes_list'))
                    <li class="sidebar-item {{ Request::is('admin/Expense/*') ? 'active' : '' }}">
                        <a data-bs-target="#expense-forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">{{$lang->data['Expense'] ?? 'Salary & Petrol '}}</span>
                            <span class="arabic-text">    معاش بترول  </span>
                        </a>
                        <ul id="expense-forms"
                            class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/expensetype/*') ? 'show' : '' }}"
                            data-bs-parent="#sidebar">
                            @if (Auth::user()->can('expensetypes_list'))
                            <li class="sidebar-item {{ Request::is('admin/Expense/expensetype*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.expense_type') }}">{{$lang->data['expensetype'] ?? 'معاش بترول'}}&nbsp;<span class="arabic-text"></span></a></li>
                            @endif
                    
                            @if (Auth::user()->can('expenses_list'))
                            <li class="sidebar-item {{ Request::is('admin/Expense/add*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.view_expense') }}">{{$lang->data['expense'] ?? 'Add Salary & Petrol'}}&nbsp;<span class="arabic-text"></span>معاش بترول</a> </li>
                            @endif
                        </ul>
                    </li>
                    @endif
          
                    @if (Auth::user()->can('maintainance_list') || Auth::user()->can('parts_list'))
                    <li class="sidebar-item {{ Request::is('admin/Maintainance/*') ? 'active' : '' }}">
                        <a data-bs-target="#maintainance-forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">{{$lang->data['maintainance'] ?? 'Maintainance'}}</span>&nbsp;
                        <span class="arabic-text">صيانة</span>
                        </a>
                        <ul id="maintainance-forms"
                            class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/partstypes/*') ? 'show' : '' }}"
                            data-bs-parent="#sidebar">
                            @if (Auth::user()->can('parts_list'))
                            <li class="sidebar-item {{ Request::is('admin/partstypes/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.parts_type') }}">{{$lang->data['partstypes'] ?? 'Parts Type'}}&nbsp;
                            <span class="arabic-text">أجزاء الحافلة</span>
    
                            </a>
                            </li>
                            @endif
                    
                            @if (Auth::user()->can('maintainance_list'))
                            <li class="sidebar-item {{ Request::is('admin/inventory/products*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.maintainance') }}">{{$lang->data['maintainance'] ?? 'Maintainance'}}&nbsp;
                            <span class="arabic-text">إضافة الصيانة</span>
                            
                            </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

           
             @if (Auth::user()->can('alwaqatbus_list'))
               <li class="sidebar-item {{ Request::is('admin/alwaqat_buses*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.alwaqat_buses') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Employee']??'Al Waqt Buses'}}</span>&nbsp;
                   <span class="aarabic-text">باصات الوقت</span>
                    </a>
                </li>
                @endif
                
    
          Employees -->
            
            
            <!-- 
            @if (Auth::user()->can('limousine_list'))
            <li class="sidebar-item {{ Request::is('admin/limousines*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.limousine') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['limousine']??'Limousine'}}</span>&nbsp;
                <span class="arabic-text">ليموزين</span>
                </a>
            </li>
            @endif
                @if (Auth::user()->can('add_staff') ||Auth::user()->can('staffs_list') ||Auth::user()->can('edit_staff') || Auth::user()->can('delete_staff'))
                <li class="sidebar-item {{ Request::is('admin/staff*') ? 'active' : '' }}">
                    <a class="sidebar-link " href="{{ route('admin.staffs') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">{{$lang->data['staffs']??'Staffs'}}</span>&nbsp;
                    <span class="arabic-text">عامل</span>
                    </a>
                </li>
                @endif
   @if (Auth::user()->can('translations_list') )
            <li class="sidebar-item {{ Request::is('admin/translations*') ? 'active' : '' }}">
                <a class="sidebar-link " href="{{ route('admin.translations') }}">
                    <i class="align-middle" data-feather="globe"></i> <span class="align-middle">{{$lang->data['translations']??'Translations'}}</span>&nbsp;
                <span class="arabic-text"></span>
                </a>
            </li>
            @endif !-->
          <!--  @if (Auth::user()->can('account_settings') || Auth::user()->can('app_settings'))
            <li class="sidebar-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
                <a data-bs-target="#settings" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{$lang->data['settings']??'User Settings'}}</span>&nbsp;
               
                </a>
                <ul id="settings" class="sidebar-dropdown list-unstyled collapse  {{ Request::is('admin/settings/*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    @if (Auth::user()->can('account_settings') )
                    <li class="sidebar-item {{ Request::is('admin/settings/account') ? 'active' : '' }}" ><a class="sidebar-link"
                            href="{{ route('admin.account_settings') }}">{{$lang->data['account_settings']??'User Settings'}}&nbsp;
                          
                            </a>
                    </li>
                    @endif
                    @if (Auth::user()->can('app_settings') )
                    <li class="sidebar-item {{ Request::is('admin/settings/app') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.app_settings') }}">{{$lang->data['app_settings']??'App
                            Settings'}}&nbsp;
                            </a></li>
                    @endif 
                </ul>
            </li>
            @endif!-->

                     <li class="sidebar-item">
                <a class="sidebar-link" href="#" wire:click.prevent='logout'>
                    <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">{{$lang->data['logout']??'Logout'}}</span>&nbsp;
                   
                </a>
            </li>
            </ul>
        </div>
    </nav>
</div>

    
      
                @if (Auth::user()->can('driver_list'))
                <li class="sidebar-item {{ Request::is('admin/driver*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.Aptsettings') }}">
                        <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{$lang->data['driver']??' APT Setting '}} </span> &nbsp;
            
                    </a>
                </li>
                @endif
              <!--  
          
                @if (Auth::user()->can('vehicles_list'))
                <li class="sidebar-item {{ Request::is('admin/vehicles*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.vehicles') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Bus']??'Buses'}}</span> &nbsp;
                        <span class="arabic-text">باصات</span>
                    </a>
                </li>
                @endif
            
                
                !-->

              
               <!--
                 @if (Auth::user()->can('expenses_list') || Auth::user()->can('expensetypes_list'))
                    <li class="sidebar-item {{ Request::is('admin/Expense/*') ? 'active' : '' }}">
                        <a data-bs-target="#expense-forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">{{$lang->data['Expense'] ?? 'Salary & Petrol '}}</span>
                            <span class="arabic-text">    معاش بترول  </span>
                        </a>
                        <ul id="expense-forms"
                            class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/expensetype/*') ? 'show' : '' }}"
                            data-bs-parent="#sidebar">
                            @if (Auth::user()->can('expensetypes_list'))
                            <li class="sidebar-item {{ Request::is('admin/Expense/expensetype*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.expense_type') }}">{{$lang->data['expensetype'] ?? 'معاش بترول'}}&nbsp;<span class="arabic-text"></span></a></li>
                            @endif
                    
                            @if (Auth::user()->can('expenses_list'))
                            <li class="sidebar-item {{ Request::is('admin/Expense/add*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.view_expense') }}">{{$lang->data['expense'] ?? 'Add Salary & Petrol'}}&nbsp;<span class="arabic-text"></span>معاش بترول</a> </li>
                            @endif
                        </ul>
                    </li>
                    @endif
          
                    @if (Auth::user()->can('maintainance_list') || Auth::user()->can('parts_list'))
                    <li class="sidebar-item {{ Request::is('admin/Maintainance/*') ? 'active' : '' }}">
                        <a data-bs-target="#maintainance-forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">{{$lang->data['maintainance'] ?? 'Maintainance'}}</span>&nbsp;
                        <span class="arabic-text">صيانة</span>
                        </a>
                        <ul id="maintainance-forms"
                            class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/partstypes/*') ? 'show' : '' }}"
                            data-bs-parent="#sidebar">
                            @if (Auth::user()->can('parts_list'))
                            <li class="sidebar-item {{ Request::is('admin/partstypes/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.parts_type') }}">{{$lang->data['partstypes'] ?? 'Parts Type'}}&nbsp;
                            <span class="arabic-text">أجزاء الحافلة</span>
    
                            </a>
                            </li>
                            @endif
                    
                            @if (Auth::user()->can('maintainance_list'))
                            <li class="sidebar-item {{ Request::is('admin/inventory/products*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.maintainance') }}">{{$lang->data['maintainance'] ?? 'Maintainance'}}&nbsp;
                            <span class="arabic-text">إضافة الصيانة</span>
                            
                            </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

           
             @if (Auth::user()->can('alwaqatbus_list'))
               <li class="sidebar-item {{ Request::is('admin/alwaqat_buses*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.alwaqat_buses') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['Employee']??'Al Waqt Buses'}}</span>&nbsp;
                   <span class="aarabic-text">باصات الوقت</span>
                    </a>
                </li>
                @endif
                
    
          Employees -->
            
            
            <!-- 
            @if (Auth::user()->can('limousine_list'))
            <li class="sidebar-item {{ Request::is('admin/limousines*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.limousine') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{$lang->data['limousine']??'Limousine'}}</span>&nbsp;
                <span class="arabic-text">ليموزين</span>
                </a>
            </li>
            @endif
                @if (Auth::user()->can('add_staff') ||Auth::user()->can('staffs_list') ||Auth::user()->can('edit_staff') || Auth::user()->can('delete_staff'))
                <li class="sidebar-item {{ Request::is('admin/staff*') ? 'active' : '' }}">
                    <a class="sidebar-link " href="{{ route('admin.staffs') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">{{$lang->data['staffs']??'Staffs'}}</span>&nbsp;
                    <span class="arabic-text">عامل</span>
                    </a>
                </li>
                @endif
   @if (Auth::user()->can('translations_list') )
            <li class="sidebar-item {{ Request::is('admin/translations*') ? 'active' : '' }}">
                <a class="sidebar-link " href="{{ route('admin.translations') }}">
                    <i class="align-middle" data-feather="globe"></i> <span class="align-middle">{{$lang->data['translations']??'Translations'}}</span>&nbsp;
                <span class="arabic-text"></span>
                </a>
            </li>
            @endif !-->
            @if (Auth::user()->can('account_settings') || Auth::user()->can('app_settings'))
            <li class="sidebar-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
                <a data-bs-target="#settings" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{$lang->data['settings']??'User Settings'}}</span>&nbsp;
               
                </a>
                <ul id="settings" class="sidebar-dropdown list-unstyled collapse  {{ Request::is('admin/settings/*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    @if (Auth::user()->can('account_settings') )
                    <li class="sidebar-item {{ Request::is('admin/settings/account') ? 'active' : '' }}" ><a class="sidebar-link"
                            href="{{ route('admin.account_settings') }}">{{$lang->data['account_settings']??'User Settings'}}&nbsp;
                          
                            </a>
                    </li>
                    @endif
          <!--          @if (Auth::user()->can('app_settings') )
                    <li class="sidebar-item {{ Request::is('admin/settings/app') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.app_settings') }}">{{$lang->data['app_settings']??'App
                            Settings'}}&nbsp;
                            </a></li>
                    @endif !-->
                </ul>
            </li>
            @endif

                     <li class="sidebar-item">
                <a class="sidebar-link" href="#" wire:click.prevent='logout'>
                    <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">{{$lang->data['logout']??'Logout'}}</span>&nbsp;
                   
                </a>
            </li>
            </ul>
        </div>
    </nav>
</div>
