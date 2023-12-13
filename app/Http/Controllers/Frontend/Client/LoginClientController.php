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

    // Begin: Function to check the credentails and logged in the cleint user
    public function login_credentials(Request $req){
        // dd($req->toArray());
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
            // dd("Yess");
            /// Check the user's role after successful login
            $userRoles = Auth::user()->getRoleNames();

            if ($userRoles->contains('nhapk_client')) {
                // dd("Yes Client");
                // Redirect to the desired route for nhapk_client role
                // return redirect()->route('nhapk_client.dashboard')->with('success', 'Login Successful');
                return redirect()->route('client.dashboard.index')->with('success',"Successfully Logged in Now!");
                // return view('client.index');
                // dd("Login Successful");
            } 
            
            else {
                Auth::logout();
                return redirect()->route('front-end.client.login')->with('error', 'Invalid Credentials');
            }
        } else {
            return redirect()->route('front-end.client.login')->with('error', 'Invalid Credentials');
        }
    }
    // End: Function to check the credentails and logged in the cleint user

}
