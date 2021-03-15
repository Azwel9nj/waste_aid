<?php

namespace App\Http\Controllers\Council;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouncilPageController extends Controller
{
    public function index()
    {
        return view('council.home');
    }
}
