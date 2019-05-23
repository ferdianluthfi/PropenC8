<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Redirect;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if(Auth::user()->status == 0){
                return redirect('/');
            }
            Auth::logout();
            session()->flash('error', 'Akun sudah tidak aktif');
            return Redirect::to('/login');
        }
        else{
            session()->flash('error', 'Username atau Password salah!');
            return Redirect::to('/login');
        }
    }
}
