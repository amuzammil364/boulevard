<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request["payment_id"] ?? "";
        if (!empty($search)) {
            $payments = Payment::where("payment_id", "LIKE", "%$search%")->get();
        } else {
            $payments = Payment::with('flat')->get();
        }
        return view("dashboard.payments.listing", compact("payments", "search"));
    }

    public function createPage()
    {

        $global_maintenance = Option::where('key','maintenance_amount')->first();
        if($global_maintenance){
            $global_maintenance = $global_maintenance->value;
        }else{
            $global_maintenance = "";
        }
        $collection_due_day = Option::where('key','collection_due_day')->first();
        if($collection_due_day){
            $collection_due_day = $collection_due_day->value;
        }else{
            $collection_due_day = '01';
        }
        $due_date = date('Y-m-'.$collection_due_day);

        $flats = Flat::all();

        $payments = Payment::orderby('id','DESC')->get();
        $receipt_id = 1;
        if(sizeof($payments)>0){
            $receipt_id = $payments[0]->id + 1;
        }
        $receipt_id = str_pad($receipt_id, 4, '0', STR_PAD_LEFT);
        $payment_id = uniqid();
        return view("dashboard.payments.add", compact("flats" , "payment_id", "global_maintenance", "due_date", "receipt_id"));
    }

    public function editPage($id)
    {
        if ($id) {
            $flats = Flat::all();
            $payment = Payment::find($id);
            return view("dashboard.payments.edit", compact("flats", "payment"));
        }
    }

    public function singlePage($id)
    {
        if ($id) {
            $payment = Payment::with("flat")->find($id);
            $payment->due_date = Carbon::parse($payment->due_date);
            $payment->paid_date = Carbon::parse($payment->paid_date);
            return view("dashboard.payments.single", compact("payment"));
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
            "flat_id" => "required",
            "type" => "required",
            "status" => "required",
            "payment_id" => "required",
            "amount" => "required",
            "mode_of_payment" => "required",
        ]);

        if($request->type == "Maintenance"){
            $request->validate([
                "payment_month" => "required",
            ]);
    
        }

        $payment = new Payment();

        $payment->flat_id = $request->flat_id;
        $payment->type = $request->type;
        $payment->status = $request->status;
        $payment->payment_id = $request->payment_id;
        $payment->amount = $request->amount;
        $payment->mode_of_payment = $request->mode_of_payment;
        $payment->due_date = $request->due_date;
        $payment->paid_date = $request->paid_date;
        $payment->payment_month = date('Y-m-d', strtotime($request->payment_month));
        $payment->reference = $request->reference;
        $payment->receipt_id = $request->receipt_id;

        $payment->save();

        $transaction = new Transaction();

        $transaction->payment_id = $payment->id;
        $transaction->expense_id = null;
        $transaction->type = "Credit";
        $transaction->amount = $payment->amount;

        $transaction->save();

        if ($payment && $transaction) {
            return redirect("/dashboard/payments")->with("success", "Payment Created SuccessFully!");
        } else {
            return redirect("/dashboard/payments")->with("fail", "Something Went Wrong!");
        }

        return redirect("/dashboard/payments/add");
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

        $payment = Payment::find($request->id);
        $transaction = Transaction::where("payment_id", $payment->id)->first();

        if (!$payment && !$transaction) {
            return redirect("/dashboard/payments")->with("fail", "Payment Not Found!");
        }

        $request->validate([
            "flat_id" => "required",
            "type" => "required",
            "status" => "required",
            "payment_id" => "required",
            "amount" => "required",
            "mode_of_payment" => "required",
        ]);

        if($request->type == "Maintenance"){
            $request->validate([
                "payment_month" => "required",
            ]);    
        }


        $payment->flat_id = $request->flat_id;
        $payment->type = $request->type;
        $payment->status = $request->status;
        $payment->payment_id = $request->payment_id;
        $payment->amount = $request->amount;
        $payment->mode_of_payment = $request->mode_of_payment;
        $payment->due_date = $request->due_date;
        $payment->paid_date = $request->paid_date;
        $payment->payment_month = date('Y-m-d', strtotime($request->payment_month));
        $payment->reference = $request->reference;
        $payment->receipt_id = $request->receipt_id;

        $payment->save();


        $transaction->payment_id = $payment->id;
        $transaction->expense_id = null;
        $transaction->type = "Credit";
        $transaction->amount = $payment->amount;

        $transaction->save();

        if ($payment && $transaction) {
            return redirect("/dashboard/payments")->with("success", "Payment Updated SuccessFully!");
        } else {
            return redirect("/dashboard/payments")->with("fail", "Something Went Wrong!");
        }

        return redirect("/dashboard/payments/edit/", $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $payment = Payment::find($request->id);
        $transaction = Transaction::where("payment_id", $request->id)->first();

        if ($payment) {
            if($transaction){
                $transaction->delete();
            }
            $payment->delete();
            return redirect("/dashboard/payments")->with("success", "Payment Deleted SuccessFully!");
        }
    }
}
