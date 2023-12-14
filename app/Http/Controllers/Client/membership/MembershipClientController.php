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
            $author_id = Auth::user()->id;

            // Encrypt the author ID to create a reversible identifier
            $encryptedAuthorId = Crypt::encrypt($author_id);

            // Generate the referral link using the route function
            $referralLink = route('membership.registration.refferal', ['token' => $encryptedAuthorId]);

            // dd($referralLink);
            return view('client.membership.referal-link-membership')->with(['referralLink' => $referralLink]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is:'.$e->getMessage());
        }
    }
    // End: Function to show the referal page with link
}
