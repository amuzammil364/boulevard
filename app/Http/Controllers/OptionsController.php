<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $maintenance_amount = Option::where('key','maintenance_amount')->first();
        if($maintenance_amount){
            $maintenance_amount = $maintenance_amount->value;
        }else{
            $maintenance_amount = "";
        }
        $currency = Option::where('key','currency')->first();
        if($currency){
            $currency = $currency->value;
        }else{
            $currency = "";
        }

        $collection_due_day = Option::where('key','collection_due_day')->first();
        if($collection_due_day){
            $collection_due_day = $collection_due_day->value;
        }else{
            $collection_due_day = "";
        }

        $receipt_reminder_email = Option::where('key','receipt_reminder_email')->first();
        if($receipt_reminder_email){
            $receipt_reminder_email = $receipt_reminder_email->value;
        }else{
            $receipt_reminder_email = "";
        }

        $receipt_email = Option::where('key','receipt_email')->first();
        if($receipt_email){
            $receipt_email = $receipt_email->value;
        }else{
            $receipt_email = "";
        }

        return view("dashboard.settings.settings", compact("collection_due_day" ,"maintenance_amount","currency" , "receipt_email" , "receipt_reminder_email"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        foreach ($data as $key => $value) {
            $option = Option::firstOrNew(['key' => $key]);
            $option->value = $value;
            $option->save();
        }


        return redirect("/dashboard/settings")->with("success" , "Settings Updated Successfully!");

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
