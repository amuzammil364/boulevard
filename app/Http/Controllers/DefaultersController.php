<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Payment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DefaultersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from_date = $request->defaulter_from_month ?? date('Y-m');
        $to_date = $request->defaulter_to_month ?? date('Y-m');
        $type = $request->type;

        $collectionTypesTotal = [];

        $startMonth = isset($request->defaulter_from_month) ? Carbon::createFromFormat('Y-m', $request->defaulter_from_month)->startOfMonth() : Carbon::now()->startOfMonth();
        $endMonth = isset($request->defaulter_to_month) ? Carbon::createFromFormat('Y-m', $request->defaulter_to_month)->endOfMonth() : Carbon::now()->endOfMonth();

        $monthRange = CarbonPeriod::create($startMonth, '1 month', $endMonth);

        foreach($monthRange as $month){
            // get from month and to month as a key
            $key = $month->format("M Y");

            // check not isset collection types total array key means from month and to month
            if (!isset($collectionTypesTotal[$key])) {
                $collectionTypesTotal[$key] = [
                    "month" => $key,
                    "number_of_rows" => 0,
                    "amount" => 0
                ];
            }

            // sum amount
            $amount = Payment::whereMonth("payment_month", $month->format("m"))->where("type", $type)->where('status', 'Pending')->sum("amount");
            
            // sum count means number of rows
            $count = Payment::whereMonth("payment_month", $month->format("m"))->where("type", $type)->where('status', 'Pending')->count();
            
            // set collection types total via key means from month and to month
            $collectionTypesTotal[$key]['amount'] += $amount;
            $collectionTypesTotal[$key]['number_of_rows'] += $count;
        }

        $fromDate = Carbon::createFromFormat('Y-m', $from_date)->startOfMonth();
        $toDate = Carbon::createFromFormat('Y-m', $to_date)->endOfMonth();
        
        $flats = Flat::with(['payments' => function($query) use ($fromDate, $toDate , $type) { 
            $query->whereBetween('payment_month', [$fromDate, $toDate])->where("type" , $type)->where('status', 'Pending');}, 'residents'])->get();

        return view("dashboard.defaulters.listing" , compact("from_date" , "to_date" , "flats" , "type" , "collectionTypesTotal"));
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
