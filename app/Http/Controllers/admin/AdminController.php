<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RequestReport;
use App\Models\SkuRegistration;
use App\Models\SkuVendorEntityNameDetail;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function home(){
        if(session()->has('loginId'))
        {
            return view('admin.home');
        }
        else{
            return redirect('/');
        }
    }




    public function show_registration(){
        $registration = SkuRegistration::all();
       
        return view('admin.show_registration_detail',compact('registration'));
    }



    public function view_sku_vendor_entity_detail($id){
        $skuProducts = SkuVendorEntityNameDetail::where('sku_registration_id',$id)->get();
        return view('admin.show_sku_registration_product',compact('skuProducts'));
    }




    public function vendor_registration_detail(){
        $vendorDetail = User::where('role',0)->get();
        return view('admin.vendor_registration_detail',compact('vendorDetail'));
    }




    public function delete_vendor_registration_detail($id){

        $vendorDetail = User::find($id);
        $vendorDetail->delete();
        return redirect('vendor-registration-detail',)->with('success','Vendor Registration details delete Successfully!!');
    }




    public function edit_vendor_registration_detail($id){
        $vendorDetail = User::find($id);
        return view('admin.edit_vendor_registration_detail',compact('vendorDetail'));
    }




    public function update_vendor_registration_detail(Request $request){

        $vendorDetail = User::find($request->id);
        $vendorDetail->vendor_name = $request->vendor_name;
        $vendorDetail->email = $request->email;
        $vendorDetail->gstin = $request->gstin;
        $vendorDetail->contact_person = $request->contact_person;
        $vendorDetail->phone_number = $request->phone_number;
        $vendorDetail->brands = $request->brands;

        $result = $vendorDetail->save();
        if( $result ){
            return redirect('vendor-registration-detail')->with('success','Vendor registration details Updated Successfully!');
        }
        else{
            return redirect('vendor-registration-detail')->with('error','Vendor registration details Updataion Failed!');
        }
    }




    public function delete_sku_vendor_entity_detail($id){
        $data = SkuVendorEntityNameDetail::find($id);
        if($data->delete()){
            return redirect('registration-detail')->with('success','Delete Sku Vendor Entity Detail');
        }
        
    }




    public function show_request_report_detail(){
        $messages = RequestReport::all();
        return view('admin.show_request_report_detail',compact('messages'));
    }




    public function admin_message_reply($id){
        $messages = RequestReport::find( $id );
        return view('admin.admin_message_reply',compact('messages'));
    }




    public function delete_vendor_reply($id){
        $result = RequestReport::find( $id );
        $result->delete();
        return redirect('request-report-detail')->with('success','Delete Vendor reply messages');
    }



    public function sent_admin_message(Request $request){
        $this->validate($request, [
            'admin_message' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 300) {
                    $fail('The ' . $attribute . ' may not be greater than 300 words.');
                }
            }],
          'admin_file' => 'required|mimes:pdf,docx,jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $data = RequestReport::where('id',$request->id)->first();
        $data->admin_message = $request->admin_message;

        $data->admin_file = $request->file('admin_file')->getClientOriginalName();
        $request->file('admin_file')->move('assets/upload/',$data->file);

        $result = $data->save();
        if($result){
            return redirect('request-report-detail')->with('success','Message Sent Successfully!');
        }else{
            return redirect('request-report-detail')->with('error','Message does not sent');
        }
    }






    public function show_all_registration(){
        $user = User::all();
        $skuRegistrations = SkuRegistration::all();
        $requestReport = RequestReport::all();
    
        $mergeData = $user->merge($requestReport)->merge($skuRegistrations);
        
        $sortedMerge = $mergeData->sortBy('created_at');
    
        return view('admin.show_all_registration', compact('sortedMerge'));
    }
    








    public function update_vendor_status(Request $request){
        $status = $request->vendor_status;

        if( $status == 'Activate'){
            $data = User::where('id',$request->id)->first();
            $data->status = 'Activate';

            $data->save();  
            return redirect('vendor-registration-detail')->with('success','Status Update Successfully');
        }else{
            $data = User::where('id',$request->id)->first();
            $data->status = 'Deactivate';

            $data->save();  
            return redirect('vendor-registration-detail')->with('success','Status Update Successfully');
        }
    }

    public function update_sku_registration_status(Request $request){
        $status = $request->sku_status;

        if( $status == 'Approved'){
            $data = SkuRegistration::where('id',$request->id)->first();
            $data->status = 'Approved';

            $data->save();  
            return redirect('registration-detail')->with('success','Status Update Successfully');
        }else{
            $data = SkuRegistration::where('id',$request->id)->first();
            $data->status = 'Pending';

            $data->save();  
            return redirect('registration-detail')->with('success','Status Update Successfully');
        }
    }

    public function update_message_status(Request $request){
        $status = $request->status;

        if( $status == 'Approved'){
            $data = RequestReport::where('id',$request->id)->first();
            $data->status = 'Approved';

            $data->save();  
            return redirect('request-report-detail')->with('success','Status Update Successfully');
        }else{
            $data = RequestReport::where('id',$request->id)->first();
            $data->status = 'Pending';

            $data->save();  
            return redirect('request-report-detail')->with('success','Status Update Successfully');
        }
    }
}
