<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(){
        return view("user.auth.register");
    }

    public function add_user(Request $request){
        $validate = $this->validate($request,[
            "vendor_name" => "required",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:6",
            "gstin" => [
                "required",
                "string",
                "min:15",
                "max:15",
                "regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{15}$/"
            ],
            "contact_person"=> "required",
            "phone_number"=> "required|min:10",
            "brands"=> "required|numeric",
        ],[
            'gstin.*.required' => 'The GSTIN code is required.',
            'gstin.*.string' => 'The GSTIN code must be a string.',
            'gstin.*.min' => 'The GSTIN code must be exactly 15 characters.',
            'gstin.*.max' => 'The GSTIN code must be exactly 15 characters.',
            'gstin.*.regex' => 'The GSTIN code must be exactly 15 characters long and contain both letters and numbers.',
        ]);

        if(!$validate){
            return redirect('register')->withErrors($validate)->withInput();
        }
        else{
            $user = new User();
            $user->vendor_name = $request->vendor_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gstin = $request->gstin;
            $user->contact_person = $request->contact_person;
            $user->phone_number = $request->phone_number;
            $user->brands = $request->brands;
            $user->description = 'Vendor Registration';

            $result = $user->save();
            
            if($result){
                return redirect('/user')->with('success','Registration Successfully!!');
            }
            else{
                return redirect()->back()->with('error','Registration Failed!!');
            }
        }
    }
}
