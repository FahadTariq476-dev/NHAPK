<?php

namespace App\Http\Controllers\Admin\ReferralLevels;

use Exception;
use Illuminate\Http\Request;
use App\Models\ReferralLevel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\ReferralLevelsDataTable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ReferralLevelController extends Controller
{
    /**
     * Function to show thw post referaal level.blade.php
    */
    public function postReferralLevel(){
        try{
            return view('admin.referral-levels.post-referral-level');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to list the Referral Levels
    */
    public function listReferralLevel(Request $request){
        try{
            if($request->ajax()){
                $referralLevel = ReferralLevel::latest()->get();
                return DataTables::of($referralLevel)->addIndexColumn()->make(true);
            }
            return view('admin.referral-levels.list-referral-level');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your excpetion is: '.$e->getMessage());
        }
    }

    /**
     * Function to save referral level in the table
    */
    public function saveReferralLevel(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'title' => 'required|string|min:3|max:255|unique:nhapk_referral_levels,title',
                'description' => 'required|string|min:3|max:255',
                'number' => 'required|integer|min:1',
                'percentage' => 'required|integer|min:1',
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $referralLevel = new ReferralLevel();
            $referralLevel->title = $request->title;
            $referralLevel->description = $request->description;
            $referralLevel->number = $request->number;
            $referralLevel->percentage = $request->percentage;
            $result = $referralLevel->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the data. Kindly try again.!');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully! Data Saved Now.');

        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to check the referal level name is unique or not
    */
    public function uniqueTitle($title){
        try{
            $referralLevels = ReferralLevel::where('title',$title)->get();
            if(count($referralLevels)>0){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Title already exist. Kindly Provide Unqiue Ttitle',
                ]);
            }
            else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Title is Unqiue.',
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ],500);
        }
    }

    /**
     * Function to change the status of Referral Level
    */

    public function changeStatus($referralLevelId){
        try{
            DB::beginTransaction();
            $referralLevels = ReferralLevel::find($referralLevelId);
            if(!($referralLevels)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Referral Level. Kindly request the valid one.',
                ]);
            }
            else{
                if($referralLevels->status == 0){
                    $referralLevels->status = 1;
                }
                else{
                    $referralLevels->status = 0;
                }
                $result = $referralLevels->save();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while updating the data. Kindly try again.!',
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Referral Level Successfully Updated Now.',
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
     * Function to change the delete the Referral Level
    */

    public function deleteReferralLevel($referralLevelId){
        try{
            DB::beginTransaction();
            $referralLevels = ReferralLevel::find($referralLevelId);
            if(!($referralLevels)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Referral Level. Kindly request the valid one.',
                ]);
            }
            else{
                $result = $referralLevels->delete();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while deleting the data. Kindly try again.!',
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Referral Level Successfully Deleted Now.',
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
     * Function to Edit Referal Level
    */
    public function editReferralLevel($referralLevelId){
        try{
            $referralLevel = ReferralLevel::find($referralLevelId);
            if(!($referralLevel)){
                return redirect()->back()->with('invalid','You are accessing invalid Referral Level. Kindly request the valid one.');
            }
            else{
                return view('admin.referral-levels.edit-referral-level')->with([
                    'referralLevel' => $referralLevel,
                ]);
            }

        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to Update the Referral Level
    */
    public function updateReferralLevel(Request $request){
        try{
            DB::beginTransaction();
            $referralLevel = ReferralLevel::find($request->referralLevelId);
            if(!($referralLevel)){
                return redirect()->back()->with('invalid','You are accessing invalid Referral Level. Kindly request the valid one.');
            }
            else{
                // dd($request->all());
                $rules = [
                    'title' => [ 'required', 'string', 'min:3', 'max:255', Rule::unique('nhapk_referral_levels', 'title')->ignore($request->referralLevelId), ],
                    'description' => 'required|string|min:3|max:255',
                    'number' => 'required|integer|min:1',
                    'percentage' => 'required|integer|min:1',
                ];
                $this->validate($request,$rules);
                // dd($request->all());
                $referralLevel->title = $request->title;
                $referralLevel->description = $request->description;
                $referralLevel->number = $request->number;
                $referralLevel->percentage = $request->percentage;
                $result = $referralLevel->save();
                if(!($result)){
                    DB::commit();
                    return redirect()->route('admin.referralLevels.listReferralLevel')->with('error','There is an error while updating the data. Kindly try again.!');
                }
                DB::commit();
                return redirect()->route('admin.referralLevels.listReferralLevel')->with('success','Successfully! Data Updated Now.');
            }
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

}
