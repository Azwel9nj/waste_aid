<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Zones;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersZoneFranchisesController extends Controller
{
    public function index(){
        $user = auth()->user()->id;
        try{
            $theUsersZone = Controller::getUserZoneId($user);
            $theUsersZoneId = $theUsersZone[0]->zoneId;
            $franshisesInGivenZone = Controller::getFranchisesInZone($theUsersZoneId);
            $zones = Zones::all();
            $zones = Zones::orderBy('created_at', 'desc')->paginate(10);
            return view('user.usersZoneFranchises.index')->with('frans', $franshisesInGivenZone)->with('zones', $zones);
        }catch(Exception $e){
            return Redirect::back()->with('error', 'You Must Select a Zone first');
        }
    }

    
}
