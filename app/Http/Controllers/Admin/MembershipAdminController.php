<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MembershipAdminController extends Controller
{
    //
    public function indexMembership(){
        return view('admin.list-membership');
    }

    // 
    public function adminListingMemebership(Request $request){
        // 
        if($request->ajax()){
            // $memberships = Membership::with('membershipTypes')->latest()->get();
            $memberships = Membership::with([
                                            'membershipTypes' => function ($query) { $query->select('id', 'name'); },
                                            'country' => function ($query) { $query->select('id', 'name'); },
                                            'state'=> function ($query) { $query->select('id', 'name'); },
                                            'city'=> function ($query) { $query->select('id', 'name'); },
                                            'property'=> function ($query) { $query->select('id', 'name'); },
                                            ])
                            ->latest()->get();
            // dd($memberships->toArray());
            // return DataTables::of($memberships)->addIndexColumn()->make(true);
            return DataTables::of($memberships)
            ->addColumn('membership_type_name', function ($membership) {
                return $membership->membershipTypes->name ?? '';
            })
            ->addColumn('hostel_name', function ($membership) {
                return $membership->property->name ?? '';
            })
            ->editColumn('referal_cnic', function ($membership) {
                return $membership->referal_cnic ?? 'NULL';
            })
            ->editColumn('gender', function ($membership) {
                return ucfirst($membership->gender); // ucfirst() capitalizes the first letter
            })
            ->editColumn('previous_hostel', function ($membership) {
                return $membership->previous_hostel ?? 'NULL';
            })
            ->editColumn('country_name', function ($membership) {
                return ($membership->country)->name ?? 'N/A';
            })
            ->editColumn('state_name', function ($membership) {
                return ($membership->state)->name ?? 'N/A';
            })
            ->editColumn('city_name', function ($membership) {
                return ($membership->city)->name ?? 'N/A';
            })
            ->addIndexColumn()
            ->make(true);
        }
        return abort(403, 'Unathorized action');
    }

    // 
    public function editMemebershipView($id){
        // 
        // return "Yes";
        return view('admin.edit-membership')->with(['id'=>$id]);
    }
}
