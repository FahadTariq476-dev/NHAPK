<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\NewsFeed;
use App\Models\Role;
use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{
    //
    public function index(){
        $roles = Role::where('nhapk_register',1)->get();
        $blogs = Blog::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        $news = NewsFeed::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        return view('frontEnd.index')->with([
            'blogs'=>$blogs, 
            'news'=>$news,
            'roles'=>$roles,
        ]);
    }
}
