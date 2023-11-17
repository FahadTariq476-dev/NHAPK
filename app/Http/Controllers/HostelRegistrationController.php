<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Properties;
use App\Models\PropertiesAddress;
use App\Models\PropertiesMetas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            if(count($property_checkAuhtorId)>0){
                return 0;
            }
            else{
                return 1;
            }
        } else {
            // Handle the case where no user is found with the specified CNIC
            return -1;
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
        $author_id = '';
        $hostelOwnerCnic = $req->hostelOwnerCnic;
        $hostelName = $req->hostelName;
        $countries_id = $req->countries;
        $states_id  = $req->states;
        $cities_id  = $req->cities;
        $hostelLocation  = $req->hostelLocation;
        $latitude = $req->latitude;
        $longitude = $req->longitude;
        $hostelOwnerName  = $req->hostelOwnerName;
        $hostelOwnerContact  = $req->hostelOwnerContact;
        $hostelOwnerEmail = $req->hostelOwnerEmail;
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
        $hostelGender = $req->hostelGender;
        $image = $req->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();

        // Secondly we check the Hostel Name
        $resultChkHostelName = HostelRegistrationController::hostelNameCheck($hostelName);
        if($resultChkHostelName==0){
            echo "Hostel Name already exist Kindly use the Different Name";
            return;
        }
        // Secondly we check the Hostel Name
        // First of all we check that if Hostel Owner CNIC does not Exist then we ask them to login first
        $resultChkCNIC = User::where('cnic_no', $hostelOwnerCnic)->first();
        if ($resultChkCNIC) {
            // Check if the user was found
            $author_id = $resultChkCNIC->id;
            $property_checkAuhtorId = Properties::where('author_id',$author_id)->get();
            if(count($property_checkAuhtorId)>0){
                return "Hostel is already registered with this CNIC";
            }
        } else {
            // Handle the case where no user is found with the specified CNIC
            $user = new User();
            $user->name = $hostelOwnerName;
            $user->email = $hostelOwnerEmail;
            $user->cnic_no = $hostelOwnerCnic;
            $user->phone_number = $hostelOwnerContact;
            $user->password = Hash::make('123456');
            if(!($user->save())){
                return "User Not Saved";
            }
            $author_id = $user->id;
        }
        // First of all we check that if Hostel Owner CNIC does not Exist then we ask them to login first (Close Now)

        // Save the data into the properties table
        $properties = new Properties();
        $properties->name = $hostelName;
        $properties->location = $hostelLocation;
        $properties->images = $filename;
        $properties->number_bedroom = $totalRooms;
        $properties->city_id = $cities_id;
        $properties->author_id = $author_id;
        $properties->category_id = $hostelCategories_id;
        $properties->latitude = $latitude;
        $properties->longitude = $longitude;
        $properties->nhapk_register = 1;
        if(!$properties->save()){
            return "Hostel is not Registere";
        }
        $properties_id = $properties->id;
        $image->storeAs('uploads', $filename, 'public');
        echo "Data save to property table";
        // Save the data into the Properties_Addresses Table
        $properties_addresses = new PropertiesAddress();
        $properties_addresses->property_id = $properties_id;
        $properties_addresses->address = $hostelAddress;
        $properties_addresses->city_id = $cities_id;
        $properties_addresses->state_id = $states_id;
        $properties_addresses->country_id = $countries_id;
        $properties_addresses->latitude = $latitude;
        $properties_addresses->longitude = $longitude;
        if(!($properties_addresses->save())){
            return "Poperties_address is not saved";
        }
        echo "Data save to property_addresses table";
        // Save the Properties_Metas Table
        $properties_metas = new PropertiesMetas();
        $properties_metas->property_id =$properties_id;
        $properties_metas->hostel_for = $hostelGender;
        $properties_metas->property_type = $hostelCategories_id;
        $properties_metas->total_room = $totalRooms;
        $properties_metas->contact_number = $hostelContactNumber;
        $properties_metas->location = $hostelLocation;
        if(!($properties_metas->save())){
            return "Properties_meta is not saved";
        }
        echo "Data save to property-metas";
        return redirect()->route('saveHostelForm')->with('success', 'Hostel Registered Successfully!');
    }
}
