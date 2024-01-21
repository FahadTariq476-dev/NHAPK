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
        $allwoedrulesforLogin = 
        [
            'Who did not  decided  role yet',
            'I am Hostelites',
            'Hostel Working Staff eg. Made,  Helper, Doormen / Guard',
            'Admin / Manager / Cook / Warden',
            'Staff or Team Member of NHAP',
            'Sponsor / Supporter of NHAP',
            'Private Hostel Owner/ Antiusist',
        ];
        $roles = Role::where('nhapk_register',1)->whereIn('name',$allwoedrulesforLogin)->get();
        $blogs = Blog::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        $news = NewsFeed::where('status','published')->where('featured_post',1)->latest()->take(6)->get();
        return view('frontEnd.index')->with([
            'blogs'=>$blogs, 
            'news'=>$news,
            'roles'=>$roles,
        ]);
    }
}
