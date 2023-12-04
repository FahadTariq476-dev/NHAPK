<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\NewsFeed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NewsFeedsAdminController extends Controller
{
    //
    // Begin: Function to show the page to add news & feed
    public function index(){
        return view('admin.NewsFeeds.post-newsfeeds');
    }
    // End: Function to show the page to add news & feed

    // Begin: Function to show the list of news & feed
    public function listNewsfeedsView(){
        return view('admin.NewsFeeds.list-newsfeeds');
    }
    // End: Function to show the list of news & feed

    // Begin: Function save the news feeds 
    public function saveNewsfeeds(Request $request){
        // return "Yes";
        // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'shortDescription' => 'required|max:255',
        'editor' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048', // Maximum 2MB for image
        'thumbnailImage' => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|image|max:2048',
        'status' => 'required|in:pending,published',
    ]);
    // return "yesss";

    // Generate the initial slug from the title
    $slug = Str::slug($request->title);

    // Make the slug unique
    $uniqueSlug = $this->makeSlugUnique($slug);
    // return "Slug: " . $uniqueSlug;
    
    $timestamp = now()->timestamp;
    // Save the images
    $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
    $thumbnailImageFileName = $timestamp . '.' . $request->file('thumbnailImage')->getClientOriginalExtension();
    // Store the images in the 'public/newsfeed-images/image' folder
    $imagePath = "storage/newsfeed-images/image/".$imageFileName;
    $thumbnailImagePath = "storage/newsfeed-images/thumbnail/".$thumbnailImageFileName;
    $request->file('image')->storeAs('public/newsfeed-images/image', $imageFileName);
    $request->file('thumbnailImage')->storeAs('public/newsfeed-images/thumbnail', $thumbnailImageFileName);
    // Save the news entry to the database
    $news = new NewsFeed();
    $news->title = $validatedData['title'];
    $news->slug = $uniqueSlug; 
    $news->short_description = $validatedData['shortDescription'];
    $news->editor_content = $validatedData['editor'];
    $news->image_path = $imagePath;
    $news->thumbnail_image_path = $thumbnailImagePath;
    $news->featured_post = $request->has('featuredPost');
    $news->status = $validatedData['status'];
    // Associate the news with the authenticated user
    $news->author_id = Auth::id();

    if(!$news->save()){
        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the news. Try again']);
    }
    return redirect()->route('admin.newsfeeds.post-newsfeeds')->with('success', 'News created successfully!');
    }

    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingNews = NewsFeed::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingNews) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: Function save the news feeds 

    // Begin: Listing the NewsFeed Using Data table
    public function adminListingNewsfeeds(Request $request){
        // 
        // return $request
        if($request->ajax()){
            $news = NewsFeed::latest()->get();
            return DataTables::of($news)->addIndexColumn()->make(true);
        }
        return abort(403, 'Unathorized action');
    }
    // End: Listing the NewsFeed Using Data table

    // Begin: To Update the status of newsfeeds
    public function updateNewsfeedStatus($status,$newsId){
        // 
        $validStatuses = ['pending', 'published'];

        // Check if the given $status is in the array of valid statuses
        if (!(in_array($status, $validStatuses))) {
            return 'error';
        }
        $news = NewsFeed::find($newsId);
        if(!$news){
            return "error";
        }
        $news->status = $status;
        $news->save();
        return 'success';
    }
    // End: To Update the status of newsfeeds

    // Begin: To Delete the newsfeed using newsId
    public function deleteNewsfeed($newsId){
        // Find the blog by ID
        $news = NewsFeed::find($newsId);

        // Check if the blog exists
        if (!$news) {
            return "error";
        }

        // Get the paths for image deletion
        $imagePath = $news->image_path;
        $thumbnailImagePath = $news->thumbnail_image_path;

        // Replace "storage" with "app/public"
        $newPath_a = str_replace("storage", "app/public", $imagePath);
        $newPath_b = str_replace("storage", "app/public", $thumbnailImagePath);

        // Attempt to delete the blog
        $deleted = $news->delete();

        if ($deleted) {
            // Delete the associated images from storage
            // Now $newPath contains the updated path
            if ($newPath_a) {
                $imageFullPath = storage_path($newPath_a);
                if (file_exists($imageFullPath)) {
                    unlink($imageFullPath);
                }
            }
            if ($newPath_b) {
                $thumbnailImageFullPath = storage_path($newPath_b);
                if (file_exists($thumbnailImageFullPath)) {
                    unlink($thumbnailImageFullPath);
                }
            }
            return "success";
        } 
        else {
            return "error";
        }
    }
    // End: To Delete the newsfeed using newsId

    // Begin: To show the edit newsfeed page using news id from listing newsfeed page
    public function editNewsfeedView($newsId){
        // return $id;
        $news = NewsFeed::find($newsId);
        if(!$news){
            return redirect()->route('admin.newsfeeds.list-newsfeeds')->with('error','Invalid news you are trying to access');
        }
        return view('admin.NewsFeeds.edit-newsfeeds')->with(['news'=>$news]);
    }
    // End: To show the edit newsfeed page using news id from listing newsfeed page

    // Begin: To Update the whole newsfeed geetting post request from edit-newsfeed
    public function updateFullNewsfeed(Request $request){
        // Validate the form data
        // Setting common rules
        $commonRules = [
            'title' => 'required|max:255',
            'shortDescription' => 'required|max:255',
            'editor' => 'required',
            'status' => 'required|in:pending,published',
        ];
        
        if ($request->hasFile('image') && $request->hasFile('thumbnailImage')) {
            $imageRules = ['image' => 'required|image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048'];
            $thumbnailRules = ['thumbnailImage' => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|image|max:2048'];
        
            $validatedData = $request->validate(array_merge($commonRules, $imageRules, $thumbnailRules));
        } elseif ($request->hasFile('image')) {
            $imageRules = ['image' => 'required|image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048'];
        
            $validatedData = $request->validate(array_merge($commonRules, $imageRules));
        } elseif ($request->hasFile('thumbnailImage')) {
            $thumbnailRules = ['thumbnailImage' => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|image|max:2048'];
        
            $validatedData = $request->validate(array_merge($commonRules, $thumbnailRules));
        } else {
            $validatedData = $request->validate($commonRules);
        }

        // 
        $news = NewsFeed::find($request->id);
        if(!$news){
            return redirect()->route('admin.newsfeeds.list-newsfeeds')->with('error','You are accesing invalid news. Kindly acces the valid news to update');
        }
        if($news->title == $validatedData['title'] ){
            $uniqueSlug = $news->slug;
        }
        else{
            // Generate the initial slug from the title
            $slug = Str::slug($request->title);

            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);
        }
        $timestamp = now()->timestamp;
        if ($request->hasFile('image') && $request->hasFile('thumbnailImage')) {
            // Here we save both file and unlink the old file
            // Save the images
            $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $thumbnailImageFileName = $timestamp . '.' . $request->file('thumbnailImage')->getClientOriginalExtension();
            // Store the images in the 'public/newsfeed-images/image' folder
            $imagePath = "storage/newsfeed-images/image/".$imageFileName;
            $thumbnailImagePath = "storage/newsfeed-images/thumbnail/".$thumbnailImageFileName;
            $request->file('image')->storeAs('public/newsfeed-images/image', $imageFileName);
            $request->file('thumbnailImage')->storeAs('public/newsfeed-images/thumbnail', $thumbnailImageFileName);
            // 

            // Get the paths for image deletion
            $imagePath_Old = $news->image_path;
            $thumbnailImagePath_Old = $news->thumbnail_image_path;

            // Replace "storage" with "app/public"
            $newPath_a_Old = str_replace("storage", "app/public", $imagePath_Old);
            $newPath_b_Old = str_replace("storage", "app/public", $thumbnailImagePath_Old);

            // Unlink the file
            if ($newPath_a_Old) {
                $imageFullPath_Old = storage_path($newPath_a_Old);
                if (file_exists($imageFullPath_Old)) {
                    unlink($imageFullPath_Old);
                }
            }
            if ($newPath_b_Old) {
                $thumbnailImageFullPath_Old = storage_path($newPath_b_Old);
                if (file_exists($thumbnailImageFullPath_Old)) {
                    unlink($thumbnailImageFullPath_Old);
                }
            }

            // Update the blog entry to the database
            $news->title = $validatedData['title'];
            $news->slug = $uniqueSlug; 
            $news->short_description = $validatedData['shortDescription'];
            $news->editor_content = $validatedData['editor'];
            $news->image_path = $imagePath;
            $news->thumbnail_image_path = $thumbnailImagePath;
            $news->featured_post = $request->has('featuredPost');
            $news->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $news->author_id = Auth::id();
            $news->updated_at = $timestamp;
            $news->save();


        } elseif ($request->hasFile('image')) {
            // Here we save the image file and unlink the old image file
            // Save the images
            $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            // Store the images in the 'public/newsfeed-images/image' folder
            $imagePath = "storage/newsfeed-images/image/".$imageFileName;
            $request->file('image')->storeAs('public/newsfeed-images/image', $imageFileName);
            // 

            // Get the paths for image deletion
            $imagePath_Old = $news->image_path;

            // Replace "storage" with "app/public"
            $newPath_a_Old = str_replace("storage", "app/public", $imagePath_Old);

            // Unlink the file
            if ($newPath_a_Old) {
                $imageFullPath_Old = storage_path($newPath_a_Old);
                if (file_exists($imageFullPath_Old)) {
                    unlink($imageFullPath_Old);
                }
            }
            // Update the blog entry to the database
            $news->title = $validatedData['title'];
            $news->slug = $uniqueSlug; 
            $news->short_description = $validatedData['shortDescription'];
            $news->editor_content = $validatedData['editor'];
            $news->image_path = $imagePath;
            $news->featured_post = $request->has('featuredPost');
            $news->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $news->author_id = Auth::id();
            $news->updated_at = $timestamp;
            $news->save();

        } elseif ($request->hasFile('thumbnailImage')) {
            // Here we save the thumbnail image file and unlink the old thumbnail image file
            // Save the images
            $thumbnailImageFileName = $timestamp . '.' . $request->file('thumbnailImage')->getClientOriginalExtension();
            // Store the images in the 'public/newsfeed-images/image' folder
            $thumbnailImagePath = "storage/newsfeed-images/thumbnail/".$thumbnailImageFileName;
            $request->file('thumbnailImage')->storeAs('public/newsfeed-images/thumbnail', $thumbnailImageFileName);
            // 

            // Get the paths for image deletion
            $thumbnailImagePath_Old = $news->thumbnail_image_path;

            // Replace "storage" with "app/public"
            $newPath_b_Old = str_replace("storage", "app/public", $thumbnailImagePath_Old);

            // Unlink the file
            if ($newPath_b_Old) {
                $thumbnailImageFullPath_Old = storage_path($newPath_b_Old);
                if (file_exists($thumbnailImageFullPath_Old)) {
                    unlink($thumbnailImageFullPath_Old);
                }
            }

            // Update the blog entry to the database
            $news->title = $validatedData['title'];
            $news->slug = $uniqueSlug; 
            $news->short_description = $validatedData['shortDescription'];
            $news->editor_content = $validatedData['editor'];
            $news->thumbnail_image_path = $thumbnailImagePath;
            $news->featured_post = $request->has('featuredPost');
            $news->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $news->author_id = Auth::id();
            $news->updated_at = $timestamp;
            $news->save();

        } else {
            // Here updating the code we didn't add these two attributes
            // Update the blog entry to the database
            $news->title = $validatedData['title'];
            $news->slug = $uniqueSlug; 
            $news->short_description = $validatedData['shortDescription'];
            $news->editor_content = $validatedData['editor'];
            $news->featured_post = $request->has('featuredPost');
            $news->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $news->author_id = Auth::id();
            $news->updated_at = $timestamp;
            $news->save();
        }
        
        if(!$news){
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the news.Kindly try again']);
        }
        return redirect()->route('admin.newsfeeds.list-newsfeeds')->with('success', 'Newsfeed updated successfully!');
    }
    // End: To Update the whole newsfeed geetting post request from edit-newsfeed

}
