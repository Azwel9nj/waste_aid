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
}
