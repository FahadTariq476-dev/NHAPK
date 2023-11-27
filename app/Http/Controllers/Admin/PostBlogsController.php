<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostBlogsController extends Controller
{
    //
    public function index(){
        return view('admin.post-blogs');
    }

    // 
    public function saveBlogPost(Request $request){
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

    // Generate the initial slug from the title
    $slug = Str::slug($request->title);

    // Make the slug unique
    $uniqueSlug = $this->makeSlugUnique($slug);
    // return "Slug: " . $uniqueSlug;
    
    $timestamp = now()->timestamp;
    // Save the images
    $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
    $thumbnailImageFileName = $timestamp . '.' . $request->file('thumbnailImage')->getClientOriginalExtension();
    // Store the images in the 'public/blog-images/image' folder
    $imagePath = "storage/blog-images/image/".$imageFileName;
    $thumbnailImagePath = "storage/blog-images/thumbnail/".$thumbnailImageFileName;
    $request->file('image')->storeAs('public/blog-images/image', $imageFileName);
    $request->file('thumbnailImage')->storeAs('public/blog-images/thumbnail', $thumbnailImageFileName);
    // Save the blog entry to the database
    $blog = new Blog();
    $blog->title = $validatedData['title'];
    $blog->slug = $uniqueSlug; 
    $blog->short_description = $validatedData['shortDescription'];
    $blog->editor_content = $validatedData['editor'];
    $blog->image_path = $imagePath;
    $blog->thumbnail_image_path = $thumbnailImagePath;
    $blog->featured_post = $request->has('featuredPost');
    $blog->status = $validatedData['status'];
    // Associate the blog with the authenticated user
    $blog->author_id = Auth::id();

    $blog->save();

    // return redirect()->route('admin.post-blogs')->with('success', 'Blog entry created successfully!');
    
    if(!$blog){
        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the blog entry.']);
    }
    return redirect()->route('admin.post-blogs')->with('success', 'Blog entry created successfully!');
    }

    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingBlog = Blog::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingBlog) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }



    public function listBlogView(){
        return view('admin.list-blogs');
    }

    public function adminListingPostedBlogs(Request $request){
        // 
        // return $request
        if($request->ajax()){
            $blogs = Blog::latest()->get();
            return DataTables::of($blogs)->addIndexColumn()->make(true);
        }
        return abort(403, 'Unathorized action');
    }
    public function updatePostStatus($status,$blogId){
        // 
        $validStatuses = ['pending', 'published'];

        // Check if the given $status is in the array of valid statuses
        if (!(in_array($status, $validStatuses))) {
            return 'error';
        }
        $blog = Blog::find($blogId);
        if(!$blog){
            return "error";
        }
        $blog->status = $status;
        $blog->save();
        return 'success';
    }

    public function deleteBlog($id){
        // Find the blog by ID
        $blog = Blog::find($id);

        // Check if the blog exists
        if (!$blog) {
            return "error";
        }

        // Get the paths for image deletion
        $imagePath = $blog->image_path;
        $thumbnailImagePath = $blog->thumbnail_image_path;

        // Replace "storage" with "app/public"
        $newPath_a = str_replace("storage", "app/public", $imagePath);
        $newPath_b = str_replace("storage", "app/public", $thumbnailImagePath);

        // Attempt to delete the blog
        $deleted = $blog->delete();

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

    // 
    public function editBlogView($id){
        // return $id;
        $blogs = Blog::find($id);
        if(!$blogs){
            return redirect()->route('admin.list-blogs');
        }
        return view('admin.edit-blogs')->with(['blogs'=>$blogs]);
    }

    public function updateFullBlog(Request $request){
        // Validate the form data
        // if ($request->hasFile('image') && $request->hasFile('thumbnailImage')) {
        //     $validatedData = $request->validate([
        //         'title' => 'required|max:255',
        //         'shortDescription' => 'required|max:255',
        //         'editor' => 'required',
        //         'image' => 'required|image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048', // Maximum 2MB for image
        //         'thumbnailImage' => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|image|max:2048',
        //         'status' => 'required|in:pending,published',
        //     ]);
        // } elseif ($request->hasFile('image')) {
        //     $validatedData = $request->validate([
        //         'title' => 'required|max:255',
        //         'shortDescription' => 'required|max:255',
        //         'editor' => 'required',
        //         'image' => 'required|image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048', // Maximum 2MB for image
        //         'status' => 'required|in:pending,published',
        //     ]);
        // } elseif ($request->hasFile('thumbnailImage')) {
        //     $validatedData = $request->validate([
        //         'title' => 'required|max:255',
        //         'shortDescription' => 'required|max:255',
        //         'editor' => 'required',
        //         'thumbnailImage' => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG|image|max:2048',
        //         'status' => 'required|in:pending,published',
        //     ]);
        // } else {
        //     $validatedData = $request->validate([
        //         'title' => 'required|max:255',
        //         'shortDescription' => 'required|max:255',
        //         'editor' => 'required',
        //         'status' => 'required|in:pending,published',
        //     ]);
        // }
        

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


        $blog = Blog::find($request->id);
        if(!$blog){
            return redirect()->route('admin.list-blogs');
        }
        if($blog->title == $validatedData['title'] ){
            $uniqueSlug = $blog->slug;
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
            // Store the images in the 'public/blog-images/image' folder
            $imagePath = "storage/blog-images/image/".$imageFileName;
            $thumbnailImagePath = "storage/blog-images/thumbnail/".$thumbnailImageFileName;
            $request->file('image')->storeAs('public/blog-images/image', $imageFileName);
            $request->file('thumbnailImage')->storeAs('public/blog-images/thumbnail', $thumbnailImageFileName);
            // 

            // Get the paths for image deletion
            $imagePath_Old = $blog->image_path;
            $thumbnailImagePath_Old = $blog->thumbnail_image_path;

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
            $blog->title = $validatedData['title'];
            $blog->slug = $uniqueSlug; 
            $blog->short_description = $validatedData['shortDescription'];
            $blog->editor_content = $validatedData['editor'];
            $blog->image_path = $imagePath;
            $blog->thumbnail_image_path = $thumbnailImagePath;
            $blog->featured_post = $request->has('featuredPost');
            $blog->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $blog->author_id = Auth::id();
            $blog->updated_at = $timestamp;
            $blog->save();


        } elseif ($request->hasFile('image')) {
            // Here we save the image file and unlink the old image file
            // Save the images
            $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            // Store the images in the 'public/blog-images/image' folder
            $imagePath = "storage/blog-images/image/".$imageFileName;
            $request->file('image')->storeAs('public/blog-images/image', $imageFileName);
            // 

            // Get the paths for image deletion
            $imagePath_Old = $blog->image_path;

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
            $blog->title = $validatedData['title'];
            $blog->slug = $uniqueSlug; 
            $blog->short_description = $validatedData['shortDescription'];
            $blog->editor_content = $validatedData['editor'];
            $blog->image_path = $imagePath;
            $blog->featured_post = $request->has('featuredPost');
            $blog->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $blog->author_id = Auth::id();
            $blog->updated_at = $timestamp;
            $blog->save();



        } elseif ($request->hasFile('thumbnailImage')) {
            // Here we save the thumbnail image file and unlink the old thumbnail image file
            // Save the images
            $thumbnailImageFileName = $timestamp . '.' . $request->file('thumbnailImage')->getClientOriginalExtension();
            // Store the images in the 'public/blog-images/image' folder
            $thumbnailImagePath = "storage/blog-images/thumbnail/".$thumbnailImageFileName;
            $request->file('thumbnailImage')->storeAs('public/blog-images/thumbnail', $thumbnailImageFileName);
            // 

            // Get the paths for image deletion
            $thumbnailImagePath_Old = $blog->thumbnail_image_path;

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
            $blog->title = $validatedData['title'];
            $blog->slug = $uniqueSlug; 
            $blog->short_description = $validatedData['shortDescription'];
            $blog->editor_content = $validatedData['editor'];
            $blog->thumbnail_image_path = $thumbnailImagePath;
            $blog->featured_post = $request->has('featuredPost');
            $blog->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $blog->author_id = Auth::id();
            $blog->updated_at = $timestamp;
            $blog->save();


        } else {
            // Here updating the code we didn't add these two attributes
            // Update the blog entry to the database
            $blog->title = $validatedData['title'];
            $blog->slug = $uniqueSlug; 
            $blog->short_description = $validatedData['shortDescription'];
            $blog->editor_content = $validatedData['editor'];
            $blog->featured_post = $request->has('featuredPost');
            $blog->status = $validatedData['status'];
            // Associate the blog with the authenticated user
            $blog->author_id = Auth::id();
            $blog->updated_at = $timestamp;
            $blog->save();
        }
        
        if(!$blog){
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the blog entry.']);
        }
        return redirect()->route('admin.list-blogs')->with('success', 'Blog updated successfully!');
    }
}
