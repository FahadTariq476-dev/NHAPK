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
            return 1;   // Email exist
        }
        else{
            return 0;   //Email is unique
        }
        
    }

    public function uniqueCNIC($cnic){
        $result = User::where('cnic_no',$cnic)->get();
        if(count($result)>0){
            return 1;   // CNIC exist
        }
        else{
            return 0;   //CNIC does not exist
        }
    }
}
