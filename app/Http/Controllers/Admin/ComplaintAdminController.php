<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ComplaintAdminController extends Controller
{
    //
    public function adminListComplaintView(){
        return view('admin.complaints.list-complaint');
    }

    public function adminListingComplaint(Request $request){
        if ($request->ajax()) {
            $complaints = Complaint::with(['property', 'complaintType'])->latest()->get();
            return DataTables::of($complaints)
                ->addIndexColumn()
                ->addColumn('property_name', function ($complaint) {
                    return $complaint->property->name;
                })
                ->addColumn('complaint_type_name', function ($complaint) {
                    return $complaint->complaintType->name;
                })
                ->make(true);
        }        
        
        return abort(403, 'Unauthorized action.');
    }

    // To Update the status
    public function updateComplaintStatus($status,$complaintId){
        // Define an array of valid status values
        $validStatuses = ['pending', 'approved', 'resolved', 'inprocess'];

        // Check if the given $status is in the array of valid statuses
        if (!(in_array($status, $validStatuses))) {
            return 'error';
        }
        $complaint = Complaint::find($complaintId);
        if(!$complaint){
            return 'error';
        }
        $complaint->status = $status;
        $complaint->save();

        return 'success';
    }

    // Begin: Function to get the complaint details using id of complaint
    public function get_details($id){
        $complaints = Complaint::find($id);
        $data ="";
        if(!$complaints){
            $data = "Your are accessing the invalid data";
            return $data;
        }
        $data = $complaints->complaint_details;
        return $data;
    }
    // End: Function to get the complaint details using id of complaint

}
