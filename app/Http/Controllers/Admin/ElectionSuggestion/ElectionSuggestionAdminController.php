<?php

namespace App\Http\Controllers\Admin\ElectionSuggestion;

use Exception;
use Illuminate\Http\Request;
use App\Models\ElectionSuggestion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class ElectionSuggestionAdminController extends Controller
{
    /**
     * Function to list the Elction Suggestion
     */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $electionSuggestions = ElectionSuggestion::latest()->get();
                return DataTables::of($electionSuggestions)
                ->addIndexColumn()
                ->addColumn('user_name', function ($electionSuggestion) {
                    return $electionSuggestion->user ? $electionSuggestion->user->name : 'Null';
                })
                ->addColumn('user_cnic_no', function ($electionSuggestion) {
                    return $electionSuggestion->user ? $electionSuggestion->user->cnic_no : 'Null';
                })
                ->addColumn('candidate_name', function ($electionSuggestion) {
                    return $electionSuggestion->candidate->user->name ? $electionSuggestion->candidate->user->name : 'Null';
                })
                ->addColumn('candidate_cnic_no', function ($electionSuggestion) {
                    return $electionSuggestion->candidate->user->cnic_no ? $electionSuggestion->candidate->user->cnic_no : 'Null';
                })
                ->addColumn('candidate_phone_number', function ($electionSuggestion) {
                    return $electionSuggestion->candidate->user->phone_number ? $electionSuggestion->candidate->user->phone_number : 'Null';
                })
                ->addColumn('election_name', function ($electionSuggestion) {
                    return $electionSuggestion->candidate->electionCategory->name ? $electionSuggestion->candidate->electionCategory->name : 'Null';
                })
                ->addColumn('election_category_name', function ($electionSuggestion) {
                    return $electionSuggestion->candidate->election->name ? $electionSuggestion->candidate->election->name : 'Null';
                })
                ->make(true);
            }
            return view('admin.election-suggestion-objection.list-election-suggestion-objection');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to change the status of election suggetion
    */
    public function changeStatus($electionSuggestionId, $status){
        try{
            DB::beginTransaction();
            $validStatus = ['approved','pending','cancelled'];
            if(!(in_array($status,$validStatus))){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your accessing the invalid status. Kindly access the valid one.',
                ]);
            }
            $electionSuggestion = ElectionSuggestion::find($electionSuggestionId);
            if(!($electionSuggestion)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your accessing the invalid election suggestion. Kindly access the valid one.',
                ]);
            }
            $electionSuggestion->status = $status;
            $result = $electionSuggestion->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status. Kindly try again.',
                ]); 
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Status changed now.',
            ]); 
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' =>'error',
                'Message' =>'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }
}
