<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\MembershipTypes;
use App\Models\Properties;
use App\Models\PropertyType;

class MembershipController extends Controller
{
    
    public function show(){
        // 
        $countries = Country::select('name','id')->get();
        $membershipTypes = MembershipTypes::all();
        return view('frontEnd.membership.post-membership')->with([
            'membershipTypes' => $membershipTypes,
            'countries' => $countries,
        ]);
    }

    // Function verfiy the unique transactio
    public function checkTransaction_No($transaction_no){
        $result = Membership::where('transaction_no', $transaction_no)->get();
        if(count($result)>0){
            return 1;   // 1 Means true. Transaction No exist
        }
        else{
            return 0;   // 0 means false. Transaction No doesn't exist
        }
    }

    // Function to save membership from the frontEnd
    public function addMembership(Request $req) {
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
        // dd($req->toArray());
        // Save the data here
        $membership = new Membership();
        $membership->name = $req->name;
        $membership->cnic = $req->cnic;
        $membership->membershiptype_id = $req->membershiptype_id;
        $membership->hostelreg_no = $req->hostelreg_no;
        $membership->gender = $req->gender;
        if(!empty($req->referal_cnic)){
            $membership->referal_cnic = $req->referal_cnic;
        }
        $membership->transaction_no = $req->transaction_no;
        if(!empty($req->since)){
            $membership->since = $req->since;
        }else{
            $membership->since = now();
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
    }
    
    

    // Function to verify the unqiue CNIC number for memebrship
    public function chkMembershipCNIC($cnic){
        $result = Membership::where('cnic',$cnic)->get();
        if(count($result)>0){
            return 1;       // It means CNIC exist   
        }
        else{
            return 0;       // It means CNIC doesn't exist
        }
    }
    
}
