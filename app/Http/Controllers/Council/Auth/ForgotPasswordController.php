<?php

namespace App\Http\Controllers\Council\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index() {
        return view('council.auth.forgotPassword');
    }
}
