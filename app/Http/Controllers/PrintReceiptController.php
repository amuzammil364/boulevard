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
            'receipt_id'=>'005',
            'receipt_items'=>array(
            )
        );


        if(!isset($request->pid) || (isset($request->pid) && $request->pid == "")){
            return redirect("/dashboard");
        }


        // $payment = Payment::with('flat.residents')->find($request->id);
        $payment = Payment::with('flat.residents')->where('payment_id',$request->pid)->first();
        $data['month'] = date('M Y', strtotime($payment->payment_month)); 
        $data['date'] = date('d M Y', strtotime($payment->paid_date)); 
        $data['flat'] = $payment->flat->flat_number; 
        $data['phase'] = $payment->flat->phase_number; 
        $data['resident'] = $payment->flat->residents[0]->full_name; 
        $data['contact'] = $payment->flat->residents[0]->mobile; 
        $data['payment_id'] = $payment->payment_id; 
        $data['receipt_id'] = $payment->receipt_id; 
        $data['receipt_items'][$payment->type] = $payment->amount; 

        $total = 0;
        foreach ($data['receipt_items'] as $key => $value) {
            $total+=$value;
        }
        $payment_id = $payment->payment_id;

        return view("print_receipt.printReceipt", compact('data','total','payment_id'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index2(Request $request)
    {
        
        $data = array(
            'month'=>'May 24',
            'date'=>'30 May 2024',
            'flat'=>'A1',
            'phase'=>'2',
            'resident'=>'Muzammil',
            'contact'=>'03032157357',
            'payment_id'=>'eqqettdeqsf',
            'receipt_id'=>'005',
            'receipt_items'=>array(
            )
        );


        if(!isset($request->pid) || (isset($request->pid) && $request->pid == "")){
            return redirect("/dashboard");
        }


        // $payment = Payment::with('flat.residents')->find($request->id);
        $payment = Payment::with('flat.residents')->where('payment_id',$request->pid)->first();
        $data['month'] = date('M Y', strtotime($payment->payment_month)); 
        $data['date'] = date('d M Y', strtotime($payment->paid_date)); 
        $data['flat'] = $payment->flat->flat_number; 
        $data['phase'] = $payment->flat->phase_number; 
        $data['resident'] = $payment->flat->residents[0]->full_name; 
        $data['contact'] = $payment->flat->residents[0]->mobile; 
        $data['payment_id'] = $payment->payment_id; 
        $data['receipt_id'] = $payment->receipt_id; 
        $data['receipt_items'][$payment->type] = $payment->amount; 

        $total = 0;
        foreach ($data['receipt_items'] as $key => $value) {
            $total+=$value;
        }

        $payment_id = $payment->payment_id;

        return view("print_receipt.printReceiptPublic", compact('data','total','payment_id'));
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
