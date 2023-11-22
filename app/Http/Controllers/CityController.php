<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    //
    public function getCities($state_id){
        // Retrieve states based on the provided country_id
        $cities = City::where('states_id', $state_id)->select('name','id')->get();
        // Return the states as a JSON response
        return response()->json($cities);
    }
}
