<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Flat;
use App\Models\Payment;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $flats = Flat::count();
        $resident_actives = Resident::whereIn('status',['Active','Active (Arrears)'])->count();
        $resident_vacants = Resident::whereIn('status' , ['Vacant (Paid)' , 'Vacant (Arrears)'])->count();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $date = date('Y-m');

        if( isset($request->dashboard_month) && $request->dashboard_month != ""){
            $currentMonth = date('m', strtotime($request->dashboard_month));
            $currentYear = date('Y', strtotime($request->dashboard_month));
            $date = $request->dashboard_month;
        }
        
        // current month payments
        $payments_data = Payment::with('flat')->whereMonth('payment_month', $currentMonth)
        ->whereYear('payment_month', $currentYear)
        ->get()->take(10);
        $payments_paid = Payment::with('flat')->where('status','Paid')->whereMonth('payment_month', $currentMonth)
        ->whereYear('payment_month', $currentYear)
        ->sum('amount');
        $payments_pending = Payment::with('flat')->where('status','Pending')->whereMonth('payment_month', $currentMonth)
        ->whereYear('payment_month', $currentYear)
        ->sum('amount');


        // current month Expenses
        $expenses_data = Expense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->get()->take(10);
        $expenses_paid = Expense::where('status','Paid')->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('amount');
        $expenses_pending = Expense::where('status','Pending')->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('amount');

        return view('dashboard.dashboard', compact("date", "resident_actives", "resident_vacants", "payments_paid", "payments_pending", "expenses_paid", "expenses_pending", "payments_data", "expenses_data"));
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
