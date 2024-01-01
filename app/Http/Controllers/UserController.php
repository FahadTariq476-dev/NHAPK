<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    //
    public function uniqueEmail($email)
    {
        $result = User::where('email', $email)->get();
        if (count($result) > 0) {
            return 1;   // Email exist
        } else {
            return 0;   //Email is unique
        }
    }

    public function uniqueCNIC($cnic)
    {
        $result = User::where('cnic_no', $cnic)->get();
        if (count($result) > 0) {
            return 1;   // CNIC exist
        } else {
            return 0;   //CNIC does not exist
        }
    }

    public function uniqueCnicWithData($cnic)
    {
        $exists = User::where('cnic_no', $cnic)->exists();
        if ($exists) {
            return User::where('cnic_no', $cnic)->first();   // CNIC exists
        } else {
            return 0;   // CNIC does not exist
        }
    }

    public function index(Request $request)
    {
          
        if ($request->ajax()) {
            $data = User::where('nhapk_register',1)->get();
            $formattedData = [];
            foreach ($data as $item) {
                       $formattedData[] = [
                    $item->id,
                    $item->name,
                    $item->firstname,
                    $item->lastname,
                    $item->hostel_name,
                    $item->email,
                    // $item->email_verified_at,
                    $item->password,
                    $item->remember_token,
                    $item->date_of_birth,
                    $item->phone_number,
                    $item->cnic_no,
                    $item->institute,
                    $item->address,
                    $item->short_description,
                    $item->slug,
                    $item->picture_path,
                    $item->youtube_link,
                    $item->facebook_link,
                    $item->instagram_link,
                    $item->auto_approve_booking,
                    $item->nhapk_register,
                ];
            }
            return DataTables::of($formattedData)
                ->escapeColumns([]) // Specify the index of the action column that contains raw HTML
                ->make(true);
                
        }
        $formattedData =[]; 
        return view('admin.user',compact('formattedData')); 
    }
}