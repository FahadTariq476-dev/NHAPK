<?php

namespace App\Http\Controllers\Admin\Areas;

use Exception;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class AreaController extends Controller
{
    /**
     * Function to Show Post area .blade file
     */
    public function post(){
        try{
            $countries = Country::all();
            return view('admin.areas.post-area')->with([
                'countries' => $countries,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show area list
     */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $areas = Area::all();
                return DataTables::of($areas)
                ->addIndexColumn()
                ->addColumn('stateName', function ($area) {
                    return $area->state ? $area->state->name : 'Null';
                })
                ->addColumn('cityName', function ($area) {
                    return $area->city ? $area->city->name : 'Null';
                })
                ->make(true);
            }
            return view('admin.areas.list-area');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store areas
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'countryId' => 'required|exists:countries,id',
                'stateId' => 'required|exists:states,id',
                'cityId' => 'required|exists:cities,id',
                'areaTitle' => 'required|unique:nhapk_areas,name',
            ];
            $this->validate($request, $rules);
            $areas = new Area();
            $areas->name = $request->areaTitle;
            $areas->description = $request->areaDescription;
            $areas->countryId = $request->countryId;
            $areas->stateId = $request->stateId;
            $areas->cityId = $request->cityId;
            $areas->addBy = 'admin';
            $result = $areas->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error', 'There is an error while saving the area. Kindly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfully! Area Saved Now');
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
     * Function to update areas
     */
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $areaId = $request->areaId;
            $areas = Area::find($areaId);
            // dd($areas);
            if(!($areas)){
                DB::commit();
                return redirect()->route('admin.areas.list')->with('invalid','You are accessing invalid Area. Kindly access the valid one');
            }
            $rules = [
                'countryId' => 'required|exists:countries,id',
                'stateId' => 'required|exists:states,id',
                'cityId' => 'required|exists:cities,id',
                'areaTitle' => ['required','string','min:3','max:255', Rule::unique('nhapk_areas', 'name')->ignore($areaId),],
            ];
            $this->validate($request, $rules);
            $areas->name = $request->areaTitle;
            $areas->description = $request->areaDescription;
            $areas->countryId = $request->countryId;
            $areas->stateId = $request->stateId;
            $areas->cityId = $request->cityId;
            $result = $areas->save();
            if(!($result)){
                DB::commit();
                return redirect()->route('admin.areas.list')->with('error', 'There is an error while saving the area. Kindly try again.');
            }
            DB::commit();
            return redirect()->route('admin.areas.list')->with('success', 'Successfully! Area Update Now');
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
     * Function to show edit area blade file
     */
    public function edit($areaId){
        try{
            $countries = Country::all();
            $states = State::all();
            $areas = Area::find($areaId);
            if(!($areas)){
                return redirect()->back()->with('invalid', 'You are accessing invalid Area. Kindly access the valid area.');
            }
            $cities = City::where('states_id', $areas->stateId)->get();
            return view('admin.areas.edit-area')->with([
                'areas' => $areas ,
                'countries' => $countries ,
                'states' => $states ,
                'cities' => $cities ,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Excpetion is: '.$e->getMessage());
        }
    }

    /**
     * Function to check unique area name
    */
    public function uniqueAreaName($areaName){
        try{
            $areas = Area::where('name', $areaName)->get();
            if(count($areas)>0){
                return response()->json([
                    'status' => 1,
                    'message' => 'Area Name is not unique. Kindly Provide Unique Area Name',
                ], 200);
            }
            return response()->json([
                'status' => 0,
                'message' => 'Area Name is unique.',
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to change status of the area
    */
    public function changeAreaStatus($areaId){
        try{
            $areas = Area::find($areaId);
            if(!($areas)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid area. Kindly access the valid one.',
                ]);
            }
            if($areas->status == 1){
                $areas->status = 0;
            }
            else if($areas->status == 0){
                $areas->status = 1;
            }
            else{
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid area status. Kindly access the valid one.',
                ]);
            }
            $result = $areas->save();
            if(!($result)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of area. Kindly try again.',
                ]);
                
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Area Status Changed Now.',
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to change status of the area
    */
    public function delete($areaId){
        try{
            $areas = Area::find($areaId);
            if(!($areas)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid area. Kindly access the valid one.',
                ]);
            }
            $result = $areas->delete();
            if(!($result)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while deleting the area. Kindly try again.',
                ]);
                
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Area Deleted Now.',
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Function to get Areas using City 
     */
    public function fetchAreas($cityId){
        try{
            $areas = Area::where('cityId', $cityId)->get();
            if(count($areas)>0){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Areas Found',
                    'areas' => $areas,
                ], 200);
            }else{
                return response()->json([
                    'status' => 1,
                    'message' => 'No Area Found against the Given City.Kindly Add your New Areas',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

}
