<?php

namespace App\Http\Controllers\Council\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;

class CouncilLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web,council,franchise',['except'=>['logout']]);
    }
    protected $redirectTo = '/councilDashboard';

    public function showCouncilLoginForm()
    {        
        return view('council.auth.councilLogin');
    }

    public function login(Request $request)
    {

        if ((Auth::guard('franchise')->check()) || (Auth::guard('web')->check())) {
            return redirect('/mistake')->with('error', 'Please logout first');       
         }else{
        $this->validate($request, [
        'email' => 'required|email',
        'password'=>'required|min:6',
        ]);
   
        if (Auth::guard('council')->attempt([   
            'email'=>$request->email,   
            'password'=>$request->password   
        ], $request->remember)){            
            return redirect('council/councilDashboard')->with('success', 'Welcome');
   
        }
   
        return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    
}
