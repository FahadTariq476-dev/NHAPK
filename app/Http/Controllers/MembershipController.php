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
        $countries = Country::all();
        $membershipTypes = MembershipTypes::all();
        // dd($membershipTypes);
        return view('membership')->with([
            'membershipTypes' => $membershipTypes,
            'countries' => $countries,
        ]);
    }
    public function addMembership(Request $req){
        $name = $req->name;
        $cnic = $req->cnic;
        $membership_typeId = $req->membershiptype_id;
        $hostelreg_no = $req->hostelreg_no;
        $referal_cnic = $req->referal_cnic;
        $transaction_no = $req->transaction_no;
        $gender = $req->gender;
        $livingSince = $req->livingSince;
        $previous_hostel = $req->previous_hostel;
        
        $membershipCnic = Membership::where('cnic',$cnic)->get();
        // dd($membershipCnic);
        if(count($membershipCnic)>0){
            echo "CNIC Number already exist";
            return;
        }
        else{
            $result = MembershipTypes::find($membership_typeId);
            // return $result;
            // dd($result);
            if($result){
                $checkHotelreg_no = Properties::find($hostelreg_no);
                if($checkHotelreg_no){
                    echo "Yes hostel registration number is corret";
                    $data = [
                        'name' => $name,
                        'cnic' => $cnic,
                        'membershiptype_id' => $membership_typeId,
                        'hostelreg_no' => $hostelreg_no,
                        'referal_cnic' => $referal_cnic,
                        'transaction_no' => $transaction_no, 
                        'gender' => $gender,
                        'since' => $livingSince,
                        'previous_hostel' => $previous_hostel
                    ];
                    $membership = Membership::create($data);
                    return redirect()->route('membershipRegister')->with('success', 'Membership created successfully!');
                    // return response()->json($membership, 201);
                }
                else{
                    echo "Given Hostel Registration Number is Not Correct. Kindly! Provide The Correct Number";
                    return;
                }
            }
            else{
                echo "Select the Correct Membership Types";
                return;
            }
            // dd($req->toArray());
            // return "hy";
        }
        
    }
    public function saveHostel(Request $req){  
        $countries = Country::all();
        $categories = Category::all();
        return view('hostelregistration')->with(['countries'=>$countries,'categories'=>$categories]);
    }
}
