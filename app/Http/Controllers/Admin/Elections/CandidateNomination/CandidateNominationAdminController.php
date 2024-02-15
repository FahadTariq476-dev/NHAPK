<?php

namespace App\Http\Controllers\Admin\Elections\CandidateNomination;

use Exception;
use App\Models\User;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Membership;
use App\Models\ElectionSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

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

    /**
     * Function to show save candidate nomination from admin
     */
    public function post(){
        try{
            $elections = Election::where('status','on')->get();
            return view('admin.elections.candidate-nomination.post-candidate-nomination')->with([
                'elections' => $elections,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    public function getElectionCategoriesSeatAndUser($electionId){
        try{
            $elections = Election::where('id', $electionId)->with(['electionCategory'])->first();
            if(!($elections)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one',
                ]);
            }
            // Decode electionSeatId
            $electionSeatIds = json_decode($elections->electionSeatId, true);

            // Check if $electionSeatIds is not null and is an array
            if ($electionSeatIds && is_array($electionSeatIds)) {
                // Load the electionSeats relationship based on decoded IDs
                $electionSeats = ElectionSeat::whereIn('id', $electionSeatIds)->get();
            } else {
                // If $electionSeatIds is not valid, set electionSeats to an empty array
                $electionSeats = [];
            }
            // Decode electionAreaIds
            $electionAreaIds = json_decode($elections->areaId, true);
            $users = User::whereIn('areaId', $electionAreaIds)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Details are:',
                'elections' => $elections,
                'users' => $users,
                'electionSeats' => $electionSeats,
            ], 200);


        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

    public function storeNomination(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->all());
            $rules = [
                'electionId' => 'required|exists:nhapk_elections,id',
                'electionCategoryId' => 'required|exists:nhapk_election_categories,id',
                'electionSeatId' => 'required|exists:nhapk_election_seats,id',
                'electionNomineeId' => 'required|exists:users,id',
                'candidateObjectives' => 'required|string|min:3',
                'candidateFile' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // PDF, JPEG, PNG, maximum 2MB
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $candidates = Candidate::where('userId', $request->electionNomineeId)->where('electionId', $request->electionId)->first();
            if($candidates){
                return redirect()->back()->with('warning','You have already applied. Kindly view your Nomination File.');
            }
            // dd("Yes");
            $referalNo = Membership::where('parent_id',$request->electionNomineeId)->count();
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
            $user = User::find($request->electionNomineeId);
            $candidate = new Candidate();
            $candidate->userId = $request->electionNomineeId;
            $candidate->stateId = $user->stateId;
            $candidate->cityId = $user->cityId;
            $candidate->electionCategoryId = $request->electionCategoryId;
            $candidate->electionId = $request->electionId;
            $candidate->electionSeatId = $request->electionSeatId;
            $candidate->hostelId = $user->hostel_name;
            $candidate->objectives = $request->candidateObjectives;
            $candidate->file = $filename;
            $candidate->referralCount = $referalNo;
            $candidate->stars = $stars." Stars";
            $result = $candidate->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the nomination file. Kindly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Nomination File Saved Now');
        }
        catch(ValidationException $validationException){
            return redirect()->back()->withErrors($validationException->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
}
