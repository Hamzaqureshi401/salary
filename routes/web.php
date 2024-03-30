<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', \App\Http\Livewire\Login::class)->name('login')->middleware('install');
Route::group(['prefix' => 'admin/', 'middleware' => ['admin','install']], function () {
    Route::get('/dashboard', \App\Http\Livewire\Admin\Home::class)->name('admin.dashboard');
    
    Route::group(['prefix' => 'settings/'], function () {
        Route::get('/app', \App\Http\Livewire\Admin\Settings\AppSettings::class)->name('admin.app_settings');
        Route::get('/account', \App\Http\Livewire\Admin\Settings\AccountSettings::class)->name('admin.account_settings');
    });
    Route::group(['prefix' => 'reports/'], function () {
        Route::get('/detailed-report/{id}/{start_date?}/{end_date?}', \App\Http\Livewire\Admin\Reports\DetailedReport::class)->name('admin.detailed_report');

       // Route::get('/detailed-report/{id}', [DetailedReport::class, 'getdata'])->name('admin.detailed_report'); 
        Route::get('/salary-report', \App\Http\Livewire\Admin\Reports\SalaryReport::class)->name('salary.report');
       Route::get('/company-owner-report', \App\Http\Livewire\Admin\Reports\CompanyOwnerReport::class)->name('admin.company_report');
        
    });
    Route::group(['prefix' => 'translations/'], function () {
        Route::get('/', \App\Http\Livewire\Admin\Translation\Translations::class)->name('admin.translations');
        Route::get('/add', \App\Http\Livewire\Admin\Translation\AddTranslations::class)->name('admin.add_translation');
        Route::get('/edit/{id}', \App\Http\Livewire\Admin\Translation\EditTranslations::class)->name('admin.edit_translation');
    });
  //  Route::get('/customers', \App\Http\Livewire\Admin\Customers\Customers::class)->name('admin.customers');
    Route::get('/aptsettings', \App\Http\Livewire\Admin\Aptsettings\Aptsettings::class)->name('admin.Aptsettings');
  
    Route::get('/companies', \App\Http\Livewire\Admin\Companies\Companies::class)->name('admin.companies');
    Route::get('/drivers', \App\Http\Livewire\Admin\Drivers\Drivers::class)->name('admin.driver');
    Route::get('/employees', \App\Http\Livewire\Admin\Employees\Employees::class)->name('admin.employees');
    Route::get('/vehicels', \App\Http\Livewire\Admin\Vehicles\Vehicles::class)->name('admin.vehicles');
    Route::get('/expensetypes', \App\Http\Livewire\Admin\ExpenseTypes\ExpenseTypes::class)->name('admin.expense_type');
    Route::get('/expense/view', \App\Http\Livewire\Admin\Expenses\ViewExpenses::class)->name('admin.view_expense');
    Route::get('/expense/add', \App\Http\Livewire\Admin\Expenses\AddExpenses::class)->name('admin.add_expense');
    Route::get('/expense/edit/{id}', \App\Http\Livewire\Admin\Expenses\EditExpenses::class)->name('admin.edit_expense');
    Route::get('/partstypes', \App\Http\Livewire\Admin\PartsTypes\PartsTypes::class)->name('admin.parts_type');
    Route::get('/maintainance', \App\Http\Livewire\Admin\Maintainances\Maintainances::class)->name('admin.maintainance');
    Route::get('/maintainance/add', \App\Http\Livewire\Admin\Maintainances\AddMaintainances::class)->name('admin.add_maintainance');
    Route::get('/maintainance/edit/{id}', \App\Http\Livewire\Admin\Maintainances\EditMaintainances::class)->name('admin.edit_maintainance');
    Route::get('/limousine', \App\Http\Livewire\Admin\Limousines\Limousines::class)->name('admin.limousine');
    //Vehicle Assigning Route
    Route::get('/vehicleassigning/view', \App\Http\Livewire\Admin\VehicleAssignings\ViewVehicleAssignings::class)->name('admin.view_assigning');
    Route::get('/vehicleassigning/add', \App\Http\Livewire\Admin\VehicleAssignings\AddVehicleAssignings::class)->name('admin.add_assigning');
    Route::get('/vehicleassigning/edit/{id}', \App\Http\Livewire\Admin\VehicleAssignings\EditVehicleAssignings::class)->name('admin.edit_assigning');
    Route::get('/Salarygeneration/view', \App\Http\Livewire\Admin\Salarygenerations\ViewSalarygenerations::class)->name('admin.view_salaries');
    Route::get('/Salarygeneration/add', \App\Http\Livewire\Admin\Salarygenerations\AddSalarygenerations::class)->name('admin.add_salaries');
    Route::get('/Salarygeneration/edit/{id}', \App\Http\Livewire\Admin\Salarygenerations\EditSalarygenerations::class)->name('admin.edit_salaries');
    Route::get('/admin/salaries/{id}', \App\Http\Livewire\Admin\Salaries\SalaryView::class)->name('admin.salaries.view');

});



Route::group(['prefix' => 'install/'], function () {
    Route::get('/', \App\Http\Livewire\Installer\Installer::class)->name('install');
});