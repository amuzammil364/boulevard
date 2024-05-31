<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PrintReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data = array(
            'month'=>'May 24',
            'date'=>'30 May 2024',
            'flat'=>'A1',
            'phase'=>'2',
            'resident'=>'Muzammil',
            'contact'=>'03032157357',
            'payment_id'=>'eqqettdeqsf',
            'receipt_items'=>array(
            )
        );


        if($request->type=="payment"){
            $payment = Payment::with('flat.residents')->find($request->id);
            $data['month'] = date('M Y', strtotime($payment->payment_month)); 
            $data['date'] = date('d M Y', strtotime($payment->payment_month)); 
            $data['flat'] = $payment->flat->flat_number; 
            $data['phase'] = $payment->flat->phase_number; 
            $data['resident'] = $payment->flat->residents[0]->full_name; 
            $data['contact'] = $payment->flat->residents[0]->mobile; 
            $data['payment_id'] = $payment->payment_id; 
            $data['receipt_items'][$payment->type] = $payment->amount; 
        }

        // dd($data);
        $total = 0;
        foreach ($data['receipt_items'] as $key => $value) {
            $total+=$value;
        }


        return view("print_receipt.printReceipt", compact('data','total'));
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
