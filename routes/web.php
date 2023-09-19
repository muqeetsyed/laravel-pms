<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubProjectController;
use App\Models\Employee;
use App\Models\Project;
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


Route::get('projects', function(){
    return view('Project.list', [
        'records' => Project::all(),
    ]);
})->name("peoject.list");

Route::get('/project/create', [ProjectController::class, 'create'])->name("project.create");
Route::post('/project/store', [ProjectController::class, 'store'])->name("project.store");
Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name("project.edit");
Route::put('/project/{id}', [ProjectController::class, 'update'])->name("project.update");

Route::get('/subproject/{projectId}/create', [SubProjectController::class, 'create'])->name("subproject.create");
Route::post('/subproject/store', [SubProjectController::class, 'store'])->name("subproject.store");








