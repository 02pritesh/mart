<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\RequestReport;
use App\Models\SkuRegistration;
use App\Models\SkuVendorEntityNameDetail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validate;

class UserController extends Controller
{
    //
    // public function home(){
    //     if(session()->has('loginId'))
    //     {
    //         return view('user.sku-registration');
    //     }
    //     else{
            
    //     }
    // }

    public function sku_registration(){
        if(session()->has('loginId')){
            return view('user.sku_registration');
        }else{
            return redirect('/user');
        }
        
    }

    public function add_sku_registration(Request $request) {
        $this->validate($request, [
            "vendor_name" => "required",
            "sku_name.*" => "required|string",
            "sku_code.*" => [
                "required",
                "string",
                "min:8",
                "max:12",
                "regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}$/"
            ],
            "category.*" => "required|string",
            "quantity.*" => "required|integer",
            "price.*" => "required|string",
        ], [
            'vendor_name.required' => 'The vendor entity name is required.',
            'sku_name.*.required' => 'The SKU name is required.',
            'sku_name.*.string' => 'The SKU name must be a string.',
            'sku_code.*.required' => 'The SKU code is required.',
            'sku_code.*.string' => 'The SKU code must be a string.',
            'sku_code.*.min' => 'The SKU code must be exactly 8 characters.',
            'sku_code.*.max' => 'The SKU code must be exactly 12 characters.',
            'sku_code.*.regex' => 'The SKU code must be exactly 8 characters long and contain both letters and numbers.',
            'category.*.required' => 'The category is required.',
            'category.*.string' => 'The category must be a string.',
            'quantity.*.required' => 'The quantity is required.',
            'quantity.*.integer' => 'The quantity must be an integer.',
            'price.*.required' => 'The price is required.',
            'price.*.string' => 'The price must be a string.',
        ]);
    
        $data = new SkuRegistration();
        $data->vendor_name = $request->vendor_name;
        $data->description = 'Sku Registration';
        $data->save();
        $registrationID = $data->id;
    
        foreach ($request->sku_name as $key => $value) {
            $data = new SkuVendorEntityNameDetail();
            $data->sku_registration_id = $registrationID;
            $data->sku_name = $request->sku_name[$key];
            $data->sku_code = $request->sku_code[$key];
            $data->category = $request->category[$key];
            $data->quantity = $request->quantity[$key];
            $data->price = $request->price[$key];
            $data->save();
        }
    
        return redirect("sku-registration")->with("success", "Sku Details Submit successfully!");
    }
    
    public function request_report(){
        // Retrieve the vendor_id from the session
        $vendorID = session()->get('vendor_id');
        
        // Fetch the messages corresponding to the vendor_id
        $messages = RequestReport::where('vendor_id', $vendorID)->get();
        
        // Return the view with the fetched messages
        return view('user.request_report', compact('messages'));
    }
    
    

    public function add_request_report(Request $request){
        $this->validate($request, [
            'vendor_message' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 300) {
                    $fail('The ' . $attribute . ' may not be greater than 300 words.');
                }
            }],

            'vendor_file' => 'required|mimes:pdf,docx,jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $data = new RequestReport();

        $data->vendor_id = $request->vendor_id;
        $data->vendor_name = $request->vendor_name;
        $data->vendor_message = $request->vendor_message;
        $data->description = 'Request Report';
        $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
        $request->file('vendor_file')->move('assets/upload/',$data->vendor_file);

        $result = $data->save();
        if ($result) {
            return redirect('request-report')->with('success','Message Sent Successfully!!');
        }else{
            return redirect('request-report')->with('error','Message doest not sent');
        }
    }

    public function message_list(){
         // Retrieve the vendor_id from the session
         $vendorID = session()->get('vendor_id');
        
         // Fetch the messages corresponding to the vendor_id
         $messages = RequestReport::where('vendor_id', $vendorID)->get();
        return view('user.message_list',compact('messages'));
    }
}
