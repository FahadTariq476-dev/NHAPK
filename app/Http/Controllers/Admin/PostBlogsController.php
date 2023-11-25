<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        'shortDescription' => 'required',
        'fullDescription' => 'required',
        'editor' => 'required',
        'image' => 'required|image|max:2048', // Maximum 2MB for image
        'thumbnailImage' => 'required|image|max:2048',
        'status' => 'required|in:draft,published',
        'postCategory' => 'required',
    ]);

    try {
        // $author_id = Auth::id();
        $timestamp = now()->timestamp;

        // Save the images
        $imageFileName = $timestamp . '_' . $request->file('image')->getClientOriginalName();
        $thumbnailImageFileName = $timestamp . '_' . $request->file('thumbnailImage')->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('storage/blog-images/image', $imageFileName, 'public');
        $thumbnailImagePath = $request->file('thumbnailImage')->storeAs('storage/blog-images/thumbnail', $thumbnailImageFileName, 'public');

        // Save the blog entry to the database
        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->short_description = $validatedData['shortDescription'];
        $blog->full_description = $validatedData['fullDescription'];
        $blog->editor_content = $validatedData['editor'];
        $blog->image_path = $imagePath;
        $blog->thumbnail_image_path = $thumbnailImagePath;
        $blog->featured_post = $request->has('featuredPost');
        $blog->status = $validatedData['status'];
        $blog->post_category = $validatedData['postCategory'];

        // Associate the blog with the authenticated user
        $blog->author_id = Auth::id();

        $blog->save();

        return redirect()->route('admin.post-blogs')->with('success', 'Blog entry created successfully!');
    } catch (\Exception $e) {
        // Handle any exceptions, such as database errors or image upload failures
        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the blog entry.']);
    }
   
    }
}
