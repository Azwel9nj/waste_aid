<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Zones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersZoneController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $checkIfUserIsSubscribedToAFranchise = $this->checkIfUserIsSubscribedToAFranchise($user);

        if($checkIfUserIsSubscribedToAFranchise > 0){
            return redirect('usersub')->with('error', 'You must Unsubscibe from your current Franchise in order to select a new Zone');           
        }else{
            $zones = Zones::all();
            $zones = Zones::orderBy('created_at','desc')->paginate(10);
            return view('user.userZones.index')->with('zones',$zones);
        }        
    }

    private function checkIfUserIsSubscribedToAFranchise($user){

        $checkIfUserIsSubscribedToAFranchise= DB::table('user_franchises')
        ->where('user_franchises.userId','=',$user)
        ->count();
        return $checkIfUserIsSubscribedToAFranchise;
    }
}
