<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Payment;
use Carbon\Carbon;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $date = date('Y-m');
        $opening_balance = 0;
        if(isset($request->opening_balance) && $request->opening_balance != ""){
            $opening_balance = $request->opening_balance;
        }
        
        if(isset($request->summary_month) && $request->summary_month != ""){
            $currentMonth = date("m" , strtotime($request->summary_month));
            $currentYear = date("y" , strtotime($request->summary_month));
            $date = $request->summary_month;
        }

        $expenses_types_total_amount = 0;
        $expenses_types = [
            ["type" => "Salary", "amount" => 0],
            ["type" => "Utility", "amount" => 0],
            ["type" => "Repairs", "amount" => 0],
            ["type" => "Welfare", "amount" => 0],
            ["type" => "Misc", "amount" => 0],
            ["type" => "KElectric", "amount" => 0],
            ["type" => "KWSB", "amount" => 0],
            ["type" => "SSGC", "amount" => 0],
            ["type" => "Cleaning Supplies", "amount" => 0],
            ["type" => "Office Supplies", "amount" => 0],
            ["type" => "Electrical Supplies", "amount" => 0],
            ["type" => "Plumbing Supplies", "amount" => 0],
            ["type" => "Goods Material", "amount" => 0],
            ["type" => "Waste Disposal", "amount" => 0],
            ["type" => "Tv Cable", "amount" => 0],
            ["type" => "Mosque / Prayer", "amount" => 0],
            ["type" => "Water Tanker", "amount" => 0],
            ["type" => "Mason / Brickwork", "amount" => 0],
            ["type" => "Repairs-Electric", "amount" => 0],
            ["type" => "Repairs-Plumbing", "amount" => 0],
            ["type" => "Repairs-Mason", "amount" => 0],
            ["type" => "Decorative Goods", "amount" => 0],
            ["type" => "CCTV Maintenance", "amount" => 0],
        ];

        $paid_collection_types_total_amount = 0;
        $pending_collection_types_total_amount = 0;
        $collection_types = [
            ["type" => "Maintenance", "amount_paid" => 0 , "amount_pending" => 0],
            ["type" => "Welfare", "amount_paid" => 0 , "amount_pending" => 0],
            ["type" => "Misc", "amount_paid" => 0 , "amount_pending" => 0],
            ["type" => "Eid-ul-Adha Provision", "amount_paid" => 0 , "amount_pending" => 0],
            ["type" => "Paint Renovation", "amount_paid" => 0 , "amount_pending" => 0],
        ];

        $collection_types_total_amount_arrears = 0;
        $collection_types_arrears = [
            ["type" => "Maintenance", "amount" => 0],
            ["type" => "Welfare", "amount" => 0],
            ["type" => "Misc", "amount" => 0],
            ["type" => "Eid-ul-Adha Provision", "amount" => 0],
            ["type" => "Paint Renovation", "amount" => 0],
        ];

        $collection_types_total_amount_advance = 0;
        $collection_types_advance = [
            ["type" => "Maintenance", "amount" => 0],
            ["type" => "Welfare", "amount" => 0],
            ["type" => "Misc", "amount" => 0],
            ["type" => "Eid-ul-Adha Provision", "amount" => 0],
            ["type" => "Paint Renovation", "amount" => 0],
        ];


        foreach($expenses_types as $index => $expenses_type){
            $amount = Expense::whereMonth('expense_month', $currentMonth)->where('type', $expenses_type['type'])->where('amount', '!=', 0)->where('status' , 'Paid')->sum('amount');
            $expenses_types[$index]['amount'] = $amount;
            $expenses_types_total_amount += $amount;
        }


        foreach($collection_types as $index => $collection_type){
            $amount_paid = Payment::whereMonth('payment_month' , $currentMonth)->whereMonth('paid_date' , $currentMonth)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0)->where('status' , 'Paid')->sum('amount');
            $collection_types[$index]['amount_paid'] = $amount_paid;
            $paid_collection_types_total_amount += $amount_paid;
            $amount_pending = Payment::whereMonth('payment_month' , $currentMonth)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0)->where('status' , 'Pending')->sum('amount');
            $collection_types[$index]['amount_pending'] = $amount_pending;
            $pending_collection_types_total_amount += $amount_pending;
        }

        foreach($collection_types_arrears as $index => $collection_type){
            $payments = Payment::whereMonth('payment_month' ,'<', $currentMonth)->whereYear("payment_month" , '<=' , $currentYear)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0);
            $amount = $payments->whereMonth('paid_date' , $currentMonth)->where('status' , 'Paid')->sum('amount');
            $collection_types_arrears[$index]['amount'] = $amount;
            $collection_types_total_amount_arrears += $amount;
        }

        foreach($collection_types_advance as $index => $collection_type){
            $payments = Payment::whereMonth('payment_month' ,'>', $currentMonth)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0);
            $amount = $payments->whereMonth('paid_date' , $currentMonth)->where('status' , 'Paid')->sum('amount');
            $collection_types_advance[$index]['amount'] = $amount;
            $collection_types_total_amount_advance += $amount;
        }



        return view("dashboard.summary.listing" , compact("collection_types_advance", "collection_types_total_amount_advance","collection_types_arrears", "collection_types_total_amount_arrears", "expenses_types" , "expenses_types_total_amount" , "collection_types" , "paid_collection_types_total_amount" , "pending_collection_types_total_amount", "date", "opening_balance"));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
