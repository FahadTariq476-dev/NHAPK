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
        $rules =[
            "name" => 'required|string|max:255',
            "mob_no" => 'required|numeric| digits:9',
            "email" => 'required|string|email',
            "message" => 'required |min:5|max:500',
            'g-recaptcha-response' => 'required|captcha',
        ];

        $messages = [
            'g-recaptcha-response.required' => 'Please complete the captcha.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed, please try again.',
        ];
        // return $req->mob_no;
        
        $this->validate($req, $rules, $messages);
        // dd($req->toArray());
        
        $contactUs = new ContactUs();
        $contactUs->name = $req->name;
        $contactUs->mob_no = "+923".$req->mob_no;
        $contactUs->email = $req->email;
        $contactUs->message = $req->message;
        $result = $contactUs->save();
        if(!$result){
            return redirect()->route('ContactUsForm')->with('error', 'Your message is not saved. Kindly submit again.');
        }
        else{
            return redirect()->route('ContactUsForm')->with('success', 'Your Meesage Has Been Saved. We will contact you as soon as poosible in the working hours');
        }
        
    }
}
