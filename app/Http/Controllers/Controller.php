<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function checkIfFranchiseIsBlocked($email){        
        $inactive = 2;
        $status = DB::table('franchises')->where('email',$email)
                        ->where('active', $inactive)
                        ->count();
        return $status;
    }

    public function checkUserSubscription($userId){
        $subscription = DB::table('users')
        ->join('user_franchises','users.id','=','user_franchises.userId')
        ->join('franchises','user_franchises.franchiseId','=','franchises.id')
        ->where('users.id','=',$userId)
        ->select('franchises.id','franchises.name','user_franchises.franchiseId','user_franchises.id','franchises.email','franchises.phone','franchises.collecton')
        ->get();         
        return $subscription;
    }

    public function getUserZoneId($userId){
        $zones = DB::table('user_zones')
            ->join('zones','zones.id','=','user_zones.zoneId')
            ->where('user_zones.userId','=', $userId)
            ->select('zones.*','user_zones.*')
            ->get();        
        return $zones;
    }

    public function getFranchisesInZone($theUsersZoneId)
    {
        $franshisesInGivenZone = DB::table('franchises')
            ->join('franchise_zones', 'franchises.id', '=', 'franchise_zones.franchiseId')
            ->where('franchise_zones.zoneId', '=', $theUsersZoneId)
            ->where('franchises.active', '=', '1')
            ->select('franchises.name', 'franchises.id')
            ->paginate(15);

        return $franshisesInGivenZone;
    }
}
