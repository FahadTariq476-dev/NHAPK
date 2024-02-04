<?php

namespace App\Http\Controllers\Frontend\Organogram;

use App\Http\Controllers\Controller;
use App\Models\Organogram;
use Exception;
use Illuminate\Http\Request;

class OrganogramFrontendController extends Controller
{
    /**
     * Function to show organogram.blade file
    */
    public function viewOrganogram(){
        try{
            $organograms = Organogram::where('status', 1)->latest()->with(['user', 'organogramDesignation'])->paginate(6);
            return view('frontEnd.organogram.view-organogram')->with([
                'organograms' => $organograms,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show details of organogram memebr using id
     */
    public function viewOrganogramMemberDetails($organogramMemberId){
        try{
            $organogram = Organogram::where('id', $organogramMemberId)->where('status',1)->with(['user', 'organogramDesignation'])->first();
            if(!($organogram)){
                return redirect()->back()->with('invalid', 'Your are accessing invalid Member. Kindly access the valid one.');
            };
            return view('frontEnd.organogram.view-detail-organogram')->with([
                'organogram' => $organogram,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }


}
