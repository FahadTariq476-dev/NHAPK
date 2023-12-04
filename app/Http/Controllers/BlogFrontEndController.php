<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogFrontEndController extends Controller
{
    //
    public function index(){
        // 
        // $blogs = Blog::where('status','published')->latest()->get();
        $blogs = Blog::where('status','published')->latest()->paginate(6);
        return view('frontEnd.blogs.blogs-view')->with(['blogs'=> $blogs]);
    }
    public function viewFullBlogById($slug){
        $blogs = Blog::where('slug',$slug)->where('status','published')->get();
        return view('frontEnd.blogs.blog-detailed-view')->with(['blogs'=> $blogs]);
    }
}
