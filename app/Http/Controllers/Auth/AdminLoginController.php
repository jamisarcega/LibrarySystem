<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function adminLogin()
    {
        return view('auth.admin.login');
    }
    public function adminLoginSubmit(Request $request)
    {
        $validatedData = $request->validate([
            
            'g-recaptcha-response' => 'required',
        ]);
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('admin.index'));
        }
    
        
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return view('welcome');
    }
}
