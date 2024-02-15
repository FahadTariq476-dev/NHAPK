<?php

namespace App\Http\Controllers\Client\CandidateNomination;

use Exception;
use App\Models\Country;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\ElectionsCategroy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\HosteliteMeta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CandidateNominationController extends Controller
{
    /**
     * Function to show post nomination blade php
    */
    public function post(){
        try{
            $usersAll = User::where('id',Auth::id())->with(['country','state','city'])->first();
            if($usersAll->countryId == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Select Country First. And Complete Your Profile section');
            }
            else if($usersAll->stateId == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Select State First. And Complete Your Profile section');
            }
            else if($usersAll->cityId == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Select City First. And Complete Your Profile section');
            }
            else if($usersAll->address == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Provide Your Address First. And Complete Your Profile section');
            }
            else if($usersAll->short_description == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Provide Your Short Description First. And Complete Your Profile section');
            }
            else if($usersAll->picture_path == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Provide Your Profile Picture First. And Complete Your Profile section');
            }else if($usersAll->hostel_name == null){
                return redirect()->route('client.viewProfile')->with('info','Kindly Provide Your Hostel Name First. And Complete Your Profile section');
            }
            // dd($usersAll->toArray());
            $elections = Election::where('status','on')->get();
            // dd($elections);
            $matchedElections = [];
            foreach($elections as $election){
                $decodedAreaIds = json_decode($election->areaId, true);

                if (in_array(Auth::user()->areaId, $decodedAreaIds)) {
                    $matchedElections[] = $election;
                }
                
            }
            return view('client.election-nomination.post-nomination')->with([
                'elections' => $matchedElections,
                'usersAll' => $usersAll,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store nomination
    */
    public function  store(Request $request){
        try{
            DB::beginTransaction();
            $users = Auth::user();
            $hostelId = $users->hostel_name;
            // dd($request->all());
            $candidates = Candidate::where('userId', Auth::id())->where('electionId', $request->electionId)->first();
            if($candidates){
                return redirect()->route('client.dashboard.index')->with('warning','You have already applied. Kindly view your Nomination File.');
            }
            $rules = [
                'electionCategoryId' => 'required|exists:nhapk_election_categories,id',
                'electionId' => 'required|exists:nhapk_elections,id',
                'electionSeatId' => 'required|exists:nhapk_election_seats,id',
                'candidateObjectives' => 'required|string|min:3',
                'candidateFile' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // PDF, JPEG, PNG, maximum 2MB
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $referalNo = Membership::where('parent_id',Auth::id())->count();
            if ($referalNo == 0) {
                $stars = 0;
            } elseif ($referalNo >= 1 && $referalNo <= 6) {
                $stars = 1;
            } elseif ($referalNo >= 7 && $referalNo <= 31) {
                $stars = 2;
            } elseif ($referalNo >= 32 && $referalNo <= 156) {
                $stars = 3;
            } elseif ($referalNo >= 157 && $referalNo <= 781) {
                $stars = 4;
            } elseif ($referalNo >= 782 && $referalNo <= 3906) {
                $stars = 5;
            } else {
                $stars = 6; // Maximum stars, adjust as needed
            }
            // Handle user profile image
            if ($request->hasFile('candidateFile')) {
                // Upload and save the new profile image
                $filename = 'candidate_files_' . time() . '.' . $request->file('candidateFile')->getClientOriginalExtension();

                // Upload and save the new profile image
                $candidateFilePath = $request->file('candidateFile')->storeAs('candidate_files', $filename, 'public');

            }
            $candidate = new Candidate();
            $candidate->userId = Auth::id();
            $candidate->stateId = Auth::user()->stateId;
            $candidate->cityId = Auth::user()->cityId;
            $candidate->electionCategoryId = $request->electionCategoryId;
            $candidate->electionId = $request->electionId;
            $candidate->electionSeatId = $request->electionSeatId;
            $candidate->hostelId = $hostelId;
            $candidate->objectives = $request->candidateObjectives;
            $candidate->file = $filename;
            $candidate->referralCount = $referalNo;
            $candidate->stars = $stars." Stars";
            $result = $candidate->save();
            if(!($result)){
                DB::commit();
                return redirect()->route('client.dashboard.index')->with('error','There is an error while saving the nomination file. Kindly try again.');
            }
            DB::commit();
            return redirect()->route('client.dashboard.index')->with('success','Your Nomination File Saved Now');
        }
        catch(ValidationException $validationError){
            throw $validationError->validator->getMessageBag();
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to View the Nomination File
    */

    public function viewNomination(){
        try{
            DB::beginTransaction();
            $candidate = Candidate::where('userId',Auth::id())->first();
            if(!$candidate){
                return redirect()->back()->with('info','You did not Apply for Nomination.');
            }
            $elections = Election::all();
            DB::commit();
            return view('client.election-nomination.view-nomination')->with([
                'elections' => $elections,
            ]);
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function tp view the canidate details
    */
    public function viewCandidateDetails($id){
        try{
            $candidate = Candidate::where('id', $id)
            ->with(['user.city', 'user.state', 'user.area', 'electionCategory', 'hostel', 'electionSeat'])
            ->first();
            if(!($candidate)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid candidate. Kindly acccess the valid one.',
                ]);
            }
            else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Details are',
                    'candidate' => $candidate,
                ],200);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is; '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to view the canidate details using election id
    */
    public function viewCandidateDetailsUsingElectionId($electionId){
        try{
            $candidate = Candidate::where('electionId', $electionId)->where('userId', Auth::id())
            ->with(['user.city', 'user.state', 'user.area', 'electionCategory', 'hostel', 'electionSeat'])
            ->first();
            // dd($candidate->toArray());
            if(!($candidate)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid elections. Kindly acccess the valid one. You don\'t have any nomination file against this election.',
                ]);
            }
            else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Details are',
                    'candidate' => $candidate,
                ],200);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is; '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fucntion to show candidate details for vote in modal
     */
    public function voteCandidateDetailsForObjection($electionId){
        try{
            $elections = Election::where('status','on')->where('id', $electionId)->get();
            if(!(count($elections)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one.',
                ]);
            }
            $candidatesForVote = Candidate::where('electionId', $electionId)->where('status','approved')
            ->with(['user.city', 'user.state', 'user.area', 'electionCategory', 'hostel', 'electionSeat'])
            ->get();
            // $candidatesForVote = Candidate::where('status','approved')->where('electionId',$electionId)->where('electionCategoryId',$electionCategoryId)
            // ->with(['user.city'])
            // ->get();
            if(!(count($candidatesForVote)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'There is no candidate on this Election Category.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Select Your Candidate to View / Objection / Suggestion',
                'candidatesForVote' => $candidatesForVote,
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

}
