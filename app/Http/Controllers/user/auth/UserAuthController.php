<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //
    public function login(){
        return view("user.auth.login");
    }

    public function user_login(Request $request){
        $validate = $this->validate($request,[
            "email"=> "required",
            "password"=> "required",
        ]);

        $user = User::where("email", $request->email)->first();

        $email = $request->email;
        $password = $request->password;

        if($user){
            if(Hash::check($password, $user->password)){
                if($user->role == 0 && $user->status == 'Activate')
                {
                    $request->session()->put("loginId", $user->role);
                    $request->session()->put("vendor_id", $user->id);
                    $request->session()->put("vendor_name", $user->vendor_name);
                    return redirect("sku-registration")->with("success","Login Successfully😊!");
                }else if($user->role == 0 && $user->status == 'Deactivate'){
                    return redirect("/user")->with("fail","Login failed because Your Account are Deactiavte so,Please You Contact your Admin!!");
                }
                else{
                    return redirect("/user")->with("fail","Login failed because Invalid Credintial!");
                }
            }
            else{
                return redirect("/user")->with("fail","Login failed because password is Incorrect");
            }
        }
        else{
            return redirect("/user")->with("fail","Login failed because emailId is Incorrect");
        }
    }

    public function logout(Request $request){
        if(session()->has("loginId")){
            session()->flush();
            return redirect("/user")->with("success","Logout Successfully!");
        }
        else{
            return redirect("/user");
        }
    }
}
