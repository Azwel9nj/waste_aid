<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\UserZone;
use Exception;
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
            $zones = Zone::all();
            $zones = Zone::orderBy('created_at','desc')->paginate(10);
            return view('user.userZones.index')->with('zones',$zones);
        }        
    }

    private function checkIfUserIsSubscribedToAFranchise($user){

        $checkIfUserIsSubscribedToAFranchise= DB::table('user_franchises')
        ->where('user_franchises.userId','=',$user)
        ->count();
        return $checkIfUserIsSubscribedToAFranchise;
    }

    public function storeZone(Request $request){
        $this->validate($request, [
            'zoneId' => 'required'
        ]);
        //try{
            $zone = $request->input('zoneId');
            $user = auth()->user()->id;
            $checkIfUserIsSubscibedToAZone = $this->checkIfUserIsSubscribedToAZone($user);

            if($checkIfUserIsSubscibedToAZone > 0){
                $usersZone = $this->getUsersZoneId($user);           
                $usersZoneId = $usersZone[0]->id;
                $this->update($request,$usersZoneId);
                return redirect('/user/viewFranchisesInTheZone')->with('success', 'Zone Updated, You may proceed to select your Franchise');
            }else{
                $createNewUsersZone = new UserZone;
                $createNewUsersZone->userId = auth()->user()->id;
                $createNewUsersZone->zoneId = $request->input('zoneId');
                $createNewUsersZone->save();
                return redirect('/user/viewFranchisesInTheZone')->with('success','Zone Selected, You may proceed to select your Franchise');
            }
        /*}catch(Exception $e){
            return 'there are no zones';
        }*/
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'zoneId' => 'required'
        ]);
        $editNewUsersZone= UserZone::find($id);
        $editNewUsersZone->userId = auth()->user()->id;
        $editNewUsersZone->zoneId = $request->input('zoneId');
        $editNewUsersZone->save();
        
    }
}
