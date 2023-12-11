<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembershipClientController extends Controller
{
    //
    public function index(){
        // return view('client.membership');
        return view('client.membership.membership');
    }
}
