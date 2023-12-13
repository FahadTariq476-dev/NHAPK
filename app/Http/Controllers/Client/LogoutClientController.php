<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutClientController extends Controller
{
    //
    public function logout(){
        Auth::logout();
        return redirect()->route('Home')->with('success','You Logout Sccessfully');
    }
}
