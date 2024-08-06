<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(){
        return view("admin.auth.login");
    }

    public function admin_login(Request $request){
        $validate = $this->validate($request,[
            "email"=> "required",
            "password"=> "required",
        ]);

        $admin = User::where("email", $request->email)->first();

        $email = $request->email;
        $password = $request->password;

        if($admin){
            if(Hash::check($password, $admin->password)){
                if($admin->role == 1)
                {
                    $request->session()->put("loginId", $admin->role);
                    return redirect("all-vendor-registration")->with("success","Login Successfully😊!");
                }
                else{
                    
                    return redirect("/")->with("fail","Login failed because Invalid Credintial!");
                }
            }
            else{
                
                return redirect("/")->with("fail","Login failed because password is incorrect");
            }
        }
        else{
            return redirect("/")->with("fail","Login Failed because email is incorrect");
        }
    }

    public function logout(Request $request){
        if(session()->has("loginId")){
            session()->flush();
            return redirect("/")->with("success","Logout Successfully!");
        }
        else{
            return redirect("/");
        }
    }
}
