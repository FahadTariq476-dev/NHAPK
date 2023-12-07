<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CompliantTypeController extends Controller
{
    //
    // Begin: Function to show the post-complaint-types.blade.php
    public function index(){
        return view('admin.complaints.complaint-types.post-complaint-types');
    }
    // End: Function to show the post-complaint-types.blade.php

    // Begin: Function to save the complaint_types in db
    public function store(Request $request){
        // dd($request->toArray());
        $rules = [
            'name' => 'required|string|max:255|min:3|unique:nhapk_complaint_types,name',
            'description' => 'required|string|max:65535|min:3'
        ];
        $this->validate($request,$rules);

        // Generate the initial slug from the name
        $slug = Str::slug($request->name);
        // Make the slug unique
        $uniqueSlug = $this->makeSlugUnique($slug);
    
        $complaint_types = new ComplaintType();
        $complaint_types->name = $request->name;
        $complaint_types->description = $request->description;
        $complaint_types->status = 1;
        $complaint_types->slug = $uniqueSlug;
        $results = $complaint_types->save();
        if(!$results){
            return redirect()->route('admin.complaint-types.index')->with('error','There is an error while saving the complaint types. Kindly try again');
        }
        return redirect()->route('admin.complaint-types.index')->with('success','Complaint Types saved. Successfully!');
        // return "Yes";
    }
    // End: Function to save the complaint_types in db

    // Begin: Function to show the edit-complaint-types.blade.php
    public function edit($id){
        $complaint_types = ComplaintType::find($id);
        if(!$complaint_types){
            return redirect()->route('')->with('error','You are accessing the invalid data. Kindly try with the valid one');
        }
        return view('admin.complaints.complaint-types.edit-complaint-types')->with(['complaint_types'=>$complaint_types]);
    }
    // End: Function to show the edit-complaint-types.blade.php

    // Begin: Function to update the complaint_types in db
    public function update(Request $request){
        $complaint_types = ComplaintType::find($request->complaint_types_id);
        if(!$complaint_types){
            return redirect()->route('admin.complaint-types.list')->with('eror','You are accessing the invalid data. Kindly access the valid data');
        }
        $rules = [
            'description' => 'required|string|max:65535|min:3'
        ];
        if($request->name == $complaint_types->name){
            $rules['name']='required|string|max:255|min:3';
            $uniqueSlug = $complaint_types->slug;
        }
        else{
            $rules['name']='required|string|max:255|min:3|unique:nhapk_complaint_types,name';
            // Generate the initial slug from the name
            $slug = Str::slug($request->name);
            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);
        }
        $this->validate($request,$rules);
        // dd($request->toArray());

        $complaint_types->name = $request->name;
        $complaint_types->description = $request->description;
        $complaint_types->slug = $uniqueSlug;
        $results = $complaint_types->save();
        if(!$results){
            return redirect()->route('admin.complaint-types.list')->with('error','There is an error while updating the complaint types. Kindly try again');
        }
        return redirect()->route('admin.complaint-types.list')->with('success','Complaint Types updated. Successfully!');
    }
    // End: Function to update the complaint_types in db

    // Begin: Function to update the status of complaint_types 
    public function update_status($status,$id){
        // Check if the given $status is 0 or 1
        if(!(in_array($status,[0,1]))){
            return "invalid";
        }
        $complaint_types = ComplaintType::find($id);
        if(!$complaint_types){
            return "error";
        }
        $complaint_types->status = $status;
        $complaint_types->save();
        return 'success';
    }
    // End: Function to update the status of complaint_types 

    // Begin: Function to get the description of complaint_types using id of complaint_types
    public function get_description($id){
        $complaint_types = ComplaintType::find($id);
        $data ="";
        if(!$complaint_types){
            $data = "Your are accessing the invalid data";
            return $data;
        }
        $data = $complaint_types->description;
        return $data;
    }
    // End: Function to get the description of complaint_types using id of complaint_types

    // Begin: Function to show the list-complaint-types.blade.php
    public function list(){
        return view('admin.complaints.complaint-types.list-complaint-types');
    }
    // End: Function to show the list-complaint-types.blade.php

    // Begin: Function to get_complaint_types from db on ajax request and send them in data table
    public function get_complaint_types(Request $request){
        if($request->ajax()){
            $complaint_types = ComplaintType::latest()->get();
            // dd($complaint_types);
            return DataTables::of($complaint_types)->addIndexColumn()->make(true);
            // return DataTables::of($blogs)->addIndexColumn()->make(true);
        }
        return abort(403, 'Unauthorized action.');
    }
    // End: Function to get_complaint_types from db on ajax request and send them in data table

    // Begin: FUnction to make unique slug
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingcomplaint_types = ComplaintType::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingcomplaint_types) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: FUnction to make unique slug
}
