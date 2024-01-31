<?php

namespace App\Http\Controllers\Admin\Elections;

use Exception;
use App\Models\Vote;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ElectionsResultAdminController extends Controller
{
    /**
     * Function to election result blade
     */
    public function index(){
        try{
            $elections = Election::where('status','expired')->get();
            return view('admin.elections.result.view-result-election')->with([
                'elections' => $elections,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to calculate result
     */
    public function calculateResult(Request $request){
        try{
            // dd($request->all());
            $elections = Election::where('id',$request->electionId)->where('status','expired')->first();
            if(!($elections)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid elections. Kindly access the valid one',
                ], 500);
            }
            $votes = Vote::where('electionId', $request->electionId)->get();
            // Initialize an associative array to store the count of votes for each candidate
            $result = [];

            // Loop through the votes and count the votes for each candidate
            foreach ($votes as $vote) {
                $candidateId = $vote->candidateId;

                if (!isset($result[$candidateId])) {
                    $result[$candidateId] = [
                        'id' => $candidateId,
                        'candidateName' => $vote->candidate->user->name,
                        'candidateCnic' => $vote->candidate->user->cnic_no,
                        'candidatePhoneNumb' =>$vote->candidate->user->phone_number,
                        'electionCategoryName' => $vote->electionCategory->name,
                        'electionName' => $vote->election->name,
                        'numVotes' => 1, // Initialize the vote count for the candidate
                    ];
                } else {
                    $result[$candidateId]['numVotes']++; // Increment the vote count for the candidate
                }
            }

            // Convert the associative array to indexed array
            $result = array_values($result);

            return response()->json([
                'status' => 'success',
                'message' => 'Result calculated successfully.',
                'result' => $result,
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
