<?php

namespace App\Http\Controllers\Admin;

use App\Models\FAQ;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FaqAdminController extends Controller
{
    //

    // Begin: Function to show post-faqs.blade.php
    public function index(){
        return view('admin.faqs.post-faqs');
    }
    // End: Function to show post-faqs.blade.php

    // Begin: Function to show list-faqs.blade.php
    public function listFaqsView(){
        return view('admin.faqs.list-faqs');
    }
    // End: Function to show list-faqs.blade.php
    
    // Begin: Function to save faqs
    public function storeFaqs(Request $request){
        
        $rules =[
            'question' =>'required|string|max:255|unique:nhapk_faqs,question',
            'answer' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
        // Generate the initial slug from the title
        $slug = Str::slug($request->question);

        // Make the slug unique
        $uniqueSlug = $this->makeSlugUnique($slug);
        
        $this->validate($request, $rules);
        // dd($request->toArray());

        // To save the record
        $faqs = new FAQ();
        $faqs->question= $request->question;
        $faqs->answer= $request->answer;
        $faqs->status= $request->status;
        $faqs->slug= $uniqueSlug;
        $faqs->author_id= Auth::user()->id;
        $result = $faqs->save();
        if(!$result){
            return redirect()->route('admin.faqs.post-faqs')->with('error',"FAQs are not saved. Kindly try again.");
        }
        return redirect()->route('admin.faqs.post-faqs')->with('success',"FAQs are saved.");
    }
    // End: Function to save faqs


    // Begin: To make slug unique
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingNews = FAQ::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingNews) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: To make slug unique


    // Begin: Function to list the FAQ's on ajax request and send data table
    public function adminListingFaqs(Request $request){
        // 
        // return $request
        if($request->ajax()){
            $faqs = FAQ::latest()->get();
            return DataTables::of($faqs)->addIndexColumn()->make(true);
        }
        return abort(403, 'Unathorized action');
    }
    // End: Function to list the FAQ's on ajax request and send data table

    // Begin: Function to update the status of FAQ's on ajax request using id
    public function updateFaqsStatus($status,$faqsId){
        // 
        $validStatuses = ['active', 'inactive'];

        // Check if the given $status is in the array of valid statuses
        if (!(in_array($status, $validStatuses))) {
            return 'error';
        }
        $faqs = FAQ::find($faqsId);
        if(!$faqs){
            return "error";
        }
        $faqs->status = $status;
        $faqs->save();
        return 'success';
    }
    // End: Function to update the status of FAQ's on ajax request using id

    // Begin: FUnction to show the dit FAQ's view and load the data in the input fields
    public function editFaqsView($id){
        // return $id;
        $faqs = FAQ::find($id);
        if(!$faqs){
            return redirect()->route('admin.faqs.list-faqs')->with('error','You are accessing the invalid FAQs. Kindly request the valid FAQS.');
        }
        return view('admin.faqs.edit-faqs')->with(['faqs'=>$faqs]);
    }
    // End: Function to show the dit FAQ's view and load the data in the input fields

    // Begin: Function to update the full FAQ's 
    public function updateFullFaqs(Request $request){
        $faqs = FAQ::find($request->id);
        if(!$faqs){
            return redirect()->route('admin.faqs.list-faqs')->with('error','You are accessing the invalid FAQs. Kindly request the valid FAQS.');
        }
        $rules = [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
        
        if ($request->question != $faqs->question) {
            $rules['question'] .= '|unique:nhapk_faqs,question';
        }
        
        $this->validate($request, $rules);
        if($request->question == $faqs->question){
            // To save the record
            $faqs->answer= $request->answer;
            $faqs->status= $request->status;
            $faqs->author_id= Auth::user()->id;
            $result = $faqs->save();
        }
        else{
            // Generate the initial slug from the title
            $slug = Str::slug($request->question);
            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);
            // To save the record
            $faqs->question= $request->question;
            $faqs->answer= $request->answer;
            $faqs->status= $request->status;
            $faqs->slug= $uniqueSlug;
            $faqs->author_id= Auth::user()->id;
            $result = $faqs->save();
        }
        

        if(!$result){
            return redirect()->route('admin.faqs.list-faqs')->with('error',"FAQs are not updated. Kindly try again.");
        }
        return redirect()->route('admin.faqs.list-faqs')->with('success',"FAQs are updatd.");
    }
    // End: Function to update the full FAQ's 

    // Begin: Function to Delete Faq's
    public function delFaqs($id){
        $faqs = FAQ::find($id);
        if(!$faqs){
            return "error";
        }
        $faqs->delete();
        return "success";
    }
    // End:Function to Delete Faq's

}
