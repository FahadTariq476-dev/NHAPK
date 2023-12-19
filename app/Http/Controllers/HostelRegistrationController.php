<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\Properties;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertiesMetas;
use App\Models\PropertiesWarden;
use App\Models\PropertiesAddress;
use App\Models\PropertiesPartner;
use Illuminate\Support\Facades\Hash;

class HostelRegistrationController extends Controller
{
    //

    // Begin: Function to load the save hostel register form
    public function saveHostel(Request $req){  
        $countries = Country::all();
        $categories = Category::all();  // Hostel Categories
        $property_types = PropertyType::all();      // Hostel Property Types
        // return view('hostelregistration')
        return view('frontEnd.hostel.register-hostel')
        ->with(['countries' => $countries,
                'categories' => $categories,
                'property_types' => $property_types
            ]);
    }
    // End: Function to load the save hostel register form
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

    public function hostelPartnerCnicCheck($hostelPartnerCnic){
        $result = User::where('cnic_no',$hostelPartnerCnic)->first();
        if($result){
            // Check the partner is registered with any hostel or not
            $author_id = $result->id;
            $properties_partner_checkAuthorId = PropertiesPartner::where('author_id',$author_id)->get();
            if(count($properties_partner_checkAuthorId)>0){
                return 0;
            }
            else{
                return 1;
            }
        }
        else{
            return -1;      //It Means that Partner is New it's account should be created
        }
    }

    public function hostelWaardenCnicCheck($hostelWardenCnic){
        $result = User::where('cnic_no',$hostelWardenCnic)->first();
        if($result){
            //  Check the warden is registered with any hostel or not
            $author_id = $result->id;
            $properties_warden_chechAuthorId = PropertiesWarden::where('author_id',$author_id)->get();
            if(count($properties_warden_chechAuthorId)>0){
                return 0;
            }
            else{
                return 1;
            }
        }
        else{
            return -1;       //  It means that Hostel Warden is new it's account should be created
        }
    }

    //
    public function hostelNameCheck($hostelName){
        //
        $result = Properties::where('name',$hostelName)->get();
        if(count($result)>0){
            return 1;   // 1 means true. It means that hostel already exist with the same name
        }
        else{
            return 0;   // 0 means false. It means that hostel doesn't exist with this name
        }
        // dd($result);
    }
    
