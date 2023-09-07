<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name("index");

Route::get('employees', function(){
    return view('Employee.list', [
        'records' => Employee::all(),
    ]);
})->name("list-employees");


Route::get('/employee/create', [EmployeeController::class, 'createEmployee'])->name("add_employee");
Route::post('/employee/store', [EmployeeController::class, 'storeEmployee'])->name('store.employee');
Route::get('employee/{slug}', [EmployeeController::class, 'editEmployee'])->name("employee.edit");


Route::post('employee/update/{slug}', [EmployeeController::class, 'updateEmployee'])->name('employee.update');
Route::get('remove-employee/{slug}', [EmployeeController::class, 'removeEmployee'])->name('employee.remove');
