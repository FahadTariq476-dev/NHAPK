<?php

namespace App\Http\Controllers\Client\Votes;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionsCategroy;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VoteController extends Controller
{
    /**
     * Function to show vote form
    */
    public function post(){
        try{
            $elections = Election::where('status','on')->get();
            if(!(count($elections)>0)){
                return redirect()->back()->with('info','Eelctions are Not Open Now!. Kindly Visit The Electiontion Schedule');
            }
            $candidates = Candidate::where('status','approved')->with('user')->get();
            $electionCategories = ElectionsCategroy::where('status',1)->get();
            return view('client.vote.post-vote')->with([
                'candidates' => $candidates,
                'electionCategories' => $electionCategories,
                'elections' => $elections,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Excpetion is: '.$e->getMessage());
        }
    }

    /**
     * Fucntion to show candidate details for vote in modal
     */
    public function voteCandidateDetails($electionId, $electionCategoryId){
        try{
            $elections = Election::where('status','on')->where('id', $electionId)->get();
            if(!(count($elections)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one.',
                ]);
            }
            $electionCategories = ElectionsCategroy::where('status',1)->where('id', $electionCategoryId)->get();
            if(!(count($electionCategories)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Election Category. Kindly access the valid one.',
                ]);
            }
            $voter = Vote::where('userId', Auth::id())->where('electionId', $electionId)->get();
            if(count($voter)>0){
                return response()->json([
                    'status' => 'info',
                    'message' => 'Your Vote Has been already casted.',
                ]);
            }
            $candidatesForVote = Candidate::where('status','approved')->where('electionId',$electionId)->where('electionCategoryId',$electionCategoryId)->with('user')->get();
            if(!(count($candidatesForVote)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'There is no candidate on this Election Category.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Select Your Candidate to Vote',
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

    /**
     * Function to store the vote in db
    */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $votes = Vote::where('userId',Auth::id())->where('electionId', $request->candidateElectionCategoryId)->first();
            if($votes){
                DB::commit();
                return redirect()->route('client.dashboard.index')->with('info','Your vote has already been casted.');
            }
            $candidatesForVote = Candidate::where('status','approved')
                ->where('electionId',$request->candidateElectionId)
                ->where('electionCategoryId',$request->candidateElectionCategoryId)
                ->where('id',$request->candidateId)
                ->with('user')->get();
            if(!(count($candidatesForVote)>0)){
                DB::commit();
                return redirect()->route('client.dashboard.index')->with('info','You are accessing invalid candidate. Kindly try with the valid one');
            }
            $vote = new Vote();
            $vote->userId = Auth::id();
            $vote->candidateId = $request->candidateId;
            $vote->electionCategoryId = $request->candidateElectionCategoryId;
            $vote->electionId = $request->candidateElectionId;
            $result = $vote->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while casting your vote. Kindly try again.');
            }
            DB::commit();
            return redirect()->route('client.dashboard.index')->with('success','Successfully! Your vote casted now.');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
}
