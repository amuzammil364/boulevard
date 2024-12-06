<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\ExpenseType;
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
        if (isset($request->opening_balance) && $request->opening_balance != "") {
            $opening_balance = $request->opening_balance;
        }

        if (isset($request->summary_month) && $request->summary_month != "") {
            $currentMonth = date("m", strtotime($request->summary_month));
            $currentYear = date("Y", strtotime($request->summary_month));
            $date = $request->summary_month;
        }

        $expenses_types_total_amount = 0;
        $expenses_types = ExpenseType::all();

        $paid_collection_types_total_amount = 0;
        $pending_collection_types_total_amount = 0;
        $collection_types = [
            ["type" => "Maintenance", "amount_paid" => 0, "amount_pending" => 0],
            ["type" => "Welfare", "amount_paid" => 0, "amount_pending" => 0],
            ["type" => "Misc", "amount_paid" => 0, "amount_pending" => 0],
            ["type" => "Eid-ul-Adha Provision", "amount_paid" => 0, "amount_pending" => 0],
            ["type" => "Paint Renovation", "amount_paid" => 0, "amount_pending" => 0],
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


        foreach ($expenses_types as $expenses_type) {
            $amount = Expense::whereMonth('paid_date', $currentMonth)->whereYear("paid_date", $currentYear)->where('type', $expenses_type->name)->where('amount', '!=', 0)->where('status', 'Paid')->sum('amount');
            $expenses_type->amount = $amount;
            $expenses_types_total_amount += $amount;
        }

        $expenses_types_array = $expenses_types->toArray();

        usort($expenses_types_array, function ($a, $b) {
            return $b['amount'] <=> $a['amount'];
        });

        $sorted_expenses_types = collect($expenses_types_array);


        foreach ($collection_types as $index => $collection_type) {
            $amount_paid = Payment::whereMonth('payment_month', $currentMonth)->whereYear("payment_month", $currentYear)->whereMonth('paid_date', $currentMonth)->whereYear("paid_date", $currentYear)->where('type', $collection_type['type'])->where('amount', '!=', 0)->where('status', 'Paid')->sum('amount');
            $collection_types[$index]['amount_paid'] = $amount_paid;
            $paid_collection_types_total_amount += $amount_paid;
            $amount_pending = Payment::whereMonth('payment_month', $currentMonth)->whereYear("payment_month", $currentYear)->where('type', $collection_type['type'])->where('amount', '!=', 0)->where('status', 'Pending')->sum('amount');
            $collection_types[$index]['amount_pending'] = $amount_pending;
            $pending_collection_types_total_amount += $amount_pending;
        }

        foreach ($collection_types_arrears as $index => $collection_type) {
            $payments = Payment::where(function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('payment_month', '<', $currentMonth)
                    ->whereYear('payment_month', $currentYear)
                    ->orWhereYear('payment_month', '<', $currentYear);
            })->where('type', $collection_type['type'])
                ->where('amount', '!=', 0);
            $amount = $payments->whereMonth('paid_date', $currentMonth)->whereYear('paid_date', $currentYear)->where('status', 'Paid')->sum('amount');
            $collection_types_arrears[$index]['amount'] = $amount;
            $collection_types_total_amount_arrears += $amount;
        }

        foreach ($collection_types_advance as $index => $collection_type) {
            // $payments = Payment::whereMonth('payment_month' ,'>', $currentMonth)->where('type' , $collection_type['type'])->where('amount' , '!=' , 0);
            $payments = Payment::where(function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('payment_month', '>', $currentMonth)
                    ->whereYear('payment_month', $currentYear)
                    ->orWhereYear('payment_month', '>', $currentYear);
            })->where('type', $collection_type['type'])
                ->where('amount', '!=', 0);

            $amount = $payments->whereMonth('paid_date', $currentMonth)->whereYear('paid_date', $currentYear)->where('status', 'Paid')->sum('amount');
            $collection_types_advance[$index]['amount'] = $amount;
            $collection_types_total_amount_advance += $amount;
        }

        return view("dashboard.summary.listing", compact("collection_types_advance", "collection_types_total_amount_advance", "collection_types_arrears", "collection_types_total_amount_arrears", "sorted_expenses_types", "expenses_types_total_amount", "collection_types", "paid_collection_types_total_amount", "pending_collection_types_total_amount", "date", "opening_balance"));
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
