<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StatesController extends Controller
{
    //
    public function getStates($country_id){
        // Retrieve states based on the provided country_id
        $states = State::where('country_id', $country_id)->get();
        // Return the states as a JSON response
        return response()->json($states);
    }
}
