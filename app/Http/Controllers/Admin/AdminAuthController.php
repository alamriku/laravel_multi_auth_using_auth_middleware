<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class AdminAuthController extends Controller
{
    use AuthenticatesUsers;
    protected $guardName='admin';
    protected $maxAttempts=3;
    protected $decayMinutes=2;

    protected $loginRoute;

    public function __construct()
    {


        $this->middleware('guest:admin')->except('postLogout');
        $this->loginRoute=route('admin.login');

    }

    public function getLogin(){
        return view('admin.login');
    }

    public function postLogout(Request $request){
//        Auth::guard($this->guardName)->logout();
//        Session:flush();
//        return redirect(route('admin.login'));
        $this->guard($this->guardName)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('admin/login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];


        if (Auth::guard($this->guardName)->attempt($credential)) {

            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended(route('admin.dashboard'));


        } else {
            $this->incrementLoginAttempts($request);
            $this->sendFailedLoginResponse($request);


        }
    }

}
