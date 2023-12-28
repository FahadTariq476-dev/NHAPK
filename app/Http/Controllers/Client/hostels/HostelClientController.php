<?php

namespace App\Http\Controllers\client\hostels;

use Exception;
use App\Models\Luxury;
use App\Models\Amenity;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Category;
use App\Models\Facility;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

            return view('client.hostel.post-hostel') 
                ->with(['countries' => $countries,
                    'categories' => $categories,
                    'property_types' => $property_types,
                    'amenities' => $amenities,
                    'luxuries' => $luxuries,
                    'features' => $features,
                    'facilities' => $facilities,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
       
    }
}
