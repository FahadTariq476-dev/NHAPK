<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function showAdminLoginForm(){
        // return "yes";
        return view('admin.login');
    }

    function AdminloginPost(Request $req){
        //
        $email = $req->username;
        $password=$req->password;
        // return $req;
        if(!empty($email) && !empty($password)){
            // Retrieve the submitted login credentials
            $credentials = ['email' => $email, 'password' => $password];
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                // return view('admin.dashboard');
                return redirect()->route('admin.ShowDashboard')->with('success',"Logged in");
                // return redirect()->route('admin.ShowDashboard')->with('success',"Logged in");
                // return "Login Successfull";
            } else {
                return redirect()->route('admin.login.showForm')->with('error', 'Invalid Credentials');
            }
        }
        else{
            return redirect()->route('admin.login.showForm')->with('error',"Username and Password must be provided");
        }
    }
}
