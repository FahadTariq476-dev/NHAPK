<?php

namespace App\Http\Controllers\Frontend\Client;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginClientController extends Controller
{
    //
    public function index(){
        try{
            // 
            return view('frontEnd.client.login-client');
        }
        catch(Exception $e){
            return redirect()->route('Home')->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    // Begin: Function to check the credentails and logged in the client user
    public function login_credentials(Request $req){
        // dd($req->toArray());
        try{
            // 
            $rules=[
                'username'=>'required|email',
                'password'=>'required',
            ];
            $this->validate($req,$rules);
            $email = $req->username;
            $password=$req->password;
            // Retrieve the submitted login credentials
            $credentials = ['email' => $email, 'password' => $password];
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                /// Check the user's role after successful login
                $user = Auth::user();
                $userRoles = Auth::user()->getRoleNames();
    
                if ($userRoles->contains('nhapk_client') && ($user->nhapk_register) == 1 ) {
                    // dd("Yes Client");
                    // Redirect to the desired route for nhapk_client role
                    return redirect()->route('client.dashboard.index')->with('success',"Successfully Logged in Now!");
                } 
                
                else {
                    Auth::logout();
                    return redirect()->route('front-end.client.login')->with('error', 'Invalid Credentials');
                }
            } else {
                return redirect()->route('front-end.client.login')->with('error', 'Invalid Credentials');
            }
        }
        catch(Exception $e){
            return redirect()->route('front-end.client.login')->with('error','Your Exception is:'.$e->getMessage());
        }
    }
    // End: Function to check the credentails and logged in the client user
}
