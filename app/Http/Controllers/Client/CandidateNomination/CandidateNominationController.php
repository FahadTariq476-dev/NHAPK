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
            $candidates = Candidate::where('userId', Auth::id())->first();
            if($candidates){
                return redirect()->route('client.dashboard.index')->with('warning','You have already applied. Kindly view your Nomination File.');
            }
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
            }
            // dd($usersAll->toArray());
            $electionCategories = ElectionsCategroy::where('status',1)->get();
            $elections = Election::where('status','on')->get();
            return view('client.election-nomination.post-nomination')->with([
                'electionCategories' => $electionCategories,
                'elections' => $elections,
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
            // dd($request->all());
            $candidates = Candidate::where('userId', Auth::id())->first();
            if($candidates){
                return redirect()->route('client.dashboard.index')->with('warning','You have already applied. Kindly view your Nomination File.');
            }
            $rules = [
                'electionCategoryId' => 'required|exists:nhapk_election_categories,id',
                'electionId' => 'required|exists:nhapk_elections,id',
                'candidateFile' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // PDF, JPEG, PNG, maximum 2MB
            ];
            $this->validate($request,$rules);
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
            // Retrieve related data using relationships
            $stateName = ($candidate->state) ? $candidate->state->name : null;
            $cityName = ($candidate->city) ? $candidate->city->name : null;
            $electionCategoryName = ($candidate->electionCategory) ? $candidate->electionCategory->name : null;
            $electionName = ($candidate->election) ? $candidate->election->name : null;
            DB::commit();
            return view('client.election-nomination.view-nomination')->with([
                'candidate' => $candidate,
                'stateName' => $stateName,
                'cityName' => $cityName,
                'electionCategoryName' => $electionCategoryName,
                'electionName' => $electionName,
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
            $candidate = Candidate::find($id);
            if(!($candidate)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid candidate. Kindly acccess the valid one.',
                ]);
            }
            else{
                $user = $candidate->user;
                $electionCategory = $candidate->electionCategory;
                $election = $candidate->election;
                $country= $user->country;
                $state= $user->state;
                $city= $user->state;
                // dd($country->toArray());
                // dd($user->toArray());
                return response()->json([
                    'status' => 'success',
                    'message' => 'Details are',
                    'user' => $user,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'electionCategory' => $electionCategory,
                    'election' => $election,
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
}
