<?php

namespace App\Http\Controllers\Franchise\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FranchiseLoginController extends Controller
{
    public function __construct()
    {        
        $this->middleware('guest:web,franchise,council',['except'=>['logout']]);       
    }

    protected $redirectTo = '/franchiseDashboard';

    public function showFranchiseLoginForm()
    { 
        return view('franchise.auth.franchiseLogin');
    }

    public function login(Request $request)
    {
        
        if ((Auth::guard('council')->check()) || (Auth::guard('web')->check())) {
            return redirect('/mistake')->with('error', 'Please logout first');
        }else{

        $this->validate($request, [
            'email' => 'required|email',
            'password'=>'required|min:6',
        ]);

        $email = $request->input('email'); 
        $status = Controller::checkIfFranchiseIsBlocked($email);       
        
        if($status > 0){
            return Redirect::back()->with('error', 'This Acount is blocked');
        }else{
        
        if (Auth::guard('franchise')->attempt([   
            'email'=>$request->email,   
            'password'=>$request->password
        
        ], $request->remember)){
            session_start();
            return redirect('/')->with('success', 'Welcome');            
        }
        
   
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error','Invalid Credentials');
        }

        }

        
    }

    public function logout(){
   

        Auth::guard('franchise')->logout();
        //session()->flush();
        //session()->regenerate();
        //return redirect()->guest(route( 'admin.login' ));
      
   
        return redirect('franchise/login');
   
    }
}
