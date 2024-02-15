<?php

namespace App\Http\Controllers\Admin\Elections\ElectionsSeat;

use App\Http\Controllers\Controller;
use App\Models\ElectionSeat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ElectionsSeatController extends Controller
{
    /**
     * Function to show post election seat blade file
     */
    public function post(){
        try{
            return view('admin.elections.election-seats.post-election-seats');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show list 
     */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $electionSeats = ElectionSeat::all();
                return  DataTables::of($electionSeats)
                ->addIndexColumn()
                ->make(true);
            }
            return view('admin.elections.election-seats.list-election-seats');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store election seat in table
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'title' => 'required|string|min:3|max:255|unique:nhapk_election_seats,title',
            ];
            $this->validate($request, $rules);
            $electionSeats = new ElectionSeat();
            $electionSeats->title = $request->title;
            $electionSeats->description = $request->description;
            $result =  $electionSeats->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the election seats. Kindly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully! Election Seat Saved Now');
        }
        catch(ValidationException $validationException){
            return redirect()->back()->withErrors($validationException->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
    
    /**
     * Function to update election seat in table
     */
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $electionSeatId = $request->electionSeatId;
            $electionSeats = ElectionSeat::find($electionSeatId);
            if(!($electionSeats)){
                return redirect()->route('admin.electionSeats.list')->with('invalid','Your are accessing invalid Election Seat Kindly access the valid one.');
            }
            $rules = [
                'title' => ['required','string','min:3','max:255', Rule::unique('nhapk_election_seats', 'title')->ignore($electionSeatId),],
            ];
            $this->validate($request, $rules);
            $electionSeats->title = $request->title;
            $electionSeats->description = $request->description;
            $result =  $electionSeats->save();
            if(!($result)){
                DB::commit();
                return redirect()->route('admin.electionSeats.list')->with('error','There is an error while updating the election seats. Kindly try again.');
            }
            DB::commit();
            return redirect()->route('admin.electionSeats.list')->with('success','Successfully! Election Seat Updated Now');
        }
        catch(ValidationException $validationException){
            return redirect()->back()->withErrors($validationException->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show edit election seat
     */
    public function edit($electionSeatId){
        try{
            $electionSeats = ElectionSeat::find($electionSeatId);
            if(!($electionSeats)){
                return redirect()->back()->with('invalid','You are accessing invalid Election Seats. Kindly access the valid one.');
            }
            return view('admin.elections.election-seats.edit-election-seats')->with([
                'electionSeats' => $electionSeats,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to update the status of election seats
    */
    public function updateStatus($electionSeatId){
        try{
            $electionSeats = ElectionSeat::find($electionSeatId);
            if(!($electionSeatId)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Election Seat. Kindly access the valid one.',
                ]);
            }
            if($electionSeats->status == 1){
                $electionSeats->status = 0;
            }
            else if($electionSeats->status == 0){
                $electionSeats->status = 1;
            }
            else{
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid status of Election Seat. Kindly access the valid one.',
                ]);
            }
            $result = $electionSeats->save();
            if(!($result)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of election seat. Kindly try again.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Successfuly! Elections Seat Status Updated Now',
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to update the status of election seats
    */
    public function delete($electionSeatId){
        try{
            $electionSeats = ElectionSeat::find($electionSeatId);
            if(!($electionSeatId)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Election Seat. Kindly access the valid one.',
                ]);
            }
            $result = $electionSeats->delete();
            if(!($result)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while deleting the status of election seat. Kindly try again.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Successfuly! Elections Seat Status Deleted Now',
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
}
