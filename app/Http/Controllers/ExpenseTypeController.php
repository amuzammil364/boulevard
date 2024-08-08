<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_types = ExpenseType::all();
        $expense_types_count = ExpenseType::count();

        return view("dashboard.expense_types.listing",compact("expense_types" , "expense_types_count"));
    }

    public function createPage()
    {
        return view("dashboard.expense_types.add");
    }

    public function editPage($id)
    {
        $expense_type = ExpenseType::find($id);

        if($expense_type){
            return view("dashboard.expense_types.edit" , compact("expense_type"));
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
            "name" => "required",
        ]);

        $expense_type = new ExpenseType();

        $expense_type->name = $request->name;

        $expense_type->save();

        if ($expense_type) {
            return redirect("/dashboard/expense-types")->with("success", "Type Created SuccessFully!");
        } else {
            return redirect("/dashboard/expense-types")->with("fail", "Something Went Wrong!");
        }

        return redirect("/dashboard/expense-types/add");
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
        $expense_type = ExpenseType::find($request->id);

        if (!$expense_type) {
            return redirect("/dashboard/expense-types")->with("fail", "Expense Type Not Found!");
        }

        $request->validate([
            "name" => "required",
        ]);

        $expense_type->name = $request->name;

        $expense_type->save();

        if ($expense_type) {
            return redirect("/dashboard/expense-types")->with("success", "Type Updated SuccessFully!");
        } else {
            return redirect("/dashboard/expense-types")->with("fail", "Something Went Wrong!");
        }

        return redirect("/dashboard/expense-types/edit/", $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
