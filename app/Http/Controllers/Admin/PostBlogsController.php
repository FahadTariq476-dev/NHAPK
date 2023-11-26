<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PostBlogsController extends Controller
{
    //
    public function index(){
        return view('admin.post-blogs');
    }
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
    
    $timestamp = now()->timestamp;
    // Save the images
    $imageFileName = $timestamp . '_' . $request->file('image')->getClientOriginalName();
    $thumbnailImageFileName = $timestamp . '_' . $request->file('thumbnailImage')->getClientOriginalName();
    // Store the images in the 'public/blog-images/image' folder
    $imagePath = $request->file('image')->storeAs('public/blog-images/image', $imageFileName);
    $thumbnailImagePath = $request->file('thumbnailImage')->storeAs('public/blog-images/thumbnail', $thumbnailImageFileName);

    // Save the blog entry to the database
    $blog = new Blog();
    $blog->title = $validatedData['title'];
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
}
