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
                        <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{$lang->data['driver']??' ATP Setting '}} </span> &nbsp;
            
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

            </ul>
        </div>
    </nav>
</div>
