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
       
        Route::get('/salary-report', \App\Http\Livewire\Admin\Reports\SalaryReport::class)->name('salary.report');
        
    });
    
    Route::get('/aptsettings', \App\Http\Livewire\Admin\Aptsettings\Aptsettings::class)->name('admin.Aptsettings');
  
    Route::get('/companies', \App\Http\Livewire\Admin\Companies\Companies::class)->name('admin.companies');
    Route::get('/employees', \App\Http\Livewire\Admin\Employees\Employees::class)->name('admin.employees');
    Route::get('/Salarygeneration/view', \App\Http\Livewire\Admin\Salarygenerations\ViewSalarygenerations::class)->name('admin.view_salaries');
    Route::get('/Salarygeneration/add', \App\Http\Livewire\Admin\Salarygenerations\AddSalarygenerations::class)->name('admin.add_salaries');
    Route::get('/Salarygeneration/edit/{id}', \App\Http\Livewire\Admin\Salarygenerations\EditSalarygenerations::class)->name('admin.edit_salaries');
    Route::get('/admin/salaries/{id}', \App\Http\Livewire\Admin\Salaries\SalaryView::class)->name('admin.salaries.view');

});



