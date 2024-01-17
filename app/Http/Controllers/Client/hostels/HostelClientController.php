<?php

namespace App\Http\Controllers\client\hostels;

use Exception;
use App\Models\Tag;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Luxury;
use App\Models\Amenity;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Membership;
use App\Models\Properties;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\MembershipTypes;
use App\Models\PropertiesMetas;
use Illuminate\Validation\Rule;
use App\Models\PropertiesWarden;
use App\Models\PropertiesAddress;
use App\Models\PropertiesPartner;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class HostelClientController extends Controller
{
    //
    /**
     * Function to Show post-hostel.bladephp
    */
    public function index(){
        try{
            $countries = Country::all();
            $categories = Category::all();  // Hostel Categories
            $property_types = PropertyType::all();      // Hostel Property Types
            $amenities = Amenity::get();    // amenities
            $luxuries = Luxury::get();      // luxuries
            $features = Feature::get();      // features
            $facilities = Facility::get();  // facilities
            $membershipTypes = MembershipTypes::all();  // membershipTypes
            $tags = Tag::all();     // Tags

            $userMembership = Auth::user();
            $memberships = Membership::where('cnic',$userMembership->cnic_no)->get();
            // dd($memberships);
            $membershipExistence="";
            if(count($memberships)>0){
                $membershipExistence="Yes";
                return view('client.hostel.post-hostel') 
                    ->with(['countries' => $countries,
                        'categories' => $categories,
                        'property_types' => $property_types,
                        'amenities' => $amenities,
                        'luxuries' => $luxuries,
                        'features' => $features,
                        'facilities' => $facilities,
                        'tags' => $tags,
                        'membershipExistence' => $membershipExistence,
                ]);
            }

            $membershipExistence="No";
            return view('client.hostel.post-hostel') 
                ->with(['countries' => $countries,
                    'categories' => $categories,
                    'property_types' => $property_types,
                    'amenities' => $amenities,
                    'luxuries' => $luxuries,
                    'features' => $features,
                    'facilities' => $facilities,
                    'tags' => $tags,
                    'membershipTypes' => $membershipTypes,
                    'membershipExistence' => $membershipExistence,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    /**
     * Function to Show the list of hostel 
    */ 
    public function listHostels(Request $request){
        if($request->ajax()){
            $authorId = Auth::user()->id;
            $data = Properties::with('category')
            ->where('author_id', $authorId)
            ->get();

            return Datatables::of($data)
                ->addColumn('category_name', function ($property) {
                    return $property->category ? $property->category->name : 'N/A';
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('client.hostel.list-hostel');   
    }
    /**
     * Function to edit hostel
    */
    public function editHostel($hostelId){
        try{
            // 
            $properties=Properties::where('id', $hostelId)->where('author_id',Auth::user()->id)->first();
            // dd($properties);
            $hostelStateId = $properties->state_id;
            if($properties){
                $countries = Country::all();    // Countries
                $states = State::all();    // states
                $cities = City::where('states_id',$hostelStateId)->get();    // cities
                $categories = Category::all();  // Hostel Categories
                $property_types = PropertyType::all();      // Hostel Property Types
                $amenities = Amenity::all();    // amenities
                $luxuries = Luxury::all();      // luxuries
                $features = Feature::all();      // features
                $facilities = Facility::all();  // facilities
                $tags = Tag::all();     // Tags
                return view('client.hostel.edit-hostel')
                ->with(['countries' => $countries,
                        'states' => $states,
                        'cities' => $cities,
                        'categories' => $categories,
                        'property_types' => $property_types,
                        'amenities' => $amenities,
                        'luxuries' => $luxuries,
                        'features' => $features,
                        'facilities' => $facilities,
                        'tags' => $tags,
                        'properties' => $properties,
                ]);
            }
            return redirect()->back()->with('invalid','You are accessing invalid Hostel. Kindly access the valid one.');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    
    /**
     * Function to Show store hostel & properties_address
    */
    public function storeHostel(Request $request){
        try{
            
            $rules = [
                'hostelName'=> 'required|string|max:255|min:3|unique:properties,name',
                'hostelDescription'=> 'required|string|max:400|min:3',
                'hostelCountryId' => 'required|exists:countries,id',
                'hostelStatesId' => 'required|exists:states,id',
                'hostelCityId' => 'required|exists:cities,id',
                'hostelTotalRooms' => 'required|integer|min:1',
                'hostelBathRooms' => 'required|integer|min:1',
                'hostelLocation' => 'required|string',
                'latitude' => 'required',
                'longitude' => 'required',
                'hostelAddress'=> 'required|string|max:500|min:3',
                'hostelZipCode'=> 'required|string',
                'hostelNearestLandmark'=> 'required|string|max:255|min:3',
                'hostelTotalFloors' => 'required|integer|min:1',
                'hostelCategoryId'=>'required|exists:categories,id',
                'hostelImages.*' => 'image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048',
                'hostelSlogan'=> 'required|string|max:255|min:3',
                'hostelGender'=> 'required|in:male,female',
                'hostelStayType'=> 'required|in:short_stay,long_stay',
                'hostelGuestStayAllow'=> 'required|in:Yes,No',
                'hostelRentPaySchedule'=> 'required|in:Daily,Weekly,Monthly,Quarterly,Yearly',
                'hostelTypeId'=> 'required|exists:property_type,id',
                'hostelAvgRentPerMonth'=> 'required',
                'hostelRoomOccupancy' => 'required|integer|min:1',
                'hostelRecommendedPlace'=> 'required|string|max:255|min:3',
                'hostelContactNumber' => 'required|numeric|digits:10|regex:/^3\d{9}$/',
                'hostelOpenTiming' => 'required',
                'hostelCloseTiming' => 'required',
                'hostelYoutubeLink' => 'nullable|url',
                'hostelFacebookLink' => 'nullable|url',
                'hostelInstagramLink' => 'nullable|url',
                'hostelAreaName' => 'required|string',
                'hostelPlotNo' => 'required|string',
                'hostelStreetNo' => 'required|string',
                'hostelMapLocation' => 'required|url',
                'hostelMess' => 'required|in:available,unavailable',
                'hostelMessType' => 'required_if:hostelMess,available|in:one_time_mess,two_time_mess,three_time_mess,buffay_time_mess',
                'hostelUtilityBills' => 'required|in:included_in_rent,not_included_in_rent',
                'hostelSecuritySystem' => 'required|in:cctv,bio_metric,face_recognizer',
                'hostelSecurityGuard' => 'required|in:24/7,day_time,night_watchman',
                'hostelDoormanType' => 'required|in:male,female',
                'hostelDoormanAvailability' => 'required|in:day_time,IoT_Device',
                'hostelParkingAvailability' => 'required|in:indoor,outdoor',
                'hostelMadeType' => 'required|in:male,female',
                'hostelMadeAvailability' => 'required|in:24/7,office_time', 
                'hostelWardenType' => 'required|in:male,female',
                'hostelWardenAvailability' => 'required|in:24/7,office_time',
                'hostelCommonRoomAvailability' => 'required|in:24/7,n/a',
                'hostelStudyRoomAvailability' => 'required|in:24/7,n/a',
                'hostelPrayerArea' => 'required|in:yes,no',
                'hostelCanteenAvailability' => 'required|in:stand_alone,attached,inside,outside,online,pos,n/a',
                'partnerCnicRadio' => 'required|in:Yes,No',
                'wardenCnicRadio' => 'required|in:Yes,No',
                'tags' => 'nullable|array',
                'tags.*' => 'sometimes|exists:tags,id',
                'features' => 'nullable|array',
                'features.*' => 'sometimes|exists:features,id',
                'facilities' => 'nullable|array',
                'facilities.*' => 'sometimes|exists:facilities,id',
                'amenities' => 'nullable|array',
                'amenities.*' => 'sometimes|exists:amenities,id',
                'luxuries' => 'nullable|array',
                'luxuries.*' => 'sometimes|exists:luxuries,id',
            ];
            $partnerAvailability = "";
            if($request->partnerCnicRadio == "Yes"){
                $partnerCnicCheck = $request->partnerCnicCheck;

                if (strlen($partnerCnicCheck) === 15) {
                    $usersPartner = User::where('cnic_no',$request->partnerCnicCheck)->get();
                    if(count($usersPartner)>0){
                        // it means use is exist then check it's author id
                        $rules['partnerAuthorId'] = 'required|exists:users,id';
                        $partnerAvailability="Old";
                    }
                    else{
                        // It means user is new and id card is unique
                        $rules['partnerFirstName'] = 'required|string|min:3|max:255';
                        $rules['partnerLastName'] = 'required|string|max:255';
                        $rules['partnerEmail'] = 'required|email|unique:users,email';
                        $rules['partnerMobileNumber'] = [
                            'required',
                            'numeric',
                            'digits:10',
                            'regex:/^3\d{9}$/',
                            Rule::unique('users', 'phone_number')->where(function ($query) use ($request) {
                                // Customize the condition to match your database structure
                                $query->where('phone_number', '+92' . $request->partnerMobileNumber);
                            }),
                        ];
                        $partnerAvailability="New";
                    }
                } else {
                    $rules['partnerCnicCheck'] = 'required|numeric|digits:15';
                }
            }
            $wardenAvailability = "";
            if($request->wardenCnicRadio == "Yes"){
                $wardenCnicCheck = $request->wardenCnicCheck;

                if (strlen($wardenCnicCheck) === 15) {
                    $usersWarden = User::where('cnic_no',$request->wardenCnicCheck)->get();
                    if(count($usersWarden)>0){
                        // it means use is exist then check it's author id
                        $rules['wardenAuthorId'] = 'required|exists:users,id';
                        $wardenAvailability = "Old";
                    }
                    else{
                        // It means user is new and id card is unique
                        $rules['wardenFirstName'] = 'required|string|min:3|max:255';
                        $rules['wardenLastName'] = 'required|string|max:255';
                        $rules['wardenEmail'] = 'required|email|unique:users,email';
                        $rules['wardenMobileNumber'] = [
                            'required',
                            'numeric',
                            'digits:10',
                            'regex:/^3\d{9}$/',
                            Rule::unique('users', 'phone_number')->where(function ($query) use ($request) {
                                // Customize the condition to match your database structure
                                $query->where('phone_number', '+92' . $request->wardenMobileNumber);
                            }),
                        ];
                        $wardenAvailability = "New";
                    }
                } else {
                    $rules['wardenCnicCheck'] = 'required|numeric|digits:15';
                }
            }
            $membershipExistence="";
            $userMembership = Auth::user();
            $memberships = Membership::where('cnic',$userMembership->cnic_no)->get();
            if(count($memberships)>0){
                $membershipExistence="Yes";
            }
            else{
                $membershipExistence="No";
                $rules['membershipTypeId'] = 'required|exists:membership_types,id';
                $rules['transactionNumber'] = 'required|unique:member_ships,transaction_no';
                if(!empty($request->refferalCnic) && strlen($request->refferalCnic)>0){
                    $rules['refferalCnic']='required|max:15|min:15|exists:users,cnic_no';
                }
            }

            // dd($request->all());
            $this->validate($request,$rules);
            
            
            // Generate the initial  hotel slug from the hostel name
            $slug = Str::slug($request->hostelName);
            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);
            
            

           // Begin: To save the images
            $timestamp = now()->timestamp;
            $imagePaths = [];

            foreach ($request->file('hostelImages') as $index => $image) {
                $imageFileName = $timestamp . '_' . $index . '.' . $image->getClientOriginalExtension();
                $imagePath = "storage/hostelImages/" . $imageFileName;
                $image->storeAs('public/hostelImages/', $imageFileName);
                $imagePaths[] = $imagePath;
            }
            // End: To save the images

            // Convert the array to a JSON string
            $jsonImagePaths = json_encode($imagePaths);

            // Get the authenticated user's ID
            $userId = Auth::id();
            $users = Auth::user();
            $roles = $users->roles; // Assuming 'roles' is the name of the relationship
            foreach ($roles as $role) {
                $roleName = $role->name; 
            }

            DB::beginTransaction();
            $property = new Properties();
            $property->name = $request->hostelName;
            $property->description = $request->hostelDescription;
            $property->location = $request->hostelLocation;
            $property->latitude = $request->latitude;
            $property->longitude = $request->longitude;
            $property->number_bedroom = $request->hostelTotalRooms;
            $property->number_bathroom = $request->hostelBathRooms;
            $property->number_floor = $request->hostelTotalFloors;
            $property->state_id = $request->hostelStatesId;
            $property->city_id = $request->hostelCityId;
            $property->author_id = $userId;
            $property->author_type = $roleName;
            $property->category_id = $request->hostelCategoryId;
            $property->images = $jsonImagePaths;
            $property->slug = $uniqueSlug;
            $property->nhapk_register = 1;
            $result = $property->save();
            if(!$result){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is a Problem in Add Hostel Form. Kindly Submit Again',
                ]);
            }

            $propertiesId = $property->id;

            // Save the data into the Properties_Addresses Table
            $propertyAddresses = new PropertiesAddress();
            $propertyAddresses->property_id = $propertiesId;
            $propertyAddresses->address = $request->hostelAddress;
            $propertyAddresses->city_id = $request->hostelCityId;
            $propertyAddresses->state_id = $request->hostelStatesId;
            $propertyAddresses->country_id = $request->hostelCountryId;
            $propertyAddresses->latitude = $request->latitude;
            $propertyAddresses->longitude = $request->longitude;
            $propertyAddresses->zipcode = $request->hostelZipCode;
            $propertyAddresses->nearest_landmark = $request->hostelNearestLandmark;
            $resultPropertiesAddresses = $propertyAddresses->save();
            if(!$resultPropertiesAddresses){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is a Problem in Add Properies Addresses Form. Kindly Submit Again',
                ]);
            }

            // Save the data into the Property_Metas Table
            $propertyMetas = new PropertiesMetas();
            $propertyMetas->property_id = $propertiesId;
            $propertyMetas->slogan = $request->hostelSlogan;
            $propertyMetas->hostel_for = $request->hostelGender;
            $propertyMetas->property_type = $request->hostelTypeId;
            $propertyMetas->opening_time = $request->hostelOpenTiming;
            $propertyMetas->closing_time = $request->hostelCloseTiming;
            $propertyMetas->avg_rent_per_month = $request->hostelAvgRentPerMonth;
            $propertyMetas->rent_pay_schedule = $request->hostelRentPaySchedule;
            $propertyMetas->stay_type = $request->hostelStayType;
            $propertyMetas->guest_stay_allow = $request->hostelGuestStayAllow;
            $propertyMetas->total_room = $request->hostelTotalRooms;
            $propertyMetas->room_occupany = $request->hostelRoomOccupancy;
            $propertyMetas->contact_number = "+92".$request->hostelContactNumber;
            $propertyMetas->area_name = $request->hostelAreaName;
            $propertyMetas->street_no = $request->hostelStreetNo;
            $propertyMetas->plot_no = $request->hostelPlotNo;
            $propertyMetas->location = $request->hostelLocation;
            $propertyMetas->nearby_famous_location = $request->hostelNearestLandmark;
            $propertyMetas->map_location = $request->hostelMapLocation;
            $propertyMetas->mess = $request->hostelMess;
            if($request->hostelMess == "available"){
                $propertyMetas->mess_type = $request->hostelMessType;
            }
            $propertyMetas->utility_bill = $request->hostelUtilityBills;
            $propertyMetas->security_guard_availability = $request->hostelSecurityGuard;
            $propertyMetas->security_system_availability = $request->hostelSecuritySystem;
            $propertyMetas->warden_availability = $request->hostelWardenAvailability;
            $propertyMetas->warden_availability_gender = $request->hostelWardenType;
            $propertyMetas->doorman_availability = $request->hostelDoormanAvailability;
            $propertyMetas->doorman_availability_gender = $request->hostelDoormanType;
            $propertyMetas->made_availability = $request->hostelMadeAvailability;
            $propertyMetas->made_availability_gender = $request->hostelMadeType;
            if($request->hostelCanteenAvailability != "n/a"){
                $propertyMetas->canteen_availability = $request->hostelCanteenAvailability;
            }
            $propertyMetas->common_room_availability = $request->hostelCommonRoomAvailability;
            $propertyMetas->study_room_availability = $request->hostelStudyRoomAvailability;
            $propertyMetas->prayer_area_availability = $request->hostelPrayerArea;
            $propertyMetas->parking_availability = $request->hostelParkingAvailability;
            $propertyMetas->recommended_place = $request->hostelRecommendedPlace;
            $propertyMetas->youtube_link = $request->hostelYoutubeLink;
            $propertyMetas->facebook_link = $request->hostelFacebookLink;
            $propertyMetas->instagram_link = $request->hostelInstagramLink;
            $resultPropertyMetas = $propertyMetas->save();
            if(!$resultPropertyMetas){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is a Problem in Add Hsotel Details Form. Kindly Submit Again',
                ]);
            }

            // Save the Partner's Form
            if($request->partnerCnicRadio=="Yes"){
                $propertiesPartner = new PropertiesPartner();
                $propertiesPartner ->properties_id = $propertiesId;
                if($partnerAvailability == "New"){
                    $partnerName = $request->partnerFirstName." ".$request->partnerLastName;
                    // Generate the initial slug from the name
                    $slug = Str::slug($partnerName);
                    // Make the slug unique
                    $uniqueSlugUsers = $this->makeSlugUniqueUsers($slug);
    
                    $pratnerUser = new User();
                    
                    $pratnerUser->name = $partnerName;
                    $pratnerUser->firstname = $request->partnerFirstName;
                    $pratnerUser->lastname = $request->partnerLastName;
                    $pratnerUser->email = $request->partnerEmail;
                    $pratnerUser->password = Hash::make('12345678');
                    $pratnerUser->phone_number = "+92".$request->partnerMobileNumber;
                    $pratnerUser->cnic_no = $request->partnerCnicCheck;
                    $pratnerUser->slug = $uniqueSlugUsers;
                    $pratnerUser->nhapk_register = 1;
                    if(!($pratnerUser->save())){
                        DB::commit();
                        return response()->json([
                            'status' => 'error',
                            'message' => 'There is a Problem in Adding Hsotel Partner Form. Kindly Submit Again',
                        ]);
                    }
                    $pratnerUser->assignRole("user");
                    // In the Partner Table save the author id
                    $propertiesPartner->author_id = $pratnerUser->id;
                }else if($partnerAvailability == "Old"){
                    // 
                    $propertiesPartner->author_id = $request->partnerAuthorId;
                }
                 if(!($propertiesPartner->save())){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is a Problem in Adding Partner Details Form. Kindly Submit Again',
                    ]);
                }
            }
            
            // Save the Warden's Form
            if($request->wardenCnicRadio=="Yes"){
                $propertiesWarden = new PropertiesWarden();
                $propertiesWarden ->properties_id = $propertiesId;
                if($wardenAvailability == "New"){
                    $wardenName = $request->wardenFirstName." ".$request->wardenLastName;
                    // Generate the initial slug from the name
                    $slug = Str::slug($wardenName);
                    // Make the slug unique
                    $uniqueSlugUsers = $this->makeSlugUniqueUsers($slug);
    
                    $wardenUser = new User();
                    
                    $wardenUser->name = $wardenName;
                    $wardenUser->firstname = $request->wardenFirstName;
                    $wardenUser->lastname = $request->wardenLastName;
                    $wardenUser->email = $request->wardenEmail;
                    $wardenUser->password = Hash::make('12345678');
                    $wardenUser->phone_number = "+92".$request->wardenMobileNumber;
                    $wardenUser->cnic_no = $request->wardenCnicCheck;
                    $wardenUser->slug = $uniqueSlugUsers;
                    $wardenUser->nhapk_register = 1;
                    if(!($wardenUser->save())){
                        DB::commit();
                        return response()->json([
                            'status' => 'error',
                            'message' => 'There is a Problem in Adding Hsotel Partner Form. Kindly Submit Again',
                        ]);
                    }
                    $wardenUser->assignRole("staff");
                    // In the Partner Table save the author id
                    $propertiesWarden->author_id = $wardenUser->id;
                }else if($wardenAvailability == "Old"){
                    // 
                    $propertiesWarden->author_id = $request->wardenAuthorId;
                }
                 if(!($propertiesWarden->save())){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is a Problem in Adding Partner Details Form. Kindly Submit Again',
                    ]);
                }
            }

            // Save the luxuries,amenities,features,facilities
            $selectedFeatureIds = $request->input('features', []);
            // Attach selected features to the property
            $property->features()->attach($selectedFeatureIds);

            $selectedFacilityIds = $request->input('facilities', []);
            // Attach selected facilities to the property
            $property->facilities()->attach($selectedFacilityIds);

            $selectedAmenityIds = $request->input('amenities', []);
            // Attach selected amenities to the property
            $property->amenities()->attach($selectedAmenityIds);

            $selectedLuxuryIds = $request->input('luxuries', []);
            // Attach selected luxuries to the property
            $property->luxuries()->attach($selectedLuxuryIds);
            //  dd($selectedFeatureIds);

            // Check if 'tags' is present in the request and is an array
            if ($request->has('tags') && is_array($request->tags)) {
                // Sync the tags for the property
                $property->tags()->sync($request->tags);
            }


            $userMembership = Auth::user();
            $memberships = Membership::where('cnic',$userMembership->cnic_no)->get();
            if($membershipExistence=="No"){
                $memberships = new Membership();
                $memberships->name = $userMembership->name;
                $memberships->cnic = $userMembership->cnic_no;
                $memberships->membershiptype_id =$request->membershipTypeId;
                // $memberships->hostelreg_no =;
                $memberships->transaction_no =$request->transactionNumber;
                // Determine gender based on the last digit of the CNIC
                $lastDigit = substr($userMembership->cnic_no, -1);
                $memberships->gender = ($lastDigit % 2 === 0) ? 'female' : 'male';
                $memberships->since =$request->since;
                $memberships->previous_hostel =$request->previousHostel;
                $memberships->country_id =$request->hostelCountryId;
                $memberships->city_id =$request->hostelCityId;
                $memberships->states_id =$request->hostelStatesId;
                $memberships->area =$request->hostelAreaName;
                $memberships->property_id =$propertiesId;
                // Check if referalCnic is not empty
                if (!empty($request->refferalCnic)) {
                    // Assuming you have a User model and a proper relationship between User and Membership
                    $referralUser = User::where('cnic_no', $request->refferalCnic)->first();
                    $memberships->referal_cnic =$request->refferalCnic;
                    // Set the parent_id with the ID of the referring user
                    $memberships->parent_id = $referralUser->id;
                }
                if(!($memberships->save())){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is a Problem in Saving Membership Details Form. Kindly Submit Again',
                    ]);
                } 
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Hostel created successfully',
            ]);
        }
        catch (ValidationException $validationErrors) {
            // If validation fails, return validation errors
            return response()->json([
                'status' => 'error',
                'errors' => $validationErrors->validator->getMessageBag(),
            ], 422);
    
        }
        catch(Exception $e){
            // If any other exception occurs, handle it accordingly
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add user'.$e->getMessage(),
            ], 500);
        }
    }

    


    // Begin: Function to make slug unique of Properties
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingProperties = Properties::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingProperties) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: Function to make slug unique of Properties
    
    // Begin: Function to make slug unique of Users
    private function makeSlugUniqueUsers($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingUsers = User::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingUsers) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUniqueUsers($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: Function to make slug unique of Users
}

