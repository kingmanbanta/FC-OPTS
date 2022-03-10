<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(request $request,$user){
        if($user->hasRole('Administrator')){
            return redirect()->route('admindashboard');
        }
        if($user->hasRole('Processor')){
            return redirect()->route('processordashboard');
        }

        if($user->hasRole(['Validator'])){
            return redirect()->route('validatordashboard');
        }
        if($user->hasRole(['Approver'])){
            return redirect()->route('approverdashboard');
        }
        if($user->hasRole(['Requestor'])){
            return redirect()->route('requestordashboard');
        }
    }
}
