<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employees;
use App\Models\Flat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request["name"] ?? "";
        if(!empty($search)){
            $employees = Employee::where("name" , "LIKE" , "%$search%")->get();
        }else{
            $employees = Employee::all();
        }
        return view("dashboard.employees.listing", compact("employees" , "search"));
    }

    public function createPage()
    {
        $flats = Flat::all();
        return view("dashboard.employees.add" , compact("flats"));
    }

    public function editPage($id){
        if($id){
            $flats = Flat::all();
            $employee = Employee::find($id);
            return view("dashboard.employees.edit" , compact("flats" , "employee"));
        }
    }

    public function singlePage($id){
        if($id){
            $employee = Employee::find($id);
            $employee->start_date = Carbon::parse($employee->start_date);
            return view("dashboard.employees.single" , compact("employee"));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "role" => "required",
            "name" => "required",
            "address" => "required",
            "cnic" => "required",
            "salary" => "required",
            "comps" => "required",
            "status" => "required",
            "start_date" => "required",
        ]);

        $employee = new Employee();

        $employee->role = $request->role;
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->cnic = $request->cnic;
        $employee->salary = $request->salary;
        $employee->comps = $request->comps;
        $employee->status = $request->status;
        $employee->start_date = $request->start_date;

        $employee->save();

        if($employee){
            return redirect("/dashboard/employees")->with("success" , "Employee Created SuccessFully!");
        }else{
            return redirect("/dashboard/employees")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/employees/add");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $employee = Employee::find($request->id);

        if(!$employee){
            return redirect("/dashboard/employees")->with("fail" , "Employee Not Found!");
        }

        $request->validate([
            "role" => "required",
            "name" => "required",
            "address" => "required",
            "cnic" => "required",
            "salary" => "required",
            "comps" => "required",
            "status" => "required",
            "start_date" => "required",
        ]);

        $employee->role = $request->role;
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->cnic = $request->cnic;
        $employee->salary = $request->salary;
        $employee->comps = $request->comps;
        $employee->status = $request->status;
        $employee->start_date = $request->start_date;

        $employee->save();

        if($employee){
            return redirect("/dashboard/employees")->with("success" , "Employee Updated SuccessFully!");
        }else{
            return redirect("/dashboard/employees")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/employees/edit/" , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);

        if ($employee) {
            $employee->delete();
            return redirect("/dashboard/employees")->with("success", "Employee Deleted SuccessFully!");
        }
    }
}
