<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flat;
use Carbon\Carbon;

class DefaultersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from_date = date('Y-m');
        $to_date = date('Y-m');
        $type = $request->type;

        if(isset($request->defaulter_from_month) && $request->defaulter_from_month != ""){
            $from_date = $request->defaulter_from_month;
        }
        
        if(isset($request->defaulter_to_month) && $request->defaulter_to_month != ""){
            $to_date = $request->defaulter_to_month;
        }


        $fromDate = Carbon::createFromFormat('Y-m', $from_date)->startOfMonth();
        $toDate = Carbon::createFromFormat('Y-m', $to_date)->endOfMonth();

        $flats = Flat::with(['payments' => function($query) use ($fromDate, $toDate) { 
            $query->whereBetween('payment_month', [$fromDate, $toDate])->where('status', 'Pending');}, 'residents'])->get();
        

        return view("dashboard.defaulters.listing" , compact("from_date" , "to_date" , "flats" , "type"));

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
