<?php

namespace App\Http\Controllers\user\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorRegistrationController extends Controller
{
    public function vendor_registration(){
        return view("admin.register.vendor_registration");
    }
}
