<?php

namespace App\Http\Controllers\Client\Votes;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionsCategroy;
use App\Models\User;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

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

    public function showVotersList(Request $request){
        if($request->ajax()){

            $users = User::latest()->where('areaId',Auth::user()->areaId)->with(['area','properties'])->get();
            // $users = User::latest()->with(['area','properties'])->get();
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('name', function ($user) {
                if ($user->name === null) {
                    return 'Full Name is Not Provided';
                } else {
                    return $user->name;
                }
            })
            ->addColumn('area_name', function ($user) {
                if ($user->areaId === null) {
                    return 'Area is Not Selected';
                } else {
                    return $user->area ? $user->area->name : 'Area Name is not Provided';
                }
            })
            ->addColumn('hostel_name', function ($user) {
                return $user->properties ? $user->properties->name : 'Hostel Name is not Provided';
            })
            ->make(true);
        }
        return view('client.voter-list.voter-list');
    }

    /**
     * Fucntion to show candidate details for vote in modal
     */
    public function voteCandidateDetails($electionId){
        try{
            $elections = Election::where('status','on')->where('id', $electionId)->first();
            $electionSeatCount = count(json_decode($elections->electionSeatId));
            // echo count(json_decode($electionSeatId));
            // dd($electionSeatId);
            if(!($elections)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one.',
                ]);
            }
            $voter = Vote::where('userId', Auth::id())->where('electionId', $electionId)->get();
            if(count($voter)>0){
                return response()->json([
                    'status' => 'info',
                    'message' => 'Your Vote Has been already casted.',
                ]);
            }
            // $candidate = Candidate::where('electionId', $electionId)->where('userId', Auth::id())
            // ->with(['user.city', 'user.state', 'user.area', 'electionCategory', 'hostel', 'electionSeat'])
            // ->first();
            $candidatesForVote = Candidate::where('status','approved')->where('electionId',$electionId)
            ->with(['user.area', 'electionCategory', 'hostel', 'electionSeat'])
            ->get();
            // dd($candidatesForVote);
            if(!(count($candidatesForVote)>0)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'There is no candidate on this Election.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Select Your Candidate to Vote',
                'candidatesForVote' => $candidatesForVote,
                'electionSeatCount' => $electionSeatCount,
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
