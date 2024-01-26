<?php

namespace App\Http\Controllers\Admin\Votes;

use Exception;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class VoteAdminController extends Controller
{
    /**
     * Function to list the votes
    */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $candidates = Vote::latest()->get();
                return DataTables::of($candidates)->addIndexColumn()
                ->addColumn('voter_name', function ($vote) {
                    return $vote->user ? $vote->user->name : 'Null';
                })
                ->addColumn('voter_cnic', function ($vote) {
                    return $vote->user ? $vote->user->cnic_no : 'Null';
                })
                ->addColumn('candidate_name', function ($vote) {
                    return $vote->candidate && $vote->candidate->user ? $vote->candidate->user->name : 'Null';
                })
                ->addColumn('candidate_cnic', function ($vote) {
                    return $vote->candidate && $vote->candidate->user ? $vote->candidate->user->cnic_no : 'Null';
                })
                ->addColumn('election_category_name', function ($vote) {
                    return $vote->electionCategory ? $vote->electionCategory->name : 'Null';
                })
                ->addColumn('election_name', function ($vote) {
                    return $vote->election ? $vote->election->name : 'Null';
                })
                ->make(true);
            }
            return view('admin.votes.list-vote');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
}
