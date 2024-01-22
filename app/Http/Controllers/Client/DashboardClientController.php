<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\HosteliteMeta;
use App\Models\Membership;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardClientController extends Controller
{
    // Begin: Function to show the index.blade.php of client (Client Home Page)
    public function index(){
        try{
            $roles = Auth::user()->roles;
            $referalNo = Membership::where('parent_id',Auth::id())->count();
            // dd($referalNo);
            // Use pluck to get an array of role names
            $roleNames = $roles->pluck('name')->toArray();
            $allowedRoleNames = [
                'Who did not  decided  role yet',
                'I am Hostelites',
                'Hostel Working Staff eg. Made,  Helper, Doormen / Guard',
                'Admin / Manager / Cook / Warden',
                'Staff or Team Member of NHAP',
                'Sponsor / Supporter of NHAP',
                'Private Hostel Owner/ Antiusist',
            ];
            
            // Check if user has any of the allowed roles
            $hasAllowedRole = count(array_intersect($roleNames, $allowedRoleNames)) > 0;
            // Output the array of role names
            $hosteliteMetasFieldData = '';
            if($hasAllowedRole == true){
                $hosteliteMetas = HosteliteMeta::where('hostelite_id',Auth::id())->get();
                if(count($hosteliteMetas)>0){
                    $hosteliteMetasFieldData = "Filled";
                    return view('client.index')->with([
                        'hosteliteMetasFieldData' => $hosteliteMetasFieldData,
                        'referalNo' => $referalNo,
                    ]);
                }
                else{
                    $hosteliteMetasFieldData = "Empty";
                    $countries = Country::all();
                    return view('client.hostelites.post-hostelites')->with([
                        'countries' => $countries,
                        'hosteliteMetasFieldData' => $hosteliteMetasFieldData,
                        'referalNo' => $referalNo,
                    ]);
                }
            }
            else{
                $hosteliteMetasFieldData = "NotRequired";
                return view('client.index')->with([
                    'hosteliteMetasFieldData' => $hosteliteMetasFieldData,
                    'referalNo' => $referalNo,
                ]);
            }
            
            
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    // End: Function to show the index.blade.php of client (Client Home Page)
    
}
