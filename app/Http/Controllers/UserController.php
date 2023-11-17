<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function uniqueEmail($email){
        $result = User::where('email',$email)->get();
        if(count($result)>0){
            return 0;   // Email exist
        }
        else{
            return 1;   //Email is unique
        }
        
    }
}
