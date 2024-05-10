<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Flat;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flats = Flat::count();
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        // current month payments
        $payments_data = Payment::with('flat')->whereMonth('payment_month', $currentMonth)
        ->whereYear('payment_month', $currentYear)
        ->get();
        $payments = Payment::with('flat')->whereMonth('payment_month', $currentMonth)
        ->whereYear('payment_month', $currentYear)
        ->sum('amount');


        // current month Expenses
        $expenses_data = Expense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->get();
        $expenses = Expense::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('amount');

        return view('dashboard.dashboard', compact("flats", "payments", "expenses", "payments_data", "expenses_data"));
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
