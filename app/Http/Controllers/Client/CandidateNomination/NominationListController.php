<?php

namespace App\Http\Controllers\Client\CandidateNomination;

use Exception;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NominationListController extends Controller
{
    /**
     * Function to show nominee-list.blade.php
     */
    public function list(){
        try{
            $candidates = Candidate::where('status','approved')->with('user')->get();
            return view('client.nominee-list.nominee-list')->with([
                'candidates' => $candidates,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
}
