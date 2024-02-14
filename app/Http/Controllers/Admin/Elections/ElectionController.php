<?php

namespace App\Http\Controllers\Admin\Elections;

use App\Http\Controllers\Client\CandidateNomination\CandidateNominationController;
use Exception;
use App\Models\Election;
use App\Models\Country;
use App\Models\Area;
use App\Models\ElectionsCategroy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\City;
use App\Models\ElectionSeat;
use App\Models\State;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class ElectionController extends Controller
{
    /**
     * Function to show post election 
    */
    public function post(){
        try{
            $countries = Country::all();
            $electionCategories = ElectionsCategroy::all();
            $electionSeats = ElectionSeat::all();
            return view('admin.elections.post-elections')->with([
                'countries' =>$countries,
                'electionCategories' =>$electionCategories,
                'electionSeats' =>$electionSeats,
            ]);
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
                return DataTables::of($elections)
                ->addIndexColumn()
                ->addColumn('stateName', function ($election) {
                    return $election->state ? $election->state->name : 'Null';
                })
                ->addColumn('cityName', function ($election) {
                    return $election->city ? $election->city->name : 'Null';
                })
                ->addColumn('electionCategoryName', function ($election) {
                    return $election->electionCategory ? $election->electionCategory->name : 'Null';
                })
                ->addColumn('areaNames', function ($election) {
                    // Decode JSON data and get area names
                    $areaIds = json_decode($election->areaId, true); // Decode as an associative array
                    if ($areaIds) {
                        $areaNames = Area::whereIn('id', $areaIds)->pluck('name')->implode(', ');
                        return $areaNames ?: 'Null';
                    } else {
                        return 'Null';
                    }
                })
                ->addColumn('electionSeats', function ($election) {
                    // Decode JSON data and get area names
                    $electionSeatIds = json_decode($election->electionSeatId, true); // Decode as an associative array
                    if ($electionSeatIds) {
                        $areaNames = ElectionSeat::whereIn('id', $electionSeatIds)->pluck('title')->implode(', ');
                        return $areaNames ?: 'Null';
                    } else {
                        return 'Null';
                    }
                })
                ->make(true);
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
            $maximumaAplyStartDateDate = now()->setTimezone('Asia/Karachi')->parse($request->input('lastDate'))->subDays(1)->toDateTimeString();
            // return $maximumaAplyStartDateDate;
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
                'applyStartDate' => [ 'required', 'date',
                'before_or_equal:' . $maximumaAplyStartDateDate,
                ],
                'endDate' => [
                    'required',
                    'date',
                    'after:startDate', // endDate must be after startDate
                ],
                'countryId' => ['required','exists:countries,id', ],
                'stateId' => ['required','exists:states,id', ],
                'cityId' => ['required','exists:cities,id', ],
                'electionCategregoryId' => ['required','exists:nhapk_election_categories,id', ],
                'electionSeatId' => ['required', 'array'],
                'electionSeatId.*' => ['exists:nhapk_election_seats,id'],
                'areaId' => ['required', 'array'],
                'areaId.*' => ['exists:nhapk_areas,id'],
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $election = new Election();
            $election->name = $request->name;
            $election->description = $request->description;
            $election->lastDate = $request->lastDate;
            $election->startDate = $request->startDate;
            $election->endDate = $request->endDate;
            $election->applyStartDate = $request->applyStartDate;
            $election->countryId = $request->countryId;
            $election->stateId = $request->stateId;
            $election->cityId = $request->cityId;
            $election->electionCategoryId = $request->electionCategregoryId;
            $election->electionSeatId = json_encode($request->electionSeatId);
            $election->areaId = json_encode($request->areaId);
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
            $countries = Country::all();
            $countryId = $elections->countryId;
            if(!empty($countryId)){
                $states = State::where('country_id', $countryId)->get();
            }else{
                $states = [];
            }
            $stateId = $elections->stateId;
            if(!empty($stateId)){
                $cities = City::where('states_id', $stateId)->get();
            }else{
                $cities = [];
            }
            $cityId = $elections->cityId;
            if(!empty($cityId)){
                $areas = Area::where('cityId', $cityId)->get();
            }else{
                $areas = [];
            }
            $electionCategories = ElectionsCategroy::all();
            $electionSeats = ElectionSeat::all();
            return view('admin.elections.edit-elections')->with([
                'elections' => $elections ,
                'countries' => $countries ,
                'states' => $states ,
                'cities' => $cities ,
                'areas' => $areas ,
                'electionCategories' => $electionCategories ,
                'electionSeats' => $electionSeats ,
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
            $maximumaAplyStartDateDate = now()->setTimezone('Asia/Karachi')->parse($request->input('lastDate'))->subDays(1)->toDateTimeString();
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
                'applyStartDate' => [ 'required', 'date',
                'before_or_equal:' . $maximumaAplyStartDateDate,
                ],
                'endDate' => [
                    'required',
                    'date',
                    'after:startDate', // endDate must be after startDate
                ],
                'countryId' => ['required','exists:countries,id', ],
                'stateId' => ['required','exists:states,id', ],
                'cityId' => ['required','exists:cities,id', ],
                'electionCategregoryId' => ['required','exists:nhapk_election_categories,id', ],
                'electionSeatId' => ['required', 'array'],
                'electionSeatId.*' => ['exists:nhapk_election_seats,id'],
                'areaId' => ['required', 'array'],
                'areaId.*' => ['exists:nhapk_areas,id'],
            ];
            $this->validate($request,$rules);
            $elections->name = $request->name;
            $elections->description = $request->description;
            $elections->lastDate = $request->lastDate;
            $elections->startDate = $request->startDate;
            $elections->endDate = $request->endDate;
            $elections->applyStartDate = $request->applyStartDate;
            $elections->countryId = $request->countryId;
            $elections->stateId = $request->stateId;
            $elections->cityId = $request->cityId;
            $elections->electionCategoryId = $request->electionCategregoryId;
            $elections->electionSeatId = json_encode($request->electionSeatId);
            $elections->areaId = json_encode($request->areaId);
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


    public function getElectionCategroyByElectionId($electionId){
        try{
            $electionCategories = Candidate::where('electionId', $electionId)->with(['electionCategory'])->get();
            if(!count($electionCategories)>0){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Election categories are',
                'electionCategories' => $electionCategories,
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

    public function getElectionCategoryAndSeat($electionId){
        try{
            $elections = Election::where('id', $electionId)->with(['electionCategory'])->first();
            if(!($elections)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid elections. Kindly access the valid one',
                ]);
            }
            // $electionCategories = $elections->electionCategory; // Accessing the relationship on each item

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
            
            return response()->json([
                'status' => 'success',
                'message' => 'Election categories are:',
                'elections' => $elections,
                // 'electionCategories' => $electionCategories,
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

}
