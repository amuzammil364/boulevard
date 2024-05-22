<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request["flat_number"] ?? "";
        $flats_count = Flat::count();
        if(!empty($search)){
            $flats = Flat::where("flat_number" , "LIKE" , "%$search%")->get();
        }else{
            $flats = Flat::all();
        }
        return view("dashboard.flats.listing", compact("flats" , "search" , "flats_count"));

    }

    public function createPage(){
        return view("dashboard.flats.add");
    }

    public function editPage($id){
        if($id){
            $flat = Flat::find($id);
            return view("dashboard.flats.edit" , compact("flat"));
        }
    }

    public function singlePage($id){
        if($id){
            $flat = Flat::with("residents")->find($id);
            return view("dashboard.flats.single" , compact("flat"));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "flat_number" => "required",
            "phase_number" => "required",
        ]);

        $flat = new Flat();

        $flat->flat_number = $request->flat_number;
        $flat->phase_number = $request->phase_number;
        $flat->occupancy = $request->occupancy;

        $flat->save();

        if($flat){
            return redirect("/dashboard/flats")->with("success" , "Flat Created SuccessFully!");
        }else{
            return redirect("/dashboard/flats")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/flats/add");
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
    public function update(Request $request)
    {
        $flat = Flat::find($request->id);

        if(!$flat){
            return redirect("/dashboard/flat")->with("fail" , "Flat Not Found!");
        }

        $request->validate([
            "flat_number" => "required",
            "phase_number" => "required",
        ]);

        $flat->flat_number = $request->flat_number;
        $flat->phase_number = $request->phase_number;
        $flat->occupancy = $request->occupancy;

        $flat->save();

        if($flat){
            return redirect("/dashboard/flats")->with("success" , "Flat Updated SuccessFully!");
        }else{
            return redirect("/dashboard/flats")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/flats/edit/" , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $flat = Flat::find($request->id);

        if ($flat) {
            $flat->delete();
            return redirect("/dashboard/flats")->with("success", "Flat Deleted SuccessFully!");
        }
    }
}
