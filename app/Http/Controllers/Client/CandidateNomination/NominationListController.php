<?php

namespace App\Http\Controllers\Client\CandidateNomination;

use Exception;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;

class NominationListController extends Controller
{
    /**
     * Function to show nominee-list.blade.php
     */
    public function list(){
        try{
            // echo Auth::user()->areaId;
            // $userAreaId = [Auth::user()->areaId];
            // $candidates = Candidate::where('status','approved')->with('user')->get();
            $electionsLists = Election::where('status','on')->get();
            $matchedElections = [];
            foreach($electionsLists as $election){
                $decodedAreaIds = json_decode($election->areaId, true);

                if (in_array(Auth::user()->areaId, $decodedAreaIds)) {
                    $matchedElections[] = $election;
                }
                
            }
            // dd($electionsLists);
            return view('client.nominee-list.nominee-list')->with([
                'electionsLists' => $matchedElections,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
}
