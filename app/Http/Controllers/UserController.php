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
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view("dashboard.users.users", compact("roles", "users"));
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
        try {

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

            return redirect("/dashboard/users")->with("success", "User Created SuccessFully!");
        } catch (Throwable $e) {
            return redirect("/dashboard/users")->with("fail", $e->getMessage());
        }
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
    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->delete();
            return redirect("/dashboard/users")->with("success", "User Deleted SuccessFully!");
        }
    }
}
