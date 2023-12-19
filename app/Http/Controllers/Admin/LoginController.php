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
            /// Check the user's role after successful login
            $user = Auth::user();
            $userRoles = Auth::user()->getRoleNames();
            // && ($user->nhapk_register) == 1
            if ($userRoles->contains('nhapk_admin')) {
                // Redirect to the desired route for nhapk_admin role
                return redirect()->route('admin.ShowDashboard')->with('success',"Successfully Logged in Now!");
            } 
            
            else {
                Auth::logout();
                return redirect()->route('admin.login.showForm')->with('error', 'Invalid Credentials');
            }
        } else {
            return redirect()->route('admin.login.showForm')->with('error', 'Invalid Credentials');
        }
    }
}
