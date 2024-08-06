<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\register\VendorRegistration;
use App\Http\Controllers\user\register\VendorRegistrationController;
use App\Http\Controllers\user\auth\RegisterController;
use App\Http\Controllers\user\auth\UserAuthController;
use App\Http\Controllers\user\UserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ****************************  Admin Dashboard Route *****************************************

Route::get("/", [AdminAuthController::class,"login"]);
Route::post('login', [AdminAuthController::class,'admin_login']);
Route::get('admin-logout',[AdminAuthController::class,'logout']);
// Route::get('admin-dashboard',[AdminController::class,'home']);


Route::get('registration-detail',[AdminController::class,'show_registration']);
Route::get('vendor-registration-detail',[AdminController::class,'vendor_registration_detail']);
Route::get('delete-vendor-registration-detail/{id}',[AdminController::class,'delete_vendor_registration_detail']);
Route::get('edit-vendor-registration-detail/{id}',[AdminController::class,'edit_vendor_registration_detail']);
Route::post('edit-vendor-registration-detail',[AdminController::class,'update_vendor_registration_detail']);
Route::get('view-sku-vendor-entity-detail/{id}',[AdminController::class,'view_sku_vendor_entity_detail']);
Route::get('delete-sku-vendor-entity-detail/{id}',[AdminController::class,'delete_sku_vendor_entity_detail']);


// *********** this route for change status of vendor eighter activate or deactivate ***************
Route::post('update-vendor-status',[AdminController::class,'update_vendor_status']);
Route::post('update-sku-registration-status',[AdminController::class,'update_sku_registration_status']);
Route::post('update-message-status',[AdminController::class,'update_message_status']);


// -----------------------------------------------------------------------------------------------


Route::get('request-report-detail',[AdminController::class,'show_request_report_detail']);
Route::get('admin-reply/{id}',[AdminController::class,'admin_message_reply']);
Route::post('admin-reply',[AdminController::class,'sent_admin_message']);
Route::get('delete-vendor-reply/{id}',[AdminController::class,'delete_vendor_reply']);





// ----------------------------------------------------------

Route::get('all-vendor-registration',[AdminController::class,'show_all_registration']);





// ****************************  User Dashboard Route *****************************************

Route::get('/user',[UserAuthController::class,'login']);
Route::post('user-login', [UserAuthController::class,'user_login']);
Route::get('logout',[UserAuthController::class,'logout']);

Route::get('register',[RegisterController::class,'register']);
Route::post('register',[RegisterController::class,'add_user']);

Route::get('user-dashboard',[UserController::class,'home']);
Route::get('sku-registration',[UserController::class,'sku_registration']);
Route::post('sku-registration',[UserController::class,'add_sku_registration']);
Route::get('request-report',[UserController::class,'request_report']);
Route::post('request-report',[UserController::class,'add_request_report']);

Route::get('message-list',[UserController::class,'message_list']);















// **********************************final code************************************

Route::get('vendor-registration',[VendorRegistrationController::class,'vendor_registration']);