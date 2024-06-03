<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceiptEmail;
use App\Models\Payment;
use Illuminate\Http\Request;

class MailController extends Controller
{
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

        // dd($request->pid);
        $payment = Payment::with('flat.residents')->where('payment_id',$request->pid)->first();
        $data['month'] = date('M Y', strtotime($payment->payment_month)); 
        $data['date'] = date('d M Y', strtotime($payment->payment_month)); 
        $data['flat'] = $payment->flat->flat_number; 
        $data['phase'] = $payment->flat->phase_number; 
        $data['resident'] = $payment->flat->residents[0]->full_name; 
        $data['contact'] = $payment->flat->residents[0]->mobile; 
        $data['payment_id'] = $payment->payment_id; 
        $data['receipt_id'] = $payment->receipt_id; 
        $data['receipt_items'][$payment->type] = $payment->amount; 

        $total = 0;
        foreach ($data['receipt_items'] as $key => $value) {
            $total +=$value;
        }

        $payment_id = $payment->payment_id;

        $recipient = $payment->flat->residents[0]->email; 

        Mail::to($recipient)->send(new SendReceiptEmail($data , $total , $payment_id));
        return redirect()->back()->with("success" , "Receipt has been sent successfully");

    }
}
