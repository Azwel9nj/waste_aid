<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Zones;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkIfFranchiseIsBlocked($email)
    {
        $inactive = 2;
        $status = DB::table('franchises')->where('email', $email)
            ->where('active', $inactive)
            ->count();
        return $status;
    }

    public function checkUserSubscription($userId)
    {
        $subscription = DB::table('users')
            ->join('user_franchises', 'users.id', '=', 'user_franchises.userId')
            ->join('franchises', 'user_franchises.franchiseId', '=', 'franchises.id')
            ->where('users.id', '=', $userId)
            ->select('franchises.id', 'franchises.name', 'user_franchises.franchiseId', 'user_franchises.id', 'franchises.email', 'franchises.phone', 'franchises.collecton')
            ->get();
        return $subscription;
    }

    public function getFranchisesInZone($theUsersZoneId){

        $franshisesInGivenZone = DB::table('franchises')
        ->join('franchise_zones','franchises.id','=','franchise_zones.franchiseId')
        ->where('franchise_zones.zoneId','=',$theUsersZoneId)
        ->where('franchises.active','=','1')
        ->select('franchises.name', 'franchises.id')
        ->paginate(15);

        return $franshisesInGivenZone;
    }    

    public function getUsersZoneId($userId)
    {
        $zones = DB::table('user_zones')
            ->join('zones', 'zones.id', '=', 'user_zones.zoneId')
            ->where('user_zones.userId', '=', $userId)
            ->select('zones.*', 'user_zones.*')
            ->get();
        return $zones;
    }

    

    public function getFranchiseId($userId)
    {
        $userSubscription = DB::table('users')
            ->join('user_franchises', 'users.id', '=', 'user_franchises.userId')
            ->join('franchises', 'user_franchises.franchiseId', '=', 'franchises.id')
            ->where('users.id', '=', $userId)
            ->select('franchises.id')
            ->get();
        $franchiseId = $userSubscription[0]->id;
        return $franchiseId;
    }

    public function getOfRatingsAverage($usersFranchiseId)
    {
        $averageOfRatings = DB::table('franchise_ratings')
            ->where('franchiseId', '=', $usersFranchiseId)
            ->groupBy('franchiseId')
            ->avg('rating');
        $averageOfRatings = round($averageOfRatings, 2);
        return $averageOfRatings;
    }

    public function getFranchiseReviews($usersFranchiseId)
    {
        $reviews = DB::table('franchise_ratings')
            ->where('franchiseId', '=', $usersFranchiseId)
            ->select('franchise_ratings.*')
            ->orderBy('created_at', 'desc')
            ->get();
        return $reviews;
    }

    public function percentageOfRatingValueForANumber($inputNumber, $optionalfranchiseId = null)
    {
        $userId = auth()->user()->id;
        try {
            $franchiseId = $this->getFranchiseId($userId);
            $allFranchiseRatings = DB::table('franchise_ratings')->where('franchiseId', $franchiseId ?? $optionalfranchiseId)
                ->count();
            if ($allFranchiseRatings <= 0) {
                $totalNumberOfRatingsForTheFranchise = 1;
            } else {
                $totalNumberOfRatingsForTheFranchise = $allFranchiseRatings;
            }
        } catch (Exception $e) {
            return "No Franchise";
        }
        $numberOfOccurencesOfInputNumber = DB::table('franchise_ratings')->where('franchiseId', $franchiseId)
            ->where('rating', $inputNumber)
            ->count();
        $percent = (($numberOfOccurencesOfInputNumber * 100) / $totalNumberOfRatingsForTheFranchise);
        return $percent;
    }

    public function zonesIndexPageLoader()
    {
        $zones = Zone::all();
        $zones = Zone::orderBy('created_at', 'desc')->paginate(10);
        return view('zones.index')->with('zones', $zones);
    }

    public function checkIfUserIsSubscribedToAZone($userId){
        $checkIfUserIsSubscibedToAZone = DB::table('user_zones')
                                    ->where('userId',$userId)                    
                                    ->count();
        return $checkIfUserIsSubscibedToAZone;
    }
    
}
