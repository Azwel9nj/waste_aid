<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FranchisePagesController extends Controller
{
    public function index()
    {
        //$locations = DB::table('reqs')->get();
        //return view('franchiseDashboard', compact('locations'));
        return view('franchise/home');
    }
}
