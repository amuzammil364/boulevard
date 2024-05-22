<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Option;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class PaymentsController extends Controller
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
        $filters->flat_id = "";
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $flats = Flat::all();
        $filters_is_empty = true;


        
        $payments = Payment::with('flat');
        
        if( isset($request->payment_month) && !empty($request->payment_month) ){
            $currentMonth = date('m', strtotime($request->payment_month));
            $currentYear = date('Y', strtotime($request->payment_month));
            $payments = $payments->whereMonth('payment_month', $currentMonth)->whereYear('payment_month', $currentYear);
            $filters->date = $request->payment_month;
        }

        if(isset($request->status) && !empty($request->status)){
            $payments = $payments->where('status',$request->status);
            $filters->status = $request->status;
        }

        if(isset($request->type) && !empty($request->type)){
            $payments = $payments->where('type',$request->type);
            $filters->type = $request->type;
        }

        if(isset($request->flat_id) && !empty($request->flat_id)){
            $payments = $payments->where('flat_id',$request->flat_id);
            $filters->flat_id = $request->flat_id;
        }

        if(isset($request->payment_month) && !empty($request->payment_month) 
        || isset($request->status) && !empty($request->status)
    || isset($request->type) && !empty($request->type)
    || isset($request->flat_id) && !empty($request->flat_id)
        ){
            $filters_is_empty = false;
        }

        $payments = $payments->orderby('id', 'DESC')->get();

        $total_amount = $payments->sum('amount');
        $payments_count = $payments->count();
        return view("dashboard.payments.listing", compact("payments", "filters", "filters_is_empty", "flats", "total_amount" , "payments_count"));
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
