<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Country;
use App\Models\Properties;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    //
    public function showComplaintForm(){
        // $hostels = Properties::select('name','id')->get();
        $countries = Country::select('name','id')->get();
        return view('frontEnd.complaint')->with([
            'countries' => $countries,
        ]);
    }

    // To Save the complaint into db
    public function saveComplaint(Request $req){
        // Validation rules
        $rules = [
            'fullName' => 'required',
            'MobNo' => 'required|numeric|digits:9',
            'email' => 'required|email',
            'roomNumber' => 'required',
            'hostelId' => 'required|exists:properties,id',
            'complaintType' => 'required|in:cleanliness,maintenance,security',
            'priority' => 'required|in:high,low,normal',
            'complaintDetails' => 'required',
        ];

        // Validation messages
        $messages = [
            'hostelId.exists' => 'Invalid hostel ID.',
        ];

        // Validate the request data
        $this->validate($req, $rules, $messages);

        // If validation passes, you can continue with processing the data
        $complaint = new Complaint();
        $complaint->name = $req->fullName;
        $complaint->mob_no = '+923'.$req->MobNo;
        $complaint->email = $req->email;
        $complaint->room_no = $req->roomNumber;
        $complaint->hostel_id = $req->hostelId;
        $complaint->complaint_type = $req->complaintType;
        $complaint->complaint_priority = $req->priority;
        $complaint->complaint_details = $req->complaintDetails;
        $complaint->save();
        if(!$complaint){
            return redirect()->route('forntEnd.showComplaintForm')->with('error','Complaint was not saved. Kindly try again.');
        }
        else{
            return redirect()->route('forntEnd.showComplaintForm')->with('success','Complaint has been save now. Succesfully!');
        }

 


        // dd($req->toArray());
    }
}
