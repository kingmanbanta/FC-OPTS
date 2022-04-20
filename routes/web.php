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
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\AdminController::class, 'view_purchase_request'])->name('vpr');
});
// requestor
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
// approver
Route::group(['prefix' => 'approver/', 'middleware' => ['role:Approver']], function () {
    Route::get('dashboard', [App\Http\Controllers\ApproverController::class, 'index'])->name('approverdashboard');

    Route::get('/profile', [App\Http\Controllers\ApproverController::class, 'profile'])->name('app_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ApproverController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ApproverController::class, 'updatepasword']);
    Route::post('/profile/approver-changeProfilePic', [App\Http\Controllers\ApproverController::class, 'changeProfilePic'])->name('approverProfilePic');
    
    Route::get('/purchase_request', [App\Http\Controllers\ApproverController::class, 'purchase_request'])->name('app_purchase_request');
    Route::post('/requisitionsave', [App\Http\Controllers\ApproverController::class, 'addrequisition']);
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\ApproverController::class, 'view_purchase_request'])->name('app_vpr');

    Route::get('/new_pr', [App\Http\Controllers\ApproverController::class, 'new_pr'])->name('new_pr');
    Route::get('/new_pr/view/{pr_no}', [App\Http\Controllers\ApproverController::class, 'view_new_pr'])->name('view_new_pr');
    Route::patch('/new_pr/view/update_new_pr/{pr_no}', [App\Http\Controllers\ApproverController::class, 'update_new_pr']);

    Route::get('/pr_for_verification', [App\Http\Controllers\ApproverController::class, 'pr_for_verification'])->name('pr_for_verification');
    Route::get('/pr_for_verification/view/{pr_no}', [App\Http\Controllers\ApproverController::class, 'view_pr_for_verification'])->name('pr_verify');
    Route::patch('/pr_for_verification/view/verify_pr/{pr_no}', [App\Http\Controllers\ApproverController::class, 'verify_pr']);
    Route::get('/pr_for_verification/view/verified/{pr_no}', [App\Http\Controllers\ApproverController::class, 'update_pr_for_verification'])->name('update_verified');
    Route::patch('/pr_for_verification/view/verified/update/{pr_no}', [App\Http\Controllers\ApproverController::class, 'update_verified_pr']);
    Route::patch('/pr_for_verification/view/verified/delete/{id}', [App\Http\Controllers\ApproverController::class, 'delete_verified_item']);

});
// validator
Route::group(['prefix' => 'validator/', 'middleware' => ['role:Validator']], function () {
    Route::get('dashboard', [App\Http\Controllers\ValidatorController::class, 'index'])->name('validatordashboard');

    Route::get('/profile', [App\Http\Controllers\ValidatorController::class, 'profile'])->name('val_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ValidatorController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ValidatorController::class, 'updatepasword']);
    Route::post('/profile/validator-changeProfilePic', [App\Http\Controllers\ValidatorController::class, 'changeProfilePic'])->name('validatorProfilePic');

    Route::get('/purchase_request', [App\Http\Controllers\ValidatorController::class, 'purchase_request'])->name('val_purchase_request');
    Route::post('/requisitionsave', [App\Http\Controllers\ValidatorController::class, 'addrequisition']);
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\ValidatorController::class, 'view_purchase_request'])->name('val_vpr');
    
    Route::get('/pr_check_fund', [App\Http\Controllers\ValidatorController::class, 'pr_check_fund'])->name('pr_check_fund');
    Route::get('/pr_check_fund/view/{pr_no}', [App\Http\Controllers\ValidatorController::class, 'view_pr_check_fund'])->name('view_pr_check_fund');


});
// processor
Route::group(['prefix' => 'processor/', 'middleware' => ['role:Processor']], function () {
    Route::get('dashboard', [App\Http\Controllers\ProcessorController::class, 'index'])->name('processordashboard');

    Route::get('/profile', [App\Http\Controllers\ProcessorController::class, 'profile'])->name('pro_profile');
    Route::patch('/profile/update/{id}', [App\Http\Controllers\ProcessorController::class, 'updateprofile']);
    Route::patch('/profile/update/password/{id}', [App\Http\Controllers\ProcessorController::class, 'updatepasword']);
    Route::post('/profile/processor-changeProfilePic', [App\Http\Controllers\ProcessorController::class, 'changeProfilePic'])->name('processorProfilePic');

    Route::get('/purchase_request', [App\Http\Controllers\ProcessorController::class, 'purchase_request'])->name('pro_purchase_request');
    Route::post('/requisitionsave', [App\Http\Controllers\ProcessorController::class, 'addrequisition']);
    // Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'view_purchase_request']);
    Route::get('/purchase_request/view/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'view_purchase_request'])->name('pro_vpr');

    Route::get('/pr_for_canvass', [App\Http\Controllers\ProcessorController::class, 'pr_for_canvass'])->name('pr_for_canvass');
    // Route::get('/pr_for_canvass/view/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'view_pr_for_canvass']);
    Route::get('/pr_for_canvass/view/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'view_pr_for_canvass'])->name('pr_canvass');
    // Route::get('/pr_for_canvass/view/generate_canvass/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'generate_canvass']);
    Route::post('/pr_for_canvass/view/send_canvass/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'sendcanvass']);
    Route::get('/pr_for_canvass/view/canvassed/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'view_canvassed'])->name('view_canvassed');
    Route::patch('/pr_for_canvass/view/canvassed/update/{pr_no}', [App\Http\Controllers\ProcessorController::class, 'update_canvassed']);
    Route::delete('/pr_for_canvass/view/canvassed/delete/{id}', [App\Http\Controllers\ProcessorController::class, 'delete_canvassed_item']);


    Route::get('/supplier_items', [App\Http\Controllers\ProcessorController::class, 'supplier_items'])->name('pro_supplier_items');
    Route::post('/suppliersave', [App\Http\Controllers\ProcessorController::class, 'addsupplier']);
    Route::post('/itemsave', [App\Http\Controllers\ProcessorController::class, 'additem']);
    Route::patch('/supplier/update/{id}', [App\Http\Controllers\ProcessorController::class, 'updatesupplier']);
    Route::patch('/item/update/{id}', [App\Http\Controllers\ProcessorController::class, 'updateitem']);
    Route::delete('/supplier/delete/{id}', [App\Http\Controllers\ProcessorController::class, 'deletesupplier']);
    Route::delete('/item/delete/{id}', [App\Http\Controllers\ProcessorController::class, 'deleteitem']);
});
