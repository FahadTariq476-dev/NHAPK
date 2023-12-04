<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\MembershipTypes;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Properties;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;

class MembershipAdminController extends Controller
{
    //
    public function indexMembership(){
        return view('admin.memberships.list-membership');
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
        $memberships = Membership::find($id);
        if(!$memberships){
            return redirect()->route('admin.list-memebership')->with('error',"Kindly use the correct memebership to Edit the record.");
        }
        $countries = Country::select('name','id')->get();
        $membershipTypes = MembershipTypes::all();
        if(empty($memberships->country_id)){
            $states =[];
        }
        else{
            $states = State::where('country_id',$memberships->country_id)->select('name','id')->get();
        }
        if(empty($memberships->states_id)){
            $cities =[];
        }
        else{
            $cities = City::where('states_id',$memberships->states_id)->select('name','id')->get();
        }
        if(empty($memberships->city_id)){
            $properties = Properties::where('id',$memberships->hostelreg_no)->select('name','id')->get();
        }
        else{
            $properties = Properties::where('city_id',$memberships->city_id)->select('name','id')->get();
        }
        
        // dd($cities);
        
        return view('admin.memberships.edit-membership')
            ->with([
                'memberships'=>$memberships,
                'membershipTypes' => $membershipTypes,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
                'cities' => $cities,
                'properties' => $properties,
            ]);
    }

    // 
    public function updateMembership(Request $req){
        dd($req->toArray());
        // Validation rules
        // Common rules
        $commonRules = [
            'name' => 'required|string|max:255',
            'cnic' => 'required|string|size:15|unique:member_ships,cnic', // Added 'unique' rule
            'membershiptype_id' => 'required|exists:membership_types,id',
            'country_id' => 'required|exists:countries,id',
            'states_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'hostelreg_no' => 'required|exists:properties,id',
            'transaction_no' => 'required|unique:member_ships,transaction_no',
            'gender' => 'required|in:male,female',
            'terms' => 'required|accepted', // Added rule for 'terms' checkbox
        ];
        // Add cnic rule conditionally
        
        // Add referal_cnic rule conditionally
        if (!empty($req->referal_cnic)) {
            $commonRules['referal_cnic'] = 'required|string|size:15';
        }

        // Validation messages
        $messages = [
            'cnic.unique' => 'This CNIC is already registered. Kindly provide the new CNIC.',
            'membershiptype_id.exists' => 'Invalid Membership Type is Selected. Kindly select the valid membership type.',
            'country_id.exists' => 'Invalid Country is Selected. Kindly select the valid country.',
            'states_id.exists' => 'Invalid state is Selected. Kindly select the valid state.',
            'city_id.exists' => 'Invalid City is Selected. Kindly select the valid city.',
            'hostelreg_no.unique' => 'Invalid Hostel is Selected. Kindly select the valid hostel.',
            'transaction_no.exists' => 'Invalid Transaction No. Kindly Provide a unique transaction id.',
        ];
        // Validate the request data
        $this->validate($req, $commonRules, $messages);
        // Save the data here
        $membership = new Membership();
        $membership->name = $req->name;
        $membership->cnic = $req->cnic;
        $membership->membershiptype_id = $req->membershiptype_id;
        $membership->hostelreg_no = $req->hostelreg_no;
        if(!empty($req->referal_cnic)){
            $membership->referal_cnic = $req->referal_cnic;
        }
        $membership->transaction_no = $req->transaction_no;
        $membership->gender = $req->gender;
        if(!empty($req->since)){
            $membership->since = $req->since;
        }
        if(!empty($req->previous_hostel)){
            $membership->previous_hostel = $req->previous_hostel;
        }
        $membership->country_id = $req->country_id;
        $membership->states_id = $req->states_id;
        $membership->city_id = $req->city_id;
        $membership->save();
        if (!$membership) {
            return redirect()->route('membershipRegister')->with('error', 'Membership is not created successfully! Kindly try another request.');
        }
        return redirect()->route('membershipRegister')->with('success', 'Membership created successfully!');
        return $req;
    }
}
