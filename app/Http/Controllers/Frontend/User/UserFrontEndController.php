<?php

namespace App\Http\Controllers\Frontend\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFrontEndController extends Controller
{
    /**
     * Function to take CNIC and in response send cnic details
     */
    public function cnicDetails($cnic){
        try{
            $user = User::where('cnic_no', $cnic)->first();
            if(!($user)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'No User Found Against the Cnic.',
                ]);
            }
            else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'User Data Found',
                    'user' => $user,
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to take CNIC and in response send cnic is unique or not
     */
    public function cnicUnique($cnic){
        try{
            $user = User::where('cnic_no', $cnic)->first();
            if(!($user)){
                return response()->json([
                    'status' => 1,
                    'message' => 'Cnic is Unique',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Cnic is not Unique. Kindly Provide Unique Cnic.',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to take mobNo and in response send mobNo is unique or not
     */
    public function uniqueMobileNumb($mobNo){
        try{
            $user = User::where('phone_number', $mobNo)->first();
            if(!($user)){
                return response()->json([
                    'status' => 1,
                    'message' => 'Mob No is Unique',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Mob No is not Unique. Kindly Provide Unique Mob No.',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to take email and in response send email is unique or not
     */
    public function uniqueEmail($email){
        try{
            $user = User::where('email', $email)->first();
            if(!($user)){
                return response()->json([
                    'status' => 1,
                    'message' => 'Email is Unique',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Email is not Unique. Kindly Provide Unique Email.',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
}
