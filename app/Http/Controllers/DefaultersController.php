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
        $type = $request->type ?? "Maintenance";

        $collectionTypesTotal = [];

        $startMonth = isset($request->defaulter_from_month) ? Carbon::createFromFormat('Y-m', $request->defaulter_from_month)->startOfMonth() : Carbon::now()->startOfMonth();
        $endMonth = isset($request->defaulter_to_month) ? Carbon::createFromFormat('Y-m', $request->defaulter_to_month)->endOfMonth() : Carbon::now()->endOfMonth();

        $monthRange = CarbonPeriod::create($startMonth, '1 month', $endMonth);

        foreach($monthRange as $month){
            $key = $month->format("M Y");

            if (!isset($collectionTypesTotal[$key])) {
                $collectionTypesTotal[$key] = [
                    "month" => $key,
                    "number_of_rows" => 0,
                    "amount" => 0
                ];
            }

            $amount = Payment::whereMonth("payment_month", $month->format("m"))->where("type", $type)->where('status', 'Pending')->sum("amount");
            
            $count = Payment::whereMonth("payment_month", $month->format("m"))->where("type", $type)->where('status', 'Pending')->count();
            
            $collectionTypesTotal[$key]['amount'] += $amount;
            $collectionTypesTotal[$key]['number_of_rows'] += $count;
        }

        $fromDate = Carbon::createFromFormat('Y-m', $from_date)->startOfMonth();
        $toDate = Carbon::createFromFormat('Y-m', $to_date)->endOfMonth();
        
        $flats = Flat::with(['payments' => function($query) use ($fromDate, $toDate , $type) { 
            $query->whereBetween('payment_month', [$fromDate, $toDate])->where("type" , $type)->where('status', 'Pending')->orderBy("payment_month" , "DESC");}, 'residents'])->get();

        $flats = $flats->filter(function($flat) {
            $totalAmount = $flat->payments->sum('amount');
            $flat->totalAmount = $totalAmount;
            return $totalAmount > 0;
        });

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
