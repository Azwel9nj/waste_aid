<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserFranchise;
use App\Models\UserRequestCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $subscription = Controller::checkUserSubscription($userId);
        }catch(Exception $e){
            return Redirect::back()->with('error', 'You Must Select a Zone first');
        }
        try{       
            $usersFranchiseId = Controller::getFranchiseId($userId);
            $averageOfRatings = Controller::getOfRatingsAverage($usersFranchiseId);
            $reviews = Controller::getFranchiseReviews($usersFranchiseId);            
        }catch(Exception $s){
            $averageOfRatings = "No Ratings";
            $reviews = [];
        }
        try {
            $zones = Controller::getUserZoneId($userId);
            $zoneName = $zones[0]->zone;
        } catch (Exception $e) {
            $zones = [];
            $zoneName = "None";
        }

        date_default_timezone_set('Africa/Cairo');

        $one = Controller::percentageOfRatingValueForANumber(1);
        $two = Controller::percentageOfRatingValueForANumber(2);
        $three = Controller::percentageOfRatingValueForANumber(3);
        $four = Controller::percentageOfRatingValueForANumber(4);
        $five = Controller::percentageOfRatingValueForANumber(5);

        $data = array(
            'zoneName' => $zoneName,
            'zones' => $zones,
            'reviews' => $reviews,
            'avgs' => $averageOfRatings,
            'subs' => $subscription,
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
            'five' => $five,
        );
        return view('user.subscription.index')->with($data);
    }

    private function checkIfUserIsSubscribed($userId){
        $checkIfUserIsAlreadySubscribed = DB::table('user_franchises')
            ->where('userId', '=', $userId)
            ->count();
        return $checkIfUserIsAlreadySubscribed;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'franid' => 'required',
        ]);

        $userId = auth()->user()->id;
        $checkIfUserIsAlreadySubscribed = $this->checkIfUserIsSubscribed($userId);
        if ($checkIfUserIsAlreadySubscribed > 0) {
            return redirect('user/userSubscribtion')->with('error', 'You are already subscribed, please unsubscribe from your current franchise first.');
        } else {
            $usersFranchise = new UserFranchise();
            $usersFranchise->franchise_id = $request->input('franid');
            $usersFranchise->user_id = auth()->user()->id;
            $usersFranchise->save();
            return redirect('user/userSubscribtion')->with('success', 'Subscription Successful');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'statusName' => 'required',
            'franid' => 'required',
            'requestid' => 'required',
        ]);
        $franchiseId = $request->input('franid');
        $user = auth()->user()->id;
        $value = $request->input('status');
        $requestid = $request->input('requestid');

        $anamount = DB::table('user_request_collections')
            ->where('user_id', $user)
            ->where('fran_id', $franchiseId)
            ->where('request_id', $requestid)
            ->count();

        print $anamount;

        if ($anamount > 0) {
            $user = auth()->user()->id;
            $value = DB::table('user_request_collections')
                ->where('user_id', $user)
                ->where('fran_id', $franchiseId)
                ->where('request_id', $requestid)
                ->select('collections.id')
                ->get();

            $id = $value[0]->id;

            $col = UserRequestCollection::find($id);

            $col->user_id = auth()->user()->id;
            $col->fran_id = $request->input('franid');
            $col->request_id = $request->input('requestid');
            $col->valuation_id = $request->input('status');
            $col->save();

            // CollectionController::update($request, $id);

            return redirect('/usersub')->with('success', 'Review Update');

        } else {

            $col = new UserCollection;

            $col->user_id = auth()->user()->id;
            $col->request_id = $request->input('requestid');
            $col->fran_id = $request->input('franid');
            $col->valuation_id = $request->input('status');
            $col->save();

        }

        $check = $request->input('status');

        if ($check == 0) {

            $subs = DB::table('reqs')
                ->join('acc_reqs', 'reqs.id', '=', 'acc_reqs.request_id')
                ->where('reqs.id', '=', $id)
                ->select('acc_reqs.id')
                ->get();

            $subbs = $subs[0]->id;
            print $subbs;

            $req = Req::find($id);
            $req->status = $request->input('status');
            $req->statusName = $request->input('statusName');

            $req->save();
            $accReq = accReq::find($subbs);
            $accReq->delete();

            return redirect('/userreq')->with('success', 'Thank You For your feedback. And sorry for the inconvinience this may have cause');
        } else {
            $req = Req::find($id);
            $req->status = $request->input('status');
            $req->statusName = $request->input('statusName');

            $req->save();
            return redirect('/userreq')->with('success', 'Thank You for the feedback. Your Request has been cleared');
        }
    }

    public function destroy($id)
    {
        $usersSubcription = UserFranchise::find($id);
        $usersSubcription->delete();

        return redirect('user/userSubscribtion')->with('success', 'Subscription Cancelled');

    }
    //
}
