<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'web'])->group(function () {
    Route::resource('company', 'CompaniesController');
    Route::resource('employees', 'EmployeesController');
    Route::get('/employee/pdf', [EmployeesController::class, 'createPDF'])->name('employees.pdf');
    Route::get('/employee/export_excel', [EmployeesController::class, 'exportExcel'])->name('employees.export');
    Route::post('/employee/import_excel', [EmployeesController::class, 'importExcel'])->name('employees.import');
});


