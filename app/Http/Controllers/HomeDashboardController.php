<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{
    //
    public function index(){
        $blogs = Blog::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        return view('frontEnd.index')->with(['blogs'=>$blogs]);
    }
}
