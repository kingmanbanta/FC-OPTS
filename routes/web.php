<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin/', 'middleware' => ['role:Administrator']], function () {
    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admindashboard');

    Route::get('/manageAccount', [App\Http\Controllers\AdminController::class, 'account'])->name('account');
    Route::post('/manageAccount', [App\Http\Controllers\AdminController::class, 'addaccount'])->name('addaccount');
    Route::delete('/manageAccount/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteAccount']);
    Route::patch('/manageAccount/update/{id}', [App\Http\Controllers\AdminController::class, 'updateAccount']);
    Route::get('/manageAccount/view/{id}', [App\Http\Controllers\AdminController::class, 'getUserById'])->name('view');

    Route::get('/facility', [App\Http\Controllers\AdminController::class, 'facility'])->name('facility');
    Route::post('/departmentsave', [App\Http\Controllers\AdminController::class, 'adddepartment']);
    Route::post('/buildingsave', [App\Http\Controllers\AdminController::class, 'addbuilding']);
    Route::patch('/building/update/{id}', [App\Http\Controllers\AdminController::class, 'updatebuilding']);
    Route::patch('/department/update/{id}', [App\Http\Controllers\AdminController::class, 'updatedepartment']);
    Route::delete('/building/delete/{id}', [App\Http\Controllers\AdminController::class, 'deletebuilding']);
    Route::delete('/department/delete/{id}', [App\Http\Controllers\AdminController::class, 'deletedepartment']);

    Route::get('/supplier_items', [App\Http\Controllers\AdminController::class, 'supplier_items'])->name('supplier_items');
    Route::post('/suppliersave', [App\Http\Controllers\AdminController::class, 'addsupplier']);
    Route::post('/itemsave', [App\Http\Controllers\AdminController::class, 'additem']);
    Route::patch('/supplier/update/{id}', [App\Http\Controllers\AdminController::class, 'updatesupplier']);
    Route::patch('/item/update/{id}', [App\Http\Controllers\AdminController::class, 'updateitem']);
    Route::delete('/supplier/delete/{id}', [App\Http\Controllers\AdminController::class, 'deletesupplier']);
    Route::delete('/item/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteitem']);

    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\AdminController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\AdminController::class, 'updatepasword']);
    Route::post('/profile/admin-changeProfilePic', [App\Http\Controllers\AdminController::class, 'changeProfilePic'])->name('adminProfilePic');

    Route::get('/purchase_request', [App\Http\Controllers\AdminController::class, 'purchase_request'])->name('purchase_request');
    Route::post('/requisitionsave', [App\Http\Controllers\AdminController::class, 'addrequisition']);
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\AdminController::class, 'view_purchase_request']);
});
Route::group(['prefix' => 'requestor/', 'middleware' => ['role:Requestor']], function () {
    Route::get('dashboard', [App\Http\Controllers\RequestorController::class, 'index'])->name('requestordashboard');
    
    Route::get('/profile', [App\Http\Controllers\RequestorController::class, 'profile'])->name('req_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\RequestorController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\RequestorController::class, 'updatepasword']);
    Route::post('/profile/requestor-changeProfilePic', [App\Http\Controllers\RequestorController::class, 'changeProfilePic'])->name('requestorProfilePic');

    Route::get('/purchase_request', [App\Http\Controllers\RequestorController::class, 'purchase_request'])->name('req_purchase_request');
    Route::post('/requisitionsave', [App\Http\Controllers\RequestorController::class, 'addrequisition']);
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\RequestorController::class, 'view_purchase_request']);
});
Route::group(['prefix' => 'approver/', 'middleware' => ['role:Approver']], function () {
    Route::get('dashboard', [App\Http\Controllers\ApproverController::class, 'index'])->name('approverdashboard');

    Route::get('/profile', [App\Http\Controllers\ApproverController::class, 'profile'])->name('app_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ApproverController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ApproverController::class, 'updatepasword']);
    Route::post('/profile/approver-changeProfilePic', [App\Http\Controllers\ApproverController::class, 'changeProfilePic'])->name('approverProfilePic');
});
Route::group(['prefix' => 'validator/', 'middleware' => ['role:Validator']], function () {
    Route::get('dashboard', [App\Http\Controllers\ValidatorController::class, 'index'])->name('validatordashboard');

    Route::get('/profile', [App\Http\Controllers\ValidatorController::class, 'profile'])->name('val_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ValidatorController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ValidatorController::class, 'updatepasword']);
    Route::post('/profile/validator-changeProfilePic', [App\Http\Controllers\ValidatorController::class, 'changeProfilePic'])->name('validatorProfilePic');
});
Route::group(['prefix' => 'processor/', 'middleware' => ['role:Processor']], function () {
    Route::get('dashboard', [App\Http\Controllers\ProcessorController::class, 'index'])->name('processordashboard');

    Route::get('/profile', [App\Http\Controllers\ProcessorController::class, 'profile'])->name('pro_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ProcessorController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ProcessorController::class, 'updatepasword']);
    Route::post('/profile/processor-changeProfilePic', [App\Http\Controllers\ProcessorController::class, 'changeProfilePic'])->name('processorProfilePic');
});
