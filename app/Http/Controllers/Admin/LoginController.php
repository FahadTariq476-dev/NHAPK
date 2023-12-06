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
            // return view('admin.dashboard');
            return redirect()->route('admin.ShowDashboard')->with('success',"Logged in");
            // return redirect()->route('admin.ShowDashboard')->with('success',"Logged in");
            // return "Login Successfull";
        } else {
            return redirect()->route('admin.login.showForm')->with('error', 'Invalid Credentials');
        }
    }
}
