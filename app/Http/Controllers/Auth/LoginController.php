<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Traits\HasPermissions;

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

    use AuthenticatesUsers, HasPermissions;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated()
    {
        if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2' || Auth::user()->role_as == '3') //1 = Admin Login
        {
            return redirect('dashboard')->with('status', 'Bienvenido ' . Auth::user()->name);
        } elseif (Auth::user()->role_as != '1' || Auth::user()->role_as != '2' || Auth::user()->role_as != '3') // Normal or Default User Login
        {
            return redirect('/')->with('status', 'Logged in successfully');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        logo_sitio();
        return view('auth.login');
    }
}
