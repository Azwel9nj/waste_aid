<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersZoneFranchisesController extends Controller
{
    public function index(){
        $user = auth()->user()->id;
        try{
            $theUsersZone = $this->getUsersZoneId($user);
            $theUsersZoneId = $theUsersZone[0]->zoneId;
            $franshisesInGivenZone = $this->getFranchisesInZone($theUsersZoneId);
            $zones = Zone::all();
            $zones = Zone::orderBy('created_at', 'desc')->paginate(10);
            return view('user.usersZoneFranchises.index')->with('frans', $franshisesInGivenZone)->with('zones', $zones);
        }catch(Exception $e){
            return Redirect::back()->with('error', 'You Must Select a Zone first');
        }
    }

    
}
