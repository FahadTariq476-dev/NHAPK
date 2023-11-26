<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogFrontEndController extends Controller
{
    //
    public function index(){
        // 
        $blogs = Blog::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        return view('frontEnd.blogs-view')->with(['blogs'=> $blogs]);
    }
    public function viewFullBlogById($slug){
        // echo $id;
        $blogs = Blog::where('slug',$slug)->where('status','published')->get();
        // dd($blog->toArray());
        // return "yes";
        return view('frontEnd.blogDetailed-view')->with(['blogs'=> $blogs]);
    }
}
