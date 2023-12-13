<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Feature;
use App\Models\Luxury;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
    public function getProperties($city_id){
        // Retrieve states based on the provided country_id
        $properties = Properties::where('city_id', $city_id)->select('name','id')->get();
        // Return the states as a JSON response
        return response()->json($properties);
    }
    public function properties_IdCheck($id){
        $properties = Properties::find($id);
        if(!$properties){
            return 0;   // 0 Means False Hostel does not exist
        }
        else{
            return 1;   // 1 means True Hostel exist
        }
        
    }

    // Begin: Function to return hostel name in the suggestion on key up
    public function getHostelSuggestions(Request $request)
    {
        if($request->ajax()){
            // 
            $inputVal = $request->input('inputVal');
 
            // Fetch hostel names using LIKE operator
            $hostelNames = Properties::where('name', 'like', '%' . $inputVal . '%')
                                     ->select('id', 'name')
                                     ->get();
 
            // You can format the suggestions as per your requirement
            $suggestionsHtml = '';
            foreach ($hostelNames as $hostel) {
                // $suggestionsHtml .= '<div class="suggestion-item" data-hostel-id="' . $hostel->id . '">' . $hostel->name . '</div>';
                $suggestionsHtml .= '<div class="dropdown-item suggestion-item" data-hostel-id="' . $hostel->id . '">' . $hostel->name . '</div>';
            }
            return $suggestionsHtml;
        }
        return abort(403, 'Unauthorized action.');
         
    }
    // End: Function to return hostel name in the suggestion on key up


    public function findHostelById(Request $request)
    {
        // dd($request->toArray());
        if ($request->search_type == "Reg_No" && !empty($request->search_data)) {
            $properties = Properties::find($request->search_data);
    
            if (!$properties) {
                return redirect()->route('Home')->with('error', 'No Hostel Found');
            }
        } elseif ($request->search_type == "Name" && !empty($request->search_data) && !empty($request->selectedHostelId)) {
            $properties = Properties::find($request->selectedHostelId);
    
            if (!$properties) {
                return redirect()->route('Home')->with('error', 'No Hostel Found');
            }
        } else {
            return redirect()->route('Home')->with('error', 'Invalid Search Type or Data');
        }

        // amenities
        $amenities = Amenity::get();

        // luxuries
        $luxuries = Luxury::get();

        // features
        $features = Feature::get();

        // facilities
        $facilities = Facility::get();
    
        // Assuming 'author_id' is the foreign key in the properties table linking to users table
        $hostelOwner = $properties->users;

        // Assuming 'author_id' and 'properties_id' are the foreign keys in the properties_partner pivot table
        $hostelPartners = $properties->partners;
        
        // Assuming 'author_id' and 'properties_id' are the foreign keys in the properties_warden pivot table
        $hostelWardens = $properties->wardens;
        
        // state_id
        $states = $properties->states;
        // cities
        $cities = $properties->cities;
        // dd($propertiesAddress);
        // propertyAddress
        $propertyAddress = $properties->address;
        // metas
        $propertyMetas = $properties->metas;
        // dd($propertyAddress);
        // dd($cities);
        // property_luxuries
        $propertyLuxuries = $properties->luxuries;
        
        // property_amenities
        $propertyAmenities = $properties->amenities;
        // dd($propertyAmenities);

        // property_facilities
        $propertyFacilities = $properties->facilities;
        // dd($propertyAmenities);

        // property_features
        $propertyFeatures = $properties->features;
        // dd($propertyAmenities);

    
        return view('frontEnd.hostel.list-hostel')->with([
            'properties' => $properties, 
            'hostelOwner' => $hostelOwner,
            'hostelPartners' => $hostelPartners,
            'hostelWardens' => $hostelWardens,
            'amenities' => $amenities,
            'luxuries' => $luxuries,
            'features' => $features,
            'facilities' => $facilities,
            'states' => $states,
            'cities' => $cities,
            'propertyAddress' => $propertyAddress,
            'propertyMetas' => $propertyMetas,
            'propertyLuxuries' => $propertyLuxuries,
            'propertyAmenities' => $propertyAmenities,
            'propertyFacilities' => $propertyFacilities,
            'propertyFeatures' => $propertyFeatures,
        ]);
    }

}
