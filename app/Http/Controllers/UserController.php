<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request["email"] ?? "";
        if(!empty($search)){
            $users = User::where("email" , "LIKE" , "%$search%")->get();
        }else{
            $users = User::all();
        }
        return view("dashboard.users.listing", compact("users" , "search"));
    }

    public function createPage(){
        $roles = Role::all();
        return view("dashboard.users.add" , compact("roles"));
    }

    public function editPage($id){
        if($id){
            $roles = Role::all();
            $user = User::find($id);
            return view("dashboard.users.edit" , compact("roles" , "user"));
        }
    }

    public function singlePage($id){
        if($id){
            $user = User::with("role")->find($id);
            return view("dashboard.users.single" , compact("user"));
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
            "role_id" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:4",
            "phone" => "required"
        ]);

        $user = new User();

        $user->role_id = $request->role_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;

        $user->save();

        if($user){
            return redirect("/dashboard/users")->with("success" , "User Created SuccessFully!");
        }else{
            return redirect("/dashboard/users")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/users/add");

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
        $user = User::find($request->id);

        if(!$user){
            return redirect("/dashboard/users")->with("fail" , "User Not Found!");
        }

        $request->validate([
            "role_id" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required"
        ]);

        if(isset($request->email) && !empty($request->email)){
            $user->email = $request->email;
        }

        if(isset($request->password) && !empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->role_id = $request->role_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;

        $user->save();

        if($user){
            return redirect("/dashboard/users")->with("success" , "User Updated SuccessFully!");
        }else{
            return redirect("/dashboard/users")->with("fail" , "Something Went Wrong!");
        }

        return redirect("/dashboard/users/edit/" , $request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->delete();
            return redirect("/dashboard/users")->with("success", "User Deleted SuccessFully!");
        }
    }
}
