<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
    public function getProperties($city_id){
        // Retrieve states based on the provided country_id
        $properties = Properties::where('city_id', $city_id)->get();
        // Return the states as a JSON response
        return response()->json($properties);
    }
}
