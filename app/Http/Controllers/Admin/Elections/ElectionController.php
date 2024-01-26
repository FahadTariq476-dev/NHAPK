<?php

namespace App\Http\Controllers\Admin\Elections;

use Exception;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class ElectionController extends Controller
{
    /**
     * Function to show post election 
    */
    public function post(){
        try{
            return view('admin.elections.post-elections');
        }
        catch(Exception $e){
            return redirect()->back()->with('success','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * FUnction to  list the election
    */
    public function index(Request $request){
        try{
            if($request->ajax()){
                $currentTime = now()->setTimezone('Asia/Karachi')->toDateTimeString();
                $elections = Election::latest()->get();
                if($elections){
                    foreach($elections as $election){
                        if($currentTime >= $election->endDate){
                            $election->status = 'expired';
                            $election->save();
                        }
                    }
                }
                return DataTables::of($elections)->addIndexColumn()->make(true);
            }
            return view('admin.elections.list-elections');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store elections in db
    */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->all());
            $currentTime = now()->setTimezone('Asia/Karachi')->toDateTimeString();
            $minimumStartDate = now()->setTimezone('Asia/Karachi')->addDay()->toDateTimeString();
            $maximumEndDate = now()->setTimezone('Asia/Karachi')->parse($request->input('startDate'))->subDays(5)->toDateTimeString();
            $rules = [
                'name' => 'required|string|min:3|max:255|unique:nhapk_elections,name',
                'description' => 'required|string|min:3|max:255',
                'startDate' => [
                    'required',
                    'date',
                    'after_or_equal:' . $minimumStartDate,
                ],
                'lastDate' => [ 'required', 'date',
                'before_or_equal:' . $maximumEndDate,
                ],
                'endDate' => [
                    'required',
                    'date',
                    'after:startDate', // endDate must be after startDate
                ],
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $election = new Election();
            $election->name = $request->name;
            $election->description = $request->description;
            $election->lastDate = $request->lastDate;
            $election->startDate = $request->startDate;
            $election->endDate = $request->endDate;
            $result = $election->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the elections. Kidnly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully! Election saved now.');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show the edit elections
    */
    public function edit($electionId){
        try{
            $elections = Election::find($electionId);
            if(!($elections)){
                return redirect()->route('admin.elections.index')->with('invalid','You are accessing invalid elections. Kindly access the valid one.');
            }
            return view('admin.elections.edit-elections')->with([
                'elections' => $elections ,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
    /**
     * Function to update elections in db
    */
    public function update(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->all());
            $electionId = $request->electionId;
            $elections = Election::find($electionId);
            if(!($elections)){
                DB::commit();
                return redirect()->route('admin.elections.index')->with('invalid','You are accessing invalid elections. Kindly access the valid one.');
            }
            $minimumStartDate = now()->setTimezone('Asia/Karachi')->addDay()->toDateTimeString();
            $maximumEndDate = now()->setTimezone('Asia/Karachi')->parse($request->input('startDate'))->subDays(5)->toDateTimeString();
            $rules = [
                'name' => ['required','string','min:3','max:255', Rule::unique('nhapk_elections', 'name')->ignore($electionId),],
                'description' => 'required|string|min:3|max:255',
                'startDate' => [
                    'required',
                    'date',
                    'after_or_equal:' . $minimumStartDate,
                ],
                'lastDate' => [ 'required', 'date',
                'before_or_equal:' . $maximumEndDate,
                ],
                'endDate' => [
                    'required',
                    'date',
                    'after:startDate', // endDate must be after startDate
                ],
            ];
            $this->validate($request,$rules);
            $elections->name = $request->name;
            $elections->description = $request->description;
            $elections->lastDate = $request->lastDate;
            $elections->startDate = $request->startDate;
            $elections->endDate = $request->endDate;
            $elections->status = 'off';
            $result = $elections->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while updating the elections. Kidnly try again.');
            }
            DB::commit();
            return redirect()->route('admin.elections.index')->with('success','Successfully! Election updated now.');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to delete the elections
    */
    public function delete($electionId){
        try{
            DB::beginTransaction();
            $election = Election::find($electionId);
            if(!($election)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one.',
                ]);
            }else{
                $result = $election->delete();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while deleting the elections. Kidnly try again.',
                    ]);
                }else{
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Successfully! Election deleted now.',
                    ]);
                }
            }
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }
    
    /**
     * Function to uniqueName the elections
    */
    public function uniqueName($electionName){
        try{
            DB::beginTransaction();
            $election = Election::where('name',$electionName)->get();
            if(count($election)>0){
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Election Name already Exist. Kindly Use the Unique Name',
                ]);
            }else{
                DB::commit();
                return response()->json([
                    'status' => 0,
                    'message' => 'Election Name is Unique.',
                ]);
            }
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }

    /**
     * Function to change status of election
    */
    public function changeStatus($electionId){
        try{
            DB::beginTransaction();
            $election = Election::find($electionId);
            if(!$election){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one.',
                ]);
            }
            if($election->status == 'on'){
                $election->status = 'off';
            }
            else if ($election->status == 'off'){
                $election->status = 'on';
            }
            else{
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections status. Kindly access the valid one.',
                ]);
            }
            $result = $election->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of elections. Kidnly try again.',
                ]);
            }else{
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully! Election status updated now.',
                ]);
            }
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }

}
