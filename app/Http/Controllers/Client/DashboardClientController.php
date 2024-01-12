<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\HosteliteMeta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardClientController extends Controller
{
    //
    // Begin: Function to show the index.blade.php of client (Client Home Page)
    public function index(){
        try{
            $hosteliteMetas = HosteliteMeta::where('hostelite_id',Auth::id())->get();
            if(count($hosteliteMetas)>0){
                // dd("yes");
            }
            else{
                $countries = Country::all();
                return view('client.hostelites.post-hostelites')->with([
                    'countries' => $countries,
                ]);
            }
            return view('client.index');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
            // dd($e->getMessage());
        }
    }
    // End: Function to show the index.blade.php of client (Client Home Page)
    
}
