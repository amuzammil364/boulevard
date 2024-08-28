<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceiptEmail;
use App\Mail\SendReminderEmail;
use App\Models\Payment;
use App\Models\Resident;
use App\Models\Option;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(Request $request)
    {

        $data = array(
            'month' => 'May 24',
            'date' => '30 May 2024',
            'flat' => 'A1',
            'phase' => '2',
            'resident' => 'Muzammil',
            'contact' => '03032157357',
            'payment_id' => 'eqqettdeqsf',
            'receipt_id' => '005',
            'receipt_items' => array()
        );

        if (!isset($request->pid) || (isset($request->pid) && $request->pid == "")) {
            return redirect("/dashboard");
        }

        // dd($request->pid);
        $payment = Payment::with('flat.residents')->where('payment_id', $request->pid)->first();
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
            $total += $value;
        }

        $payment_id = $payment->payment_id;

        // if (!isset($payment->flat->residents[0])) {
        //     return redirect()->back()->with("error", "Resident information is missing.");
        // }

        $recipient = $payment->flat->residents[0]->email;

        // if (empty($recipient)) {
        //     return redirect()->back()->with("error", "Recipient email address is missing.");
        // }

        Mail::to("abdulsaqib2111d@aptechsite.net")->send(new SendReceiptEmail($data, $total, $payment_id));
        return redirect()->back()->with("success", "Receipt has been sent successfully");
    }

    public function reminder_mail(Request $request)
    {

        $current_month = date("m");
        $current_year = date("Y");
        $receipt_reminder_email = Option::where("key", "receipt_reminder_email")->first();
        $payments = Payment::with('flat.residents')->whereMonth("payment_month", $current_month)->whereYear('payment_month', $current_year);

        foreach ($payments as $index => $payment) {
            $data = $payment->flat->residents[$index];
            Mail::to($data->email)->send(new SendReminderEmail($data));
        }

        return redirect()->back()->with("success", "Reminder has been sent successfully");
    }
}
