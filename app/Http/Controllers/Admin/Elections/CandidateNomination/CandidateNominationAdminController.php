<?php

namespace App\Http\Controllers\Admin\Elections\CandidateNomination;

use Exception;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CandidateNominationAdminController extends Controller
{
    /**
     * Function to list the candiddate nomination 
     */
    public function index(Request $request){
        if($request->ajax()){
            $candidates = Candidate::latest()->get();
            return DataTables::of($candidates)->addIndexColumn()
            ->addColumn('user_name', function ($candidate) {
                return $candidate->user ? $candidate->user->name : 'Null';
            })
            ->addColumn('user_cnic_no', function ($candidate) {
                return $candidate->user ? $candidate->user->cnic_no : 'Null';
            })
            ->addColumn('user_phone_number', function ($candidate) {
                return $candidate->user ? $candidate->user->phone_number : 'Null';
            })
            ->addColumn('state_name', function ($candidate) {
                return $candidate->state ? $candidate->state->name : 'Null';
            })
            ->addColumn('city_name', function ($candidate) {
                return $candidate->city ? $candidate->city->name : 'Null';
            })
            ->addColumn('election_category_name', function ($candidate) {
                return $candidate->electionCategory ? $candidate->electionCategory->name : 'Null';
            })
            ->addColumn('election_name', function ($candidate) {
                return $candidate->election ? $candidate->election->name : 'Null';
            })
            ->make(true);
        }
        return view('admin.elections.candidate-nomination.list-candidate-nomination');
    }

    /**
     * Function to change the status of candidate
    */
    public function changeStatus($candidateId, $status){
        try{
            DB::beginTransaction();
            $allowedStatus = ['pending','working','approved','objection','rejected'];
            if(!(in_array($status, $allowedStatus))){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid status. Kindly access the valid one',
                ]);
            }
            $candidate = Candidate::find($candidateId);
            if(!($candidate)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid candidate. Kindly access the valid one',
                ]);
            }
            $candidate->status = $status;
            $result = $candidate->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of candidate. Kindly try again',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Candidate status updated now.',
            ]);
        }
        catch(Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }
}
