<?php

namespace App\Http\Controllers\Client\membership;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MembershipClientController extends Controller
{
    //
    public function index(){
        // return view('client.membership');
        return view('client.membership.membership');
    }

    // Begin: Function to show the referal page with link
    public function show_refferal(){
        try{
            $userCnicNo = Auth::user()->cnic_no;
            // $extractedUserCnicNo = substr($userCnicNo, 6, 7);

            // Generate the referral link using the route function
            $referralLink = route('front-end.client.signupReferal', ['cnicNo' => $userCnicNo]);

            // dd($referralLink);
            return view('client.membership.referal-link-membership')->with(['referralLink' => $referralLink]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is:'.$e->getMessage());
        }
    }
    // End: Function to show the referal page with link
}
