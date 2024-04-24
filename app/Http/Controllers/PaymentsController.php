<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Payment;
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
        if(!empty($search)){
            $payments = Payment::where("payment_id" , "LIKE" , "%$search%")->get();
        }else{
            $payments = Payment::all();
        }
        return view("dashboard.payments.listing", compact("payments" , "search"));
    }

    public function createPage()
    {
        $flats = Flat::all();
        return view("dashboard.payments.add" , compact("flats"));
    }

    public function editPage($id){
        if($id){
            $flats = Flat::all();
            $payment = Payment::find($id);
            return view("dashboard.payments.edit" , compact("flats" , "payment"));
        }
    }

    public function singlePage($id){
        if($id){
            $payment = Payment::with("flat")->find($id);
            $payment->due_date = Carbon::parse($payment->due_date);
            $payment->paid_date = Carbon::parse($payment->paid_date);
            return view("dashboard.payments.single" , compact("payment"));
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
            "due_date" => "required",
            "paid_date" => "required",
        ]);

        $payment = new Payment();

        $payment->flat_id = $request->flat_id;
        $payment->type = $request->type;
        $payment->status = $request->status;
        $payment->payment_id = $request->payment_id;
        $payment->amount = $request->amount;
        $payment->mode_of_payment = $request->mode_of_payment;
        $payment->due_date = $request->due_date;
        $payment->paid_date = $request->paid_date;

        $payment->save();

        if($payment){
            return redirect("/dashboard/payments")->with("success" , "Payment Created SuccessFully!");
        }else{
            return redirect("/dashboard/payments")->with("fail" , "Something Went Wrong!");
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

        if(!$payment){
            return redirect("/dashboard/payments")->with("fail" , "Payment Not Found!");
        }

        $request->validate([
            "flat_id" => "required",
            "type" => "required",
            "status" => "required",
            "payment_id" => "required",
            "amount" => "required",
            "mode_of_payment" => "required",
            "due_date" => "required",
            "paid_date" => "required",
        ]);

        $payment->flat_id = $request->flat_id;
        $payment->type = $request->type;
        $payment->status = $request->status;
        $payment->payment_id = $request->payment_id;
        $payment->amount = $request->amount;
        $payment->mode_of_payment = $request->mode_of_payment;
        $payment->due_date = $request->due_date;
        $payment->paid_date = $request->paid_date;

        $payment->save();

        if($payment){
            return redirect("/dashboard/payments")->with("success" , "Payment Updated SuccessFully!");
        }else{
            return redirect("/dashboard/payments")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/payments/edit/" , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $payment = Payment::find($request->id);

        if ($payment) {
            $payment->delete();
            return redirect("/dashboard/payments")->with("success", "Payment Deleted SuccessFully!");
        }
    }
}
