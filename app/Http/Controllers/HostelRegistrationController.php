<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HostelRegistrationController extends Controller
{
    //
    public function hostelOwnerCniccheck($hostelOwnerCnic){
        // 
        $result = User::where('cnic_no', $hostelOwnerCnic)->first();

        if ($result) {
            // Check if the user was found
            $author_id = $result->id;
            // echo $author_id;
            $property_checkAuhtorId = Properties::where('author_id',$author_id)->get();
            if($property_checkAuhtorId){
                return 0;
            }
            else{
                return 1;
            }
        } else {
            // Handle the case where no user is found with the specified CNIC
            return 1;
        }
    }

    //
    public function hostelNameCheck($hostelName){
        //
        $result = Properties::where('name',$hostelName)->get();
        if(count($result)>0){
            return 0;
        }
        else{
            return 1;
        }
        // dd($result);
    }
    public function hostelRegister(Request $req){
        //
        $hostelOwnerCnic = $req->hostelOwnerCnic;
        $hostelName = $req->hostelName;
        $countries_id = $req->countries;
        $states_id  = $req->states;
        $cities_id  = $req->cities;
        $hostelLocation  = $req->hostelLocation;
        $hostelOwnerName  = $req->hostelOwnerName;
        $hostelOwnerContact  = $req->hostelOwnerContact;
        $totalRooms  = $req->totalRooms;
        $hostelGender  = $req->hostelGender;
        $hostelType_id  = $req->hostelType;
        $hostelAddress  = $req->hostelAddress;
        $hostelContactNumber  = $req->hostelContactNumber;
        $hostelLandLine  = $req->hostelLandLine;
        $hostelPartnerName  = $req->hostelPartnerName;
        $partnerContact  = $req->partnerContact;
        $partnerCnic  = $req->partnerCnic;
        $hostelWardenName  = $req->hostelWardenName;
        $hostelWardenContact  = $req->hostelWardenContact;
        $hostelWardenCnic  = $req->hostelWardenCnic;
        $referalCNIC  = $req->referalCNIC;
        $terms  = $req->terms;
        $hostelCategories_id  = $req->hostelCategories;
        $imageName ='';
        // First of all we check that if Hostel Owner CNIC does not Exist then we ask them to login first
        $resultChkCNIC = User::where('cnic_no', $hostelOwnerCnic)->first();
        if ($resultChkCNIC) {
            // Check if the user was found
            $author_id = $resultChkCNIC->id;
            $author_type = '';
            $property_checkAuhtorId = Properties::where('author_id',$author_id)->get();
            if($property_checkAuhtorId){
                echo "Hostel is already registered with this CNIC";
                return;
            }
        } else {
            // Handle the case where no user is found with the specified CNIC
            echo "CNIC doesn't Exist kindly register the hostel owner account first";
            return;
        }
        // First of all we check that if Hostel Owner CNIC does not Exist then we ask them to login first (Close Now)

        // Secondly we check the Hostel Name
        $resultChkHostelName = HostelRegistrationController::hostelNameCheck($hostelName);
        if($resultChkHostelName==0){
            echo "Hostel Name already exist Kindly use the Different Name";
            return;
        }
        // Secondly we check the Hostel Name
        
        $data_properties=[
            'name' =>$hostelName,
            'location' =>$hostelLocation,
            'images' =>$imageName, 
            'number_bedroom' =>$totalRooms,
            'city_id' =>$cities_id,
            'author_id' =>$author_id,
            'author_type' =>$author_type,
            'category_id' =>$hostelCategories_id,
            'latitude' => 0, 
            'longitude'>0,
        ];
        $properties = Properties::create($data_properties);
        $properties_id = $properties->id;
        
            
        // hostelOwnerCniccheck($hostelOwnerCnic);
        dd($req->toArray());
        return $req;
    }
}
