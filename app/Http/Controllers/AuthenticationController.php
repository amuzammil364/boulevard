<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function index(){
        return view("authentication.login.login");
    }

    public function login(Request $request){

        $request->validate([
            "email" => "required|email",
            "password" => "required|min:4"
        ]);

        $user = User::where("email" , $request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            $request->session()->put("user_id", $user->id);
            return redirect("/dashboard");
        }else{
            return redirect("/")->with("fail" , "User Not Found!");
        }

        return redirect("/");
    }

    public function logout(){
        Session::pull("user_id");
        return redirect("/");
    }
}
