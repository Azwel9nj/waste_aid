<?php

namespace App\Http\Controllers\Franchise\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Franchise;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:council');
    }

    protected $redirectTo = 'council/councilDashboard';

    public function showRegistrationForm()
    {
        return view('franchise.auth.register');
    }

    public function register(Request $request)
    {       
        $this->validator($request->all())->validate();       
        $this->create($request->all());
        
        return redirect($this->redirectTo)->with('success', 'Success Franchise Added');;
    }

    protected function validator(array $data)
    {        
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:franchises',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric|phone:ZM' ,
            'day' => 'required'
        ]);
    }

    protected function create(array $data)
    {        
        $profile =  array('name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],);       
        
        //Mail::to($data['email'])->send(new WelcomeMail($profile));
        //if( count(Mail::failures()) > 0 ) {
            //return Redirect::back()->with('error', 'Unable to send Email. Please Check Your Internet connection');
        //}else{        
            $newFranchiseAccount = new Franchise();
            $newFranchiseAccount->name = $data['name'];
            $newFranchiseAccount->email = $data['email'];
            $newFranchiseAccount->phone =  $data['phone'];
            $newFranchiseAccount->collection = $data['day'];
            $newFranchiseAccount->password = bcrypt($data['password']);
            $newFranchiseAccount->save();
            return $newFranchiseAccount;
        //}
    }    

    protected function guard()
   {
       return Auth::guard('franchise');
   }
}
