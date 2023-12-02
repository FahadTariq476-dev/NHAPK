<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SopAdminController extends Controller
{
    //
    // Begin: Function to show the post-sops.blade file
    public function index(){
        return view('admin.sops-legal-documentation.post-sops');
    }
    // End: Function to show the post-sops.blade file

    // Begin: Function to show the list-sops.blade file
    public function listSopsView(){
        return view('admin.sops-legal-documentation.list-sops');
    }
    // End: Function to show the list-sops.blade file

    // Begin: Function to get the list-sops and send them in data table
    public function getSops(Request $request){
        if($request->ajax()){
            $sops = Sop::latest()->get();
            return DataTables::of($sops)
            ->addColumn('file_type_name', function ($sop) {
                return ($sop->file_type == 'img') ? 'Image' : 'File';
            })
            ->addIndexColumn()
            ->make(true);
        }
    }
    // End: Function to get the list-sops and send them in data table


    // Begin: Function to Store SOP's to database
    public function storeSops(Request $request){
        // dd($request->toArray());
        $rules = [
            'title' => 'required|string|max:255|unique:nhapk_sops,title',
            'description' => 'required|string',
            'file_type' => 'required|in:img,file',
        ];
        
        // Check file type and apply rules accordingly
        if ($request->file_type == 'img') {
            $rules['file_path'] = 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048';
        } elseif ($request->file_type == 'file') {
            $rules['file_path'] = 'required|mimes:pdf,doc,docx|max:2048';
        }
        
        $this->validate($request, $rules);

        // Save the file in Folder
        $timestamp = now()->timestamp;
        if ($request->file_type == 'img') {
            // Here we save the file in the sops-file-images/sops-image
            
            // Save the images
            $imageFileName = $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension();
            // Store the images in the 'public/sops-file-images/sops-image' folder
            $file_path = "storage/sops-file-images/sops-image/".$imageFileName;
            $request->file('file_path')->storeAs('public/sops-file-images/sops-image', $imageFileName);
        } elseif ($request->file_type == 'file') {
            // Here we save the file in the sops-file-images/sops-file
            // Save the images
            $imageFileName = $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension();
            // Store the images in the 'public/sops-file-images/sops-image' folder
            $file_path = "storage/sops-file-images/sops-file/".$imageFileName;
            $request->file('file_path')->storeAs('public/sops-file-images/sops-file', $imageFileName);
        }

        // Generate the initial slug from the title
        $slug = Str::slug($request->title);

        // Make the slug unique
        $uniqueSlug = $this->makeSlugUnique($slug);
        // To save the data
        $sops = new Sop();
        $sops->title = $request->title;
        $sops->description = $request->description;
        $sops->file_path = $file_path;
        $sops->file_type = $request->file_type;
        $sops->author_id = Auth::user()->id;
        $sops->slug = $uniqueSlug;
        $result = $sops->save();
        if(!$result){
            return redirect()->route('admin.sops.post-sops')->with('error','SOPs are not saved. Kindly! Try again.');
        }
        return redirect()->route('admin.sops.post-sops')->with('success','SOPs are saved now.');
    }
    // End: Function to Store SOP's to database

    // Begin: Function to delete SOP's from the database
    public function deleteSops($sopsId){
        $sops = Sop::find($sopsId);
        if(!$sops){
            return "error";
        }
        // Get the paths for image deletion
        $imagePath = $sops->file_path;

        // Replace "storage" with "app/public"
        $newPath_a = str_replace("storage", "app/public", $imagePath);

        // Attempt to delete the blog
        $deleted = $sops->delete();

        if ($deleted) {
            // Delete the associated images from storage
            // Now $newPath contains the updated path
            if ($newPath_a) {
                $imageFullPath = storage_path($newPath_a);
                if (file_exists($imageFullPath)) {
                    unlink($imageFullPath);
                }
            }
            return "success";
        } 
        else {
            return "error";
        }
    }
    // End: Function to delete SOP's from the database

    // Begin: Function to show the edit-sops.blade file having sopsId
    public function editSops($sopsId){
        $sops = Sop::find($sopsId);
        if(!$sops){
            return redirect()->route('admin.sops.list-sops')->with('error','You are accessig the invalid SOPs. Kindly access the valid one.');
        }
        return view('admin.sops-legal-documentation.edit-sops')->with(['sops'=>$sops]);
    }
    // End: Function to show the edit-sops.blade file having sopsId

    // Begin: Function to update the full SOP's from edit-sop's request
    public function updateSops(Request $request){
        // dd($request->toArray());
        $sops= Sop::find($request->sopsId);
        if(!$sops){
            return redirect()->route('admin.sops.list-sops')->with('error',"You are accessig the invalid SOPs. Kindly access the valid one.");
        }


        $rules = [
            'description' => 'required|string',
        ];
        if($request->title == $sops->title){
            $rules['title'] = 'required|string|max:255';
            $uniqueSlug = $sops->slug;
        }else{
            $rules['title'] = 'required|string|max:255|unique:nhapk_sops,title';
             // Generate the initial slug from the title
            $slug = Str::slug($request->title);

            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);
        }
        
        if ($request->hasFile('file_path') ) {
            $rules['file_type'] ='required|in:img,file';
            // Check file type and apply rules accordingly
            if ($request->file_type == 'img') {
                $rules['file_path'] = 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048';
            } elseif ($request->file_type == 'file') {
                $rules['file_path'] = 'required|mimes:pdf,doc,docx|max:2048';
            }
        } 
        
        
        $this->validate($request, $rules);
        // return "Yes";

        // Save the file in Folder
        $timestamp = now()->timestamp;
        if ($request->hasFile('file_path') ) {
            if ($request->file_type == 'img') {
                // Here we save the file in the sops-file-images/sops-image
                
                // Save the images
                $imageFileName = $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension();
                // Store the images in the 'public/sops-file-images/sops-image' folder
                $file_path = "storage/sops-file-images/sops-image/".$imageFileName;
                $request->file('file_path')->storeAs('public/sops-file-images/sops-image', $imageFileName);
            } elseif ($request->file_type == 'file') {
                // Here we save the file in the sops-file-images/sops-file
                // Save the images
                $imageFileName = $timestamp . '.' . $request->file('file_path')->getClientOriginalExtension();
                // Store the images in the 'public/sops-file-images/sops-image' folder
                $file_path = "storage/sops-file-images/sops-file/".$imageFileName;
                $request->file('file_path')->storeAs('public/sops-file-images/sops-file', $imageFileName);
            }

            // To Unlink the old file
            // Get the paths for image deletion
            $imagePath = $sops->file_path;

            // Replace "storage" with "app/public"
            $newPath_a = str_replace("storage", "app/public", $imagePath);

            // Delete the associated images from storage
            // Now $newPath contains the updated path
            if ($newPath_a) {
                $imageFullPath = storage_path($newPath_a);
                if (file_exists($imageFullPath)) {
                    unlink($imageFullPath);
                }
            }
            // To udpate the file
            $sops->file_path = $file_path;
            $sops->file_type = $request->file_type;
        }
        
    
        // To update the data
        $sops->title = $request->title;
        $sops->description = $request->description;
        $sops->author_id = Auth::user()->id;
        $sops->slug = $uniqueSlug;
        $result = $sops->save();
        if(!$result){
            return redirect()->route('admin.sops.list-sops')->with('error','SOPs are not updated. Kindly! Try again.');
        }
        return redirect()->route('admin.sops.list-sops')->with('success','SOPs are updated now.');
        return $request;
    }
    // End: Function to update the full SOP's from edit-sop's request


    // Begin: Function to get the description using id of sops
    public function get_description($id){
        $sops = Sop::find($id);
        $data ="";
        if(!$sops){
            $data = "Your are accessing the invalid data";
            return $data;
        }
        $data = $sops->description;
        return $data;
    }
    // End: Function to get the description using id of sops

    // Begin: Function to make slug unique
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingNews = Sop::where('slug', $slug)->first();

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
