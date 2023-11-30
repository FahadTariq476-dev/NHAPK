<?php

namespace App\Http\Controllers;

use App\Models\NewsFeed;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    //
    // Begin: To show all the published news with pagination
    public function index(){
        // 
        // $blogs = Blog::where('status','published')->latest()->get();
        $news = NewsFeed::where('status','published')->latest()->paginate(6);
        return view('frontEnd.newsfeeds-view')->with(['news'=> $news]);
    }
    // End: To show all the published news with pagination
    
    // Begin: To show all the details of published new requested from newsfeed-view
    public function viewFullNewsfeedBySlug($slug){
        $news = NewsFeed::where('slug',$slug)->where('status','published')->get();
        if(count($news)>0){
            return view('frontEnd.newsfeeds-view-detailed')->with(['news'=> $news]);
        }
        else{
            return redirect()->route('frontEnd.newsfeeds-view')->with(['error','You are tring to access invalid news. Kindly try the valid']);
        }
        return view('frontEnd.newsfeeds-view-detailed')->with(['news'=> $news]);
    }
}