    public function hostelRegister(Request $req){
        //
        // dd($req->toArray());
        $newHostelOwner ="";
        $hostelOwner="";
        $newHostelPartner="";
        $newHostelWarden="";
        $rules = [
            'country_id' => 'required|exists:countries,id',
            'states_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'hostelLocation' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'hostelOwnerName' => 'required|string|max:255',
            'hostelOwnerContact' => 'required|regex:/^[0-9]{9}$/',
            'totalRooms' => 'required|integer|min:1',
            'room_occupany' => 'required|integer|min:1',
            'hostelGender' => 'required|in:male,female',
            'hostelType' => 'required|exists:property_type,id',
            'hostelName'=> 'required|string|max:255|unique:properties,name',
            'hostelAddress' =>'required',
            'hostelContactNumber' =>'required|regex:/^[0-9]{9}$/',
            'hostelCategories'=>'required|exists:categories,id',
            'terms' => 'required|accepted', // Added rule for terms checkbox
            'slip_image' => 'image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048',
            'hostel_images.*' => 'image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048',
        ];
        if(!empty($req->referalCNIC) && strlen($req->referalCNIC)>0){
            $rules['referalCNIC']='required|max:15|min:15|exists:user,cnic_no';
        }
        if(!empty($req->hostelOwnerCnic) && strlen($req->hostelOwnerCnic)==15){
            $hostelOwnerCnicCheck = User::where('cnic_no',$req->hostelOwnerCnic)->get();
            if(count($hostelOwnerCnicCheck)>0){
                // 
                $author_id = $hostelOwnerCnicCheck[0]->id;
                $author_id_checksFromProperties = Properties::where('author_id',$hostelOwnerCnicCheck[0]->id)->get();
                if(count($author_id_checksFromProperties)>0){
                    return redirect()->route('saveHostelForm')->with('error', 'Hostel Owner Cnic is already registered with this cnic.');
                }
                $hostelOwner="Yes";
            }
            else{
                if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $req->hostelOwnerEmail)) {
                    // Invalid email format\
                    return redirect()->route('saveHostelForm')->with('error', 'Hostel Owner Invalid email format. Please provide a valid email address.');
                }
                else if(count(User::where('email',$req->hostelOwnerEmail)->get())>0){
                    return redirect()->route('saveHostelForm')->with('error','Hostel Owner email should be unique. Try with correct data');
                }
                $newHostelOwner="Yes";
            }
        }
        else{
            $rules['hostelOwnerCnic'] ='required|max:15|min:15';
        }

        // To Check the Hostel partner Details
        $hostelPartnerName=$req->hostelPartnerName;
        if(!empty($hostelPartnerName) && strlen($hostelPartnerName)>2){
            $partnerContact = $req->partnerContact;

            // Check if the length is 9
            if (strlen($partnerContact) != 9) {
                return redirect()->route('saveHostelForm')->with('error', 'Partner Contact Number should be 9 digits long. Try with correct data');
            }else{
                // Check if the phone number contains only digits (0-9)
                if (!preg_match('/^[0-9]+$/', $partnerContact)) {
                    return redirect()->route('saveHostelForm')->with('error', 'Partner Contact Number should be given with digits only. Try with correct data');
                }
            }

            if(strlen($req->partnerCnic)==15){
                $partnerCnicCheck = User::where('cnic_no',$req->hostelOwnerCnic)->get();
                if(count($partnerCnicCheck)>0){
                    // 
                    $newHostelPartner="No";
                }else{
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $req->hostelPartnerEmail)) {
                        // Invalid email format
                        return redirect()->route('saveHostelForm')->with('error', 'Hostel Partner Invalid email format. Please provide a valid email address.');
                    }
                    else if(count(User::where('email',$req->hostelPartnerEmail)->get())>0){
                        return redirect()->route('saveHostelForm')->with('error','Partner email should be unique. Try with correct data');
                    }
                    $newHostelPartner="Yes";
                }
            }
            else{
                return redirect()->route('saveHostelForm')->with('error','Partner Cnic should be given. Try with correct data');
            }
            $hostelPartnerDetails="Yes";
        }else{
            $hostelPartnerDetails="No";
        }

        // To Check the Hostel warden Details
        $hostelWardenName=$req->hostelWardenName;
        if(!empty($hostelWardenName) && strlen($hostelWardenName)>2){
            $hostelWardenContact = $req->hostelWardenContact;

            // Check if the length is 9
            if (strlen($hostelWardenContact) != 9) {
                return redirect()->route('saveHostelForm')->with('error', 'Warden Contact Number should be 9 digits long. Try with correct data');
            }else{
                // Check if the phone number contains only digits (0-9)
                if (!preg_match('/^[0-9]+$/', $hostelWardenContact)) {
                    return redirect()->route('saveHostelForm')->with('error', 'Warden Contact Number should be given with digits only. Try with correct data');
                }
            }

            if(strlen($req->hostelWardenCnic)==15){
                $hostelWardenCnicCheck = User::where('cnic_no',$req->hostelWardenCnic)->get();
                if(count($hostelWardenCnicCheck)>0){
                    // 
                    $newHostelWarden="No";
                }else{
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $req->hostelWardenEmail)) {
                        // Invalid email format
                        return redirect()->route('saveHostelForm')->with('error', 'Warden Invalid email format. Please provide a valid email address.');
                    }
                    else if(count(User::where('email',$req->hostelWardenEmail)->get())>0){
                        return redirect()->route('saveHostelForm')->with('error','Warden email should be unique. Try with correct data');
                    }
                    $newHostelWarden="Yes";
                }
            }
            else{
                return redirect()->route('saveHostelForm')->with('error','Partner Cnic should be given. Try with correct data');
            }
            $hostelWardenDetails="Yes";
        }
        else{
            $hostelWardenDetails="No";
        }
        echo $hostelPartnerDetails;
        echo "& Warden details is";
        echo $hostelWardenDetails;
        // return "yues";



        $this->validate($req, $rules);
        
        // return "Yes";
        if($newHostelOwner=="Yes"){
            // 
            $newHostelOwneruser = new User();
            $newHostelOwneruser->name = $req->hostelOwnerName;;
            $newHostelOwneruser->email = $req->hostelOwnerEmail;
            $newHostelOwneruser->cnic_no = $req->hostelOwnerCnic;
            $newHostelOwneruser->phone_number = "+923".$req->hostelOwnerContact;
            $newHostelOwneruser->nhapk_register = 1;
            $newHostelOwneruser->password = Hash::make('12345678');
            if(!($newHostelOwneruser->save())){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel owner kidnly try again.');
            }
            $newHostelOwneruser->assignRole("hostel_owner");
            $newHostelOwneruser_author_id = $newHostelOwneruser->id;

            if($newHostelPartner=="Yes"){
                // 
                $newHostelPartneruser = new User();
                $newHostelPartneruser->name = $hostelPartnerName;
                $newHostelPartneruser->email = $req->hostelPartnerEmail;
                $newHostelPartneruser->cnic_no = $req->partnerCnic;
                $newHostelPartneruser->phone_number = "+923".$partnerContact;
                $newHostelPartneruser->nhapk_register = 1;
                $newHostelPartneruser->password = Hash::make('12345678');
                if(!($newHostelPartneruser->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel partner kidnly try again.');
                }
                $newHostelPartner_author_id = $newHostelPartneruser->id;
                $newHostelPartneruser->assignRole("user");
            }
            if($newHostelWarden=="Yes"){
                // 
                $newHostelWardenuser = new User();
                $newHostelWardenuser->name = $hostelWardenName;
                $newHostelWardenuser->email = $req->hostelWardenEmail;
                $newHostelWardenuser->cnic_no = $req->hostelWardenCnic;
                $newHostelWardenuser->phone_number = "+923".$hostelWardenContact;
                $newHostelWardenuser->nhapk_register = 1;
                $newHostelWardenuser->password = Hash::make('12345678');
                if(!($newHostelWardenuser->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel warden kidnly try again.');
                }
                $newHostelWarden_author_id = $newHostelWardenuser->id;
                $newHostelWardenuser->assignRole("staff");
            }
            
            
            $timestamp = now()->timestamp;
            // Begin: To save the image
            $imageFileName = $timestamp . '.' . $req->file('image')->getClientOriginalExtension();
            // Store the images in the 'public/blog-images/image' folder
            $imagePath = "storage/uploads/".$imageFileName;
            $req->file('image')->storeAs('public/uploads', $imageFileName);
            // End: To save the image

            // Generate the initial slug from the title
            $slug = Str::slug($req->hostelName);

            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);

            // Save the data into the properties table
            $properties = new Properties();
            $properties->name = $req->hostelName;
            $properties->location = $req->hostelLocation;
            $properties->images = $imagePath;
            $properties->number_bedroom = $req->totalRooms;
            $properties->city_id = $req->city_id;
            $properties->state_id = $req->states_id;
            $properties->author_id = $newHostelOwneruser_author_id;
            $properties->author_type = "hostel_owner";
            $properties->category_id = $req->hostelCategories;
            $properties->latitude = $req->latitude;
            $properties->longitude = $req->longitude;
            $properties->slug = $uniqueSlug;
            $properties->nhapk_register = 1;
            if(!$properties->save()){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel kidnly try again.');
            }
            $properties_id = $properties->id;
            // Save the data into the Properties_Addresses Table
            $properties_addresses = new PropertiesAddress();
            $properties_addresses->property_id = $properties_id;
            $properties_addresses->address = $req->hostelAddress;
            $properties_addresses->city_id = $req->city_id;
            $properties_addresses->state_id = $req->states_id;
            $properties_addresses->country_id = $req->country_id;
            $properties_addresses->latitude = $req->latitude;
            $properties_addresses->longitude = $req->longitude;
            if(!($properties_addresses->save())){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties address kidnly try again.');
            }
            // Save the Properties_Metas Table
            $properties_metas = new PropertiesMetas();
            $properties_metas->property_id =$properties_id;
            $properties_metas->hostel_for = $req->hostelGender;
            $properties_metas->property_type = $req->hostelType;
            $properties_metas->total_room = $req->totalRooms;
            $properties_metas->contact_number = "+923".$req->hostelContactNumber;
            $properties_metas->location = $req->hostelLocation;
            $properties_metas->map_location = $req->hostelLocation;
            $properties_metas->room_occupany = $req->room_occupany;
            if(!($properties_metas->save())){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties metas kidnly try again.');
            }
            if($hostelPartnerDetails=="Yes"){
                // 
                $properties_partner = new PropertiesPartner();
                $properties_partner ->properties_id = $properties_id;
                if($newHostelPartner=="Yes"){
                    // 
                    $properties_partner->author_id = $newHostelPartner_author_id;
                }
                else if($newHostelPartner=="No"){
                    // 
                    $properties_partner->author_id = $partnerCnicCheck[0]->id;
                }
                if(!($properties_partner->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties_partner kidnly try again.');
                }
            }
            if($hostelWardenDetails=="Yes"){
                // 
                // return "Hello from here";
                // Code to insert data into warden table
                $properties_warden = new PropertiesWarden();
                $properties_warden->properties_id = $properties_id;
                if($newHostelWarden=="Yes"){
                    // 
                    $properties_warden->author_id = $newHostelWarden_author_id;
                }
                else if($newHostelWarden=="No"){
                    // 
                    $properties_warden->author_id = $hostelWardenCnicCheck[0]->id;
                }
                if(!($properties_warden->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties_warden kidnly try again.');
                }
            }
            return redirect()->route('saveHostelForm')->with('success','Hostel Registered Now.');
        }
        // return "Yes2";
        // If hosel onwe is registered already
        if($hostelOwner=="Yes"){
            // 
            if($newHostelPartner=="Yes"){
                // 
                $newHostelPartneruser = new User();
                $newHostelPartneruser->name = $hostelPartnerName;
                $newHostelPartneruser->email = $req->hostelPartnerEmail;
                $newHostelPartneruser->cnic_no = $req->partnerCnic;
                $newHostelPartneruser->phone_number = "+923".$partnerContact;
                $newHostelPartneruser->nhapk_register = 1;
                $newHostelPartneruser->password = Hash::make('12345678');
                if(!($newHostelPartneruser->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel partner kidnly try again.');
                }
                $newHostelPartner_author_id = $newHostelPartneruser->id;
                $newHostelPartneruser->assignRole("user");
            }
            if($newHostelWarden=="Yes"){
                // 
                $newHostelWardenuser = new User();
                $newHostelWardenuser->name = $hostelWardenName;
                $newHostelWardenuser->email = $req->hostelWardenEmail;
                $newHostelWardenuser->cnic_no = $req->hostelWardenCnic;
                $newHostelWardenuser->phone_number = "+923".$hostelWardenContact;
                $newHostelWardenuser->nhapk_register = 1;
                $newHostelWardenuser->password = Hash::make('12345678');
                if(!($newHostelWardenuser->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel warden kidnly try again.');
                }
                $newHostelWarden_author_id = $newHostelWardenuser->id;
                $newHostelWardenuser->assignRole("staff");
            }
            
            
            $timestamp = now()->timestamp;
            // Begin: To save the image
            $imageFileName = $timestamp . '.' . $req->file('image')->getClientOriginalExtension();
            // Store the images in the 'public/blog-images/image' folder
            $imagePath = "storage/uploads/".$imageFileName;
            $req->file('image')->storeAs('public/uploads', $imageFileName);
            // End: To save the image

            // Generate the initial slug from the title
            $slug = Str::slug($req->hostelName);

            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);

            // Save the data into the properties table
            $properties = new Properties();
            $properties->name = $req->hostelName;
            $properties->location = $req->hostelLocation;
            $properties->images = $imagePath;
            $properties->number_bedroom = $req->totalRooms;
            $properties->city_id = $req->city_id;
            $properties->state_id = $req->states_id;
            $properties->author_id = $hostelOwnerCnicCheck[0]->id;
            $properties->author_type = "hostel_owner";
            $properties->category_id = $req->hostelCategories;
            $properties->latitude = $req->latitude;
            $properties->longitude = $req->longitude;
            $properties->slug = $uniqueSlug;
            $properties->nhapk_register = 1;
            if(!$properties->save()){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the hostel kidnly try again.');
            }
            $properties_id = $properties->id;
            // Save the data into the Properties_Addresses Table
            $properties_addresses = new PropertiesAddress();
            $properties_addresses->property_id = $properties_id;
            $properties_addresses->address = $req->hostelAddress;
            $properties_addresses->city_id = $req->city_id;
            $properties_addresses->state_id = $req->states_id;
            $properties_addresses->country_id = $req->country_id;
            $properties_addresses->latitude = $req->latitude;
            $properties_addresses->longitude = $req->longitude;
            if(!($properties_addresses->save())){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties address kidnly try again.');
            }
            // Save the Properties_Metas Table
            $properties_metas = new PropertiesMetas();
            $properties_metas->property_id =$properties_id;
            $properties_metas->hostel_for = $req->hostelGender;
            $properties_metas->property_type = $req->hostelType;
            $properties_metas->total_room = $req->totalRooms;
            $properties_metas->contact_number = "+923".$req->hostelContactNumber;
            $properties_metas->location = $req->hostelLocation;
            $properties_metas->map_location = $req->hostelLocation;
            $properties_metas->room_occupany = $req->room_occupany;
            if(!($properties_metas->save())){
                return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties metas kidnly try again.');
            }
            if($hostelPartnerDetails=="Yes"){
                // 
                $properties_partner = new PropertiesPartner();
                $properties_partner ->properties_id = $properties_id;
                if($newHostelPartner=="Yes"){
                    // 
                    $properties_partner->author_id = $newHostelPartner_author_id;
                }
                else if($newHostelPartner=="No"){
                    // 
                    $properties_partner->author_id = $partnerCnicCheck[0]->id;
                }
                if(!($properties_partner->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties_partner kidnly try again.');
                }
            }
            if($hostelWardenDetails=="Yes"){
                // 
                // return "Hello from here";
                // Code to insert data into warden table
                $properties_warden = new PropertiesWarden();
                $properties_warden->properties_id = $properties_id;
                if($newHostelWarden=="Yes"){
                    // 
                    $properties_warden->author_id = $newHostelWarden_author_id;
                }
                else if($newHostelWarden=="No"){
                    // 
                    $properties_warden->author_id = $hostelWardenCnicCheck[0]->id;
                }
                if(!($properties_warden->save())){
                    return redirect()->route('saveHostelForm')->with('error','There is a problem while saving the properties_warden kidnly try again.');
                }
            }
            return redirect()->route('saveHostelForm')->with('success','Hostel Registered Now.');
        }
        // 
    }

   

    // Begin: Function to make slug unique
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingNews = Properties::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingNews) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: Function to make slug unique

}
