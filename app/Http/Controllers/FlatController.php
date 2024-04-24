<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = $request["flat_number"] ?? "";
        if(!empty($search)){
            $flats = Flat::where("flat_number" , "LIKE" , "%$search%")->get();
        }else{
            $flats = Flat::all();
        }
        return view("dashboard.flats.listing", compact("flats" , "search"));

    }

    public function createPage(){
        return view("dashboard.flast.add" , compact("roles"));
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
