<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactUsAdminController extends Controller
{
    //
    // Begin: Function to show the list-contactUsblade.php file
    public function index(){
        return view('admin.contact-us.list-contactUs');
    }
    // End: Function to show the list-contactUsblade.php file

    // Begin: Function to list the contact us data in data table
    public function adminListContactUs(Request $request){
        // 
        if($request->ajax()){
            $results = ContactUs::latest()->get();
            // dd($results->toArray());
            return DataTables::of($results)->addIndexColumn()->make(true);
        }
        return abort(403, 'Unathorized action');
    }
    // End: Function to list the contact us data in data table

    // Begin: Function to get the message using id of contact us
    public function get_message($id){
        $contactUs = ContactUs::find($id);
        $data ="";
        if(!$contactUs){
            $data = "Your are accessing the invalid data";
            return $data;
        }
        $data = $contactUs->message;
        return $data;
    }
    // End: Function to get the message using id of contact us
}
