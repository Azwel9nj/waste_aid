<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function index(){

        $userId = auth()->user()->id;
        
        try{
            Controller::checkUserSubscription($userId);
        }catch(Exception $e){
            return Redirect::back()->with('error', 'You Must Select a Zone first');
        }
    }
    //
}
