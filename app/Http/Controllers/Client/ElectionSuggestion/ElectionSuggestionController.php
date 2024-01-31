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
                'viewCandidateId' => 'required|exists:nhapk_candidates,id',
                'suggestionType' => 'required|in:objection,suggestion',
                'suggestionTypeText' => 'required|string|min:3',
            ];
            $this->validate($request,$rules);
            $electionSuggestion = new ElectionSuggestion();
            $electionSuggestion->text = $request->suggestionTypeText;
            $electionSuggestion->suggestionType = $request->suggestionType;
            $electionSuggestion->candidateId = $request->viewCandidateId;
            $electionSuggestion->userId = Auth::id();
            $result = $electionSuggestion->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the suggestion. Kindly try again');
            }
            DB::commit();
            return redirect()->route('client.dashboard.index')->with('success','Your Suggestion Successfully Saved Now!');
        }
        catch(ValidationException $validationErrors){
            return redirect()->back()->withErrors($validationErrors->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
}
