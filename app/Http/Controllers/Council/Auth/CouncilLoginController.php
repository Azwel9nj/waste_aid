<?php

namespace App\Http\Controllers\Council\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouncilLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web,council,franchise',['except'=>['logout']]);
    }
    protected $redirectTo = '/councilDashboard';

    
}
