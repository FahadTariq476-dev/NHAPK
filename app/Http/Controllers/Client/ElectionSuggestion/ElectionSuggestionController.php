<?php

namespace App\Http\Controllers\Client\ElectionSuggestion;

use Exception;
use Illuminate\Http\Request;
use App\Models\ElectionSuggestion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ElectionSuggestionController extends Controller
{
    /**
     * Function to post data in election_suggestion table
     */
    public function post(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'suggestionCandidateId' => 'required|exists:nhapk_candidates,id',
                'suggestionType' => 'required|in:objection,suggestion',
                'suggestionText' => 'required|string|min:3',
            ];
            $this->validate($request,$rules);
            $electionSuggestionCheck = ElectionSuggestion::where('userId', Auth::id())->where('candidateId', $request->suggestionCandidateId)->first();
            if($electionSuggestionCheck){
                DB::commit();
                return response()->json([
                    'status' => 'info',
                    'message' => 'You have already suggest/object on this candidate.',
                ]);
            }
            $electionSuggestion = new ElectionSuggestion();
            $electionSuggestion->text = $request->suggestionText;
            $electionSuggestion->suggestionType = $request->suggestionType;
            $electionSuggestion->candidateId = $request->suggestionCandidateId;
            $electionSuggestion->userId = Auth::id();
            $result = $electionSuggestion->save();
            if (!($result)) {
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while saving the suggestion. Kindly try again',
                ], 500);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Your Suggestion Successfully Saved Now!',
            ], 200);
        }
        catch(ValidationException $validationErrors){ 
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validationErrors->validator->getMessageBag(),
            ], 422);
        }
        catch(Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
}
