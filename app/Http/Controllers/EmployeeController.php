<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller {

    public function createEmployee():View
    {
        //This is for next url, after the user clicks on save button
        //it should go to the store.employee route to save the input details
        $url = route('store.employee');
        $employee = null;


        return view('Employee.form', compact('url','employee'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeEmployee(Request $request):RedirectResponse {

        $request->validate([
            'employeeName' => 'required|max:9|unique:employees,name,',
            'employeeUsername' => 'required|max:8',
            'employeePassword' => ['required','min:8', Rule::unique('employees', 'password')],
            'employeeEmail' => ['nullable','email'],
        ]);


        $employee = new Employee;

        $employee->name = $request->employeeName;
        $employee->username = $request->employeeUsername;
        $employee->password = $request->employeePassword;
        $employee->email = $request->employeeEmail;

        if($request->employeeRole && EmployeeRole::from($request->employeeRole)) {
            $employee->role = EmployeeRole::from($request->employeeRole);
        }

        $employee->save();

        $request->flash();

        return redirect()->route('employee.edit', ['slug' => $employee->id])->with("success","changes saved successfully!");
    }


    public function editEmployee(string $id): View
    {
        $employee = Employee::find($id);


        //This is for next url, after the user clicks on save button for update
        //it should go to the employee.update route to update the input details
        $url = route('employee.update', ['slug' => $employee->id]);

        return view('Employee.form', compact('employee', 'url'));
    }

    public function updateEmployee(Request $request, string $id): View|RedirectResponse
    {
        $request->validate([
            'employeeUsername' => 'required|max:8',
            'employeePassword' => ['required','min:8', Rule::unique('employees', 'password')],
            'employeeEmail' => ['nullable','email'],
        ]);

        $employee = Employee::find($id);

        if(!$employee instanceof Employee){
            return redirect()->back()->with("error","changes not saved!");
        }

        $employee->name = $request->employeeName;
        $employee->username = $request->employeeUsername;
        $employee->password = $request->employeePassword;
        $employee->email = $request->employeeEmail;

        if($request->employeeRole && EmployeeRole::from($request->employeeRole)) {
            $employee->role = EmployeeRole::from($request->employeeRole);
        }

        $employee->save();

        $request->flash();

        return redirect()->back()->with("success","changes saved successfully!");
    }


    public function removeEmployee(Request $request,string $id){
        $employee = Employee::find($id);

        if (!$employee instanceof Employee) {
            return redirect()->back()->with("error", "Changes not saved!");
        }

        $employee->delete();

        return redirect()->route('list-employees')->with("success","employee removed successfully!!");
    }


}
