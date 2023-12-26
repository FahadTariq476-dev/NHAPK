<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\Properties;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    //
    public function showComplaintForm(){
        // $hostels = Properties::select('name','id')->get();
        $countries = Country::select('name','id')->get();
        $complaint_types = ComplaintType::select('name','id','description')->where('status',1)->get();
        return view('frontEnd.complaints.post-complaint')->with([
            'countries' => $countries,
            'complaint_types' => $complaint_types,
        ]);
    }



    // To Save the complaint into db
    public function saveComplaint(Request $req){
        // Validation rules
        $rules = [
            'fullName' => 'required',
            // 'MobNo' => 'required|numeric|digits:9',
            'MobNo' => 'required|numeric|digits:10|regex:/^3\d{9}$/',
            'email' => 'required|email',
            'roomNumber' => 'required',
            'countryId' => 'required',
            'stateId' => 'required|exists:states,id',
            'cityId' => 'required|exists:cities,id',
            'hostelId' => 'required|exists:properties,id',
            'complaintType' => 'required|exists:nhapk_complaint_types,id',
            'priority' => 'required|in:high,low,normal',
            'complaintDetails' => 'required',
        ];

        // Validation messages
        $messages = [
            'hostelId.exists' => 'Invalid hostel ID.',
            'countryId.exsits' => 'Invalid Country ID.',
            'stateId.exsits' => 'Invalid State ID.',
            'cityId.exsits' => 'Invalid City ID.',
            'MobNo.regex' => 'Mobile Number should be provided and should start with 3 and contain only ten digits.',
        ];
        // dd($req->toArray());

        // Validate the request data
        $this->validate($req, $rules, $messages);
        // return "Yes";

        // If validation passes, you can continue with processing the data
        $complaint = new Complaint();
        $complaint->name = $req->fullName;
        $complaint->mob_no = '+92'.$req->MobNo;
        $complaint->email = $req->email;
        $complaint->room_no = $req->roomNumber;
        $complaint->hostel_id = $req->hostelId;
        $complaint->state_id = $req->stateId;
        $complaint->city_id = $req->cityId;
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

    }
}
