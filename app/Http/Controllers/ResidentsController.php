<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Resident;
use App\Models\Residents;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request["email"] ?? "";
        if(!empty($search)){
            $residents = Resident::where("email" , "LIKE" , "%$search%")->get();
        }else{
            $residents = Resident::with('flat')->get();
        }
        return view("dashboard.residents.listing", compact("residents" , "search"));
    }

    public function createPage()
    {
        $flats = Flat::all();
        return view("dashboard.residents.add" , compact("flats"));
    }

    public function editPage($id){
        if($id){
            $flats = Flat::all();
            $resident = Resident::find($id);
            return view("dashboard.residents.edit" , compact("flats" , "resident"));
        }
    }

    public function singlePage($id){
        if($id){
            $resident = Resident::with("flat")->find($id);
            $resident->in_date = Carbon::parse($resident->in_date);
            $resident->out_date = Carbon::parse($resident->out_date);
            return view("dashboard.residents.single" , compact("resident"));
        }
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

        $request->validate([
            "flat_id" => "required",
            "type" => "required",
            "status" => "required",
            "full_name" => "required",
            "email" => "required|email|unique:residents",
            "mobile" => "required",
            "intercom" => "required",
            "cnic" => "required",
            "in_date" => "required",
            "out_date" => "required",
        ]);

        $resident = new Resident();

        $resident->flat_id = $request->flat_id;
        $resident->type = $request->type;
        $resident->status = $request->status;
        $resident->full_name = $request->full_name;
        $resident->email = $request->email;
        $resident->mobile = $request->mobile;
        $resident->intercom = $request->intercom;
        $resident->cnic = $request->cnic;
        $resident->in_date = $request->in_date;
        $resident->out_date = $request->out_date;

        $resident->save();

        if($resident){
            return redirect("/dashboard/residents")->with("success" , "Resident Created SuccessFully!");
        }else{
            return redirect("/dashboard/residents")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/residents/add");
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
    public function update(Request $request)
    {
        $resident = Resident::find($request->id);

        if(!$resident){
            return redirect("/dashboard/residents")->with("fail" , "Resident Not Found!");
        }

        $request->validate([
            "flat_id" => "required",
            "type" => "required",
            "status" => "required",
            "full_name" => "required",
            "mobile" => "required",
            "intercom" => "required",
            "cnic" => "required",
            "in_date" => "required",
            "out_date" => "required",
        ]);

        if(isset($request->email) && !empty($request->email)){
            $resident->email = $request->email;
        }

        $resident->flat_id = $request->flat_id;
        $resident->type = $request->type;
        $resident->status = $request->status;
        $resident->full_name = $request->full_name;
        $resident->email = $request->email;
        $resident->mobile = $request->mobile;
        $resident->intercom = $request->intercom;
        $resident->cnic = $request->cnic;
        $resident->in_date = $request->in_date;
        $resident->out_date = $request->out_date;

        $resident->save();

        if($resident){
            return redirect("/dashboard/residents")->with("success" , "Resident Updated SuccessFully!");
        }else{
            return redirect("/dashboard/residents")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/residents/edit/" , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $resident = Resident::find($request->id);

        if ($resident) {
            $resident->delete();
            return redirect("/dashboard/residents")->with("success", "Resident Deleted SuccessFully!");
        }
    }
}
