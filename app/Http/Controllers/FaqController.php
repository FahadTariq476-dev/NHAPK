<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index(){
        $faqs = FAQ::where('status','active')->latest()->get();
        // dd($faqs->toArray());
        return view('frontEnd.faqs.faq-view')->with(['faqs' => $faqs]);
    }
}
