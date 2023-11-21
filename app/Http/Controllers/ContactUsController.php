<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    //
    public function showContactUsForm(){
        return view('frontEnd.contact');
        // return view('contactus');
    }
    public function saveData(Request $req){
        //
        // return $req;
        dd($req->toArray());
        $name = $req->name;
        $mob_no = "+923".$req->mob_no;
        $email = $req->email;
        $message = $req->message;
        
        $contactUs = new ContactUs();
        $contactUs->name = $name;
        $contactUs->mob_no = $mob_no;
        $contactUs->email = $email;
        $contactUs->message = $message;
        $result = $contactUs->save();
        if(!$result){
            return redirect()->route('ContactUsForm')->with('error', 'Your message is not saved. Kindly submit again.');
        }
        else{
            return redirect()->route('ContactUsForm')->with('success', 'Your Meesage Has Been Saved. We will contact you as soon as poosible in the working hous');
        }
        
    }
}
