<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
          
    }
    public function showCustomerLoginForm()
    {
        return view('auth.login', ['url' => 'customer']);
    }

    public function customerLogin(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $this->credentials($request);
        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            if ($this->guard()->user()->is_active === 0) 
            { 
                $this->guard()->logout();
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        $this->username() => 'Your account is inactive ',
                    ]);   
                return $this->sendFailedLoginResponse($request); 
            }
            return redirect()->intended('/customer');
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request) {
        Auth::guard('customer')->logout();
        return redirect('/customer/login');
    }
    public function guard(){
       return Auth::guard('customer');
    }
}
