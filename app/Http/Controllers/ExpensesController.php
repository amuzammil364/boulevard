<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use App\Models\Resident;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class ExpensesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filters = new stdClass();
        $filters->date = "";
        $filters->status = "";
        $filters->type = "";
        $filters->employee_id = "";
        $employees = Employee::all();


        $expenses = Expense::with('employee');

        if(isset($request->status) && !empty($request->status)){
            $expenses = $expenses->where('status',$request->status);
            $filters->status = $request->status;
        }

        if(isset($request->type) && !empty($request->type)){
            $expenses = $expenses->where('type',$request->type);
            $filters->type = $request->type;
        }

        if(isset($request->employee_id) && !empty($request->employee_id)){
            $expenses = $expenses->where('employee_id',$request->employee_id);
            $filters->employee_id = $request->employee_id;
        }

        $expenses = $expenses->orderby('id','DESC')->get();

        $total_amount = $expenses->sum('amount');

        return view("dashboard.expenses.listing", compact("expenses", "filters", "employees", "total_amount"));
    }

    public function createPage()
    {
        $employees = Employee::all();
        $residents = Resident::all();


        // $expenses = Expense::orderby('id','DESC')->get();
        // $payment_id = 1;
        // if(sizeof($expenses)>0){
        //     $payment_id = $expenses[0]->id + 1;
        // }
        // $payment_id = str_pad($payment_id, 4, '0', STR_PAD_LEFT);
        $payment_id = uniqid();
        return view("dashboard.expenses.add", compact("employees" , "residents", "payment_id"));
    }

    public function editPage($id)
    {
        if ($id) {
            $employees = Employee::all();
            $residents = Resident::all();
            $expense = Expense::find($id);
            return view("dashboard.expenses.edit", compact("employees", "residents", "expense"));
        }
    }

    public function singlePage($id)
    {
        if ($id) {
            $payment = Expense::with("employee")->find($id);
            $payment->due_date = Carbon::parse($payment->due_date);
            $payment->paid_date = Carbon::parse($payment->paid_date);
            return view("dashboard.expenses.single", compact("payment"));
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
            "type" => "required",
            "status" => "required",
            "payment_id" => "required",
            "mode_of_payment" => "required",
            "amount" => "required",
        ]);

        // Validations on conditions
        if($request->type == "Salary"){
            $request->validate([
                "employee_id" => "required",
            ]);                
        }else{
            $request->validate([
                "reference" => "required",
            ]);                
        }

        $expense = new Expense();

        $expense->employee_id = $request->employee_id;
        $expense->type = $request->type;
        $expense->status = $request->status;
        $expense->payment_id = $request->payment_id;
        $expense->amount = $request->amount;
        $expense->mode_of_payment = $request->mode_of_payment;
        $expense->due_date = $request->due_date;
        $expense->paid_date = $request->paid_date;
        $expense->reference = $request->reference;
        $expense->resident_id = $request->resident_id;

        $expense->save();

        $transaction = new Transaction();

        $transaction->payment_id = null;
        $transaction->expense_id = $expense->id;
        $transaction->type = "Debit";
        $transaction->amount = $expense->amount;

        $transaction->save();

        if($expense && $transaction){
            return redirect("/dashboard/expenses")->with("success" , "Expense Created SuccessFully!");
        }else{
            return redirect("/dashboard/expenses")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/expenses/add");

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

        $expense = Expense::find($request->id);
        $transaction = Transaction::where("expense_id", $expense->id)->first();

        if (!$expense && !$transaction) {
            return redirect("/dashboard/expenses")->with("fail", "Expense Not Found!");
        }

        $request->validate([
            "type" => "required",
            "status" => "required",
            "payment_id" => "required",
            "amount" => "required",
            "mode_of_payment" => "required",
        ]);


        // Validations on conditions
        if($request->type == "Salary"){
            $request->validate([
                "employee_id" => "required",
            ]);                
        }else{
            $request->validate([
                "reference" => "required",
            ]);                
        }

        $expense->employee_id = $request->employee_id;
        $expense->type = $request->type;
        $expense->status = $request->status;
        $expense->payment_id = $request->payment_id;
        $expense->amount = $request->amount;
        $expense->mode_of_payment = $request->mode_of_payment;
        $expense->due_date = $request->due_date;
        $expense->paid_date = $request->paid_date;
        $expense->reference = $request->reference;
        $expense->resident_id = $request->resident_id;

        $expense->save();

        $transaction->payment_id = null;
        $transaction->expense_id = $expense->id;
        $transaction->type = "Debit";
        $transaction->amount = $expense->amount;

        $transaction->save();

        if ($expense && $transaction) {
            return redirect("/dashboard/expenses")->with("success", "Expense Updated SuccessFully!");
        } else {
            return redirect("/dashboard/expenses")->with("fail", "Something Went Wrong!");
        }

        return redirect("/dashboard/expenses/edit/", $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $expense = Expense::find($request->id);
        $transaction = Transaction::where("expense_id", $request->id)->first();

        if ($expense) {
            if($transaction){
                $transaction->delete();
            }
            $expense->delete();
            return redirect("/dashboard/expenses")->with("success", "Expense Deleted SuccessFully!");
        }
    }
}
