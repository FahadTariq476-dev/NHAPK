<?php

namespace App\Http\Controllers;

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
        if($request->search_type=="Reg_No" && !empty($request->search_data)){
            // 
            $properties = Properties::find($request->search_data);
            if(!$properties){
                return redirect()->route('Home')->with('error','No Hostel Found');
            }
            dd($properties->toArray());
        } 
        if($request->search_type=="Name" && !empty($request->search_data) && !empty($request->selectedHostelId)){
            // 
            $properties = Properties::find($request->selectedHostelId);
            if(!$properties){
                return redirect()->route('Home')->with('error','No Hostel Found');
            }
            dd($properties->toArray());
        }
        dd("Yes");
    // Find the hostel by ID
    // $hostel = Hostel::find($id);

    // // Check if the hostel is found
    // if ($hostel) {
    //     // Return the hostel details or perform any other actions
    //     return view('hostel.show', ['hostel' => $hostel]);
    // } else {
    //     // Handle the case when the hostel is not found
    //     return redirect()->route('home')->with('error', 'Hostel not found.');
    // }
    }

}
