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
            $candidates = Candidate::where('status','approved')->with('user')->get();
            $electionCategories = ElectionsCategroy::where('status',1)->get();
            $elections = Election::where('status','on')->get();
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
     * Function to store the vote in db
    */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $votes = Vote::where('userId',Auth::id())->first();
            if($votes){
                DB::commit();
                return redirect()->route('client.dashboard.index')->with('info','Your vote has already been casted.');
            }
            $rules =[
                'candidateId' => 'required|exists:nhapk_candidates,id',
                'electionCategoryId' => 'required|exists:nhapk_election_categories,id',
                'electionId' => 'required|exists:nhapk_elections,id',
            ];
            $this->validate($request,$rules);
            // echo "Yes";
            // dd($request->all());
            $vote = new Vote();
            $vote->userId = Auth::id();
            $vote->candidateId = $request->candidateId;
            $vote->electionCategoryId = $request->electionCategoryId;
            $vote->electionId = $request->electionId;
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
