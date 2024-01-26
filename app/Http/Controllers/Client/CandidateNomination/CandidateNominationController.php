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
            $countries = Country::all();
            $electionCategories = ElectionsCategroy::where('status',1)->get();
            $elections = Election::where('status','on')->get();
            return view('client.election-nomination.post-nomination')->with([
                'countries' => $countries,
                'electionCategories' => $electionCategories,
                'elections' => $elections,
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
                'countryId' => 'required|exists:countries,id',
                'stateId' => 'required|exists:states,id',
                'cityId' => 'required|exists:cities,id',
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
            $candidate->stateId = $request->stateId;
            $candidate->cityId = $request->cityId;
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
}
