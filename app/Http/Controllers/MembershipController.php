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
        // dd($countries->toArray());
        $membershipTypes = MembershipTypes::all();
        // dd($membershipTypes);
        return view('membership')->with([
            'membershipTypes' => $membershipTypes,
            'countries' => $countries,
        ]);
    }

    public function checkTransaction_No($transaction_no){
        $result = Membership::where('transaction_no', $transaction_no)->get();
        if(count($result)>0){
            return 1;   // 1 Means true. Transaction No exist
        }
        else{
            return 0;   // 0 means false. Transaction No doesn't exist
        }
    }

    
    public function addMembership(Request $req) {
        $fields = ['name', 'cnic', 'membershiptype_id', 'hostelreg_no', 'transaction_no', 'gender', 'livingSince'];
        $requiredFields = ['name', 'cnic', 'membershiptype_id', 'hostelreg_no', 'transaction_no', 'gender', 'livingSince'];
    
        foreach ($requiredFields as $field) {
            if (empty($req->$field)) {
                return redirect()->route('membershipRegister')->with('error', 'Please fill in all the required fields.');
            }
        }
    
        $cnic = $req->cnic;
        $referal_cnic = $req->referal_cnic;
    
        if (strlen($cnic) != 15 || strlen($referal_cnic) != 15) {
            return redirect()->route('membershipRegister')->with('error', 'CNIC should be 15 characters long.');
        }
    
        $Check_transaction_no = Membership::where('transaction_no', $req->transaction_no)->count();
        if ($Check_transaction_no > 0) {
            return redirect()->route('membershipRegister')->with('error', "This transaction number ($req->transaction_no) is already used. Kindly use a new transaction no.");
        }
    
        $membershipCnicCount = Membership::where('cnic', $cnic)->count();
        if ($membershipCnicCount > 0) {
            return redirect()->route('membershipRegister')->with('error', "Membership is already registered with this CNIC: $cnic. Kindly use a different CNIC number for registration.");
        }
    
        $result = MembershipTypes::find($req->membershiptype_id);
        if (!$result) {
            return redirect()->route('membershipRegister')->with('error', 'Membership type is not provided correctly. Kindly select the correct membership type.');
        }
    
        $checkHotelreg_no = Properties::find($req->hostelreg_no);
        if (!$checkHotelreg_no) {
            return redirect()->route('membershipRegister')->with('error', "Given Hostel Registration Number: $req->hostelreg_no is not correct. Kindly provide the correct Hostel Registration Number.");
        }
    
        $data = [
            'name' => $req->name,
            'cnic' => $cnic,
            'membershiptype_id' => $req->membershiptype_id,
            'hostelreg_no' => $req->hostelreg_no,
            'referal_cnic' => $referal_cnic,
            'transaction_no' => $req->transaction_no,
            'gender' => $req->gender,
            'since' => $req->livingSince,
            'previous_hostel' => $req->previous_hostel
        ];
    
        $membership = Membership::create($data);
    
        if (!$membership) {
            return redirect()->route('membershipRegister')->with('error', 'Membership is not created successfully! Kindly try another request.');
        }
    
        return redirect()->route('membershipRegister')->with('success', 'Membership created successfully!');
    }
    
    public function saveHostel(Request $req){  
        $countries = Country::all();
        $categories = Category::all();  // Hostel Categories
        $property_types = PropertyType::all();      // Hostel Property Types
        return view('hostelregistration')
        ->with(['countries' => $countries,
                'categories' => $categories,
                'property_types' => $property_types
            ]);
    }
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
