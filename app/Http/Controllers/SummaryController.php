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
        $date = date('Y-m');

        if(isset($request->summary_month) && $request->summary_month != ""){
            $currentMonth = date("m" , strtotime($request->summary_month));
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
        ];

        $collection_types_total_amount = 0;
        $collection_types = [
            ["type" => "Maintenance", "amount" => 0],
            ["type" => "Welfare", "amount" => 0],
            ["type" => "Misc", "amount" => 0],
        ];

        foreach($expenses_types as $index => $expenses_type){
            $amount = Expense::whereMonth('expense_month', $currentMonth)->where('type', $expenses_type['type'])->where('amount', '!=', 0)->sum('amount');
            $expenses_types[$index]['amount'] = $amount;
            $expenses_types_total_amount += $amount;
        }


        foreach($collection_types as $index => $collection_type){
            $amount = Payment::whereMonth('payment_month' , $currentMonth)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0)->sum('amount');
            $collection_types[$index]['amount'] = $amount;
            $collection_types_total_amount += $amount;
        }
        

        return view("dashboard.summary.listing" , compact("expenses_types" , "expenses_types_total_amount" , "collection_types" , "collection_types_total_amount" , "date"));
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