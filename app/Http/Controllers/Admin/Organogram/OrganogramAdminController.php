<?php

namespace App\Http\Controllers\Admin\Organogram;

use Exception;
use App\Models\Organogram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrganogramDesignation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class OrganogramAdminController extends Controller
{
    /**
     * Function to show post organogram blade file
     */
    public function post(){
        try{
            $organogramDesignations = OrganogramDesignation::all();
            return view('admin.organogram.post-organogram')->with([
                'organogramDesignations' => $organogramDesignations,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    /**
     * Function to list organogram member
     */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $organograms = Organogram::latest()->get();
                $organogramDesignations = OrganogramDesignation::all();
                return DataTables::of($organograms)
                ->addIndexColumn()
                ->addColumn('user_name', function ($organogram) {
                    return $organogram->user ? $organogram->user->name : 'Null';
                })
                ->addColumn('user_cnic_no', function ($organogram) {
                    return $organogram->user ? $organogram->user->cnic_no : 'Null';
                })
                ->addColumn('user_phone_number', function ($organogram) {
                    return $organogram->user ? $organogram->user->phone_number : 'Null';
                })
                ->addColumn('state_name', function ($organogram) {
                    return $organogram->user->state ? $organogram->user->state->name : 'Null';
                })
                ->addColumn('city_name', function ($organogram) {
                    return $organogram->user->city ? $organogram->user->city->name : 'Null';
                })
                ->addColumn('organogram_designation_name', function ($organogram) {
                    return $organogram->organogramDesignation ? $organogram->organogramDesignation->title : 'Null';
                })
                ->addColumn('organogram_designation_name_all', function ($organogram) use ($organogramDesignations) {
                    $options = '';
                    // Add a default option
                    $options .= "<option value='' disabled>Select Designation</option>";

                    // Add options for each designation
                    foreach ($organogramDesignations as $designation) {
                        $selected = ($organogram->organogramDesignation && $organogram->organogramDesignation->id == $designation->id) ? 'selected' : '';
                        $options .= "<option value='{$designation->id}' {$selected}>{$designation->title}</option>";
                    }

                    // Check if no designations are available
                    if ($organogramDesignations->isEmpty()) {
                        $options .= "<option value='' disabled>No Designations Found</option>";
                    }

                    $token = csrf_token();
    
                    return "<form id='formOeganogramDesignationStatus'>"
                        . "<input type='hidden' name='_token' value='{$token}'>"
                        . "<select id='oganogramDesignationid' class='form-select' data-id='{$organogram->id}'>{$options}</select>"
                        . "</form>";
                })
                ->rawColumns(['organogram_designation_name_all'])
                ->make(true);
            }
            return view('admin.organogram.list-organogram');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store organogram memeber in the table
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'memberCnicSave' => 'required|exists:users,cnic_no',
                'memberUserId' => 'required|exists:users,id',
                'memberDesignationId' => 'required|exists:nhapk_organogram_designations,id',
            ];
            $this->validate($request, $rules);
            // Check if organogram with the same user ID and designation already exists
            if (Organogram::where('userId', $request->memberUserId)->exists()) {
                DB::rollBack();
                return redirect()->back()->with('info', 'Organogram already exists for this user.');
            }
            $organogram = new Organogram();
            $organogram->userId = $request->memberUserId;
            $organogram->organogramDesignationId = $request->memberDesignationId;
            $result = $organogram->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the organogram. Kindly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully! Organogram Saved Now');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to update organogramDesignation 
     */
    public function updateDesignation($organogramId , $organogramDesignationId){
        try{
            DB::beginTransaction();
            $organogram = Organogram::find($organogramId);
            if(!($organogram)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid organogram Member. Kindly access the valid one.',
                ]);
            }
            $organogramDesignation = OrganogramDesignation::find($organogramDesignationId);
            if(!($organogramDesignation)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid organogram designation. Kindly access the valid one.',
                ]);
            }
            $organogram->organogramDesignationId = $organogramDesignationId;
            $result = $organogram->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the designation of organogram member. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Organogram Member Designation Updated Now.',
            ], 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to delete organogram member 
     */
    public function deleteOrganogramMember($organogramId){
        try{
            DB::beginTransaction();
            $organogram = Organogram::find($organogramId);
            if(!($organogram)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid organogram Member. Kindly access the valid one.',
                ]);
            }
            $result = $organogram->delete();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while deleting the designation of organogram member. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Organogram Member Designation Deleted Now.',
            ], 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Function to update status of organogram member 
     */
    public function updateStatusOrganogramMember($organogramId){
        try{
            DB::beginTransaction();
            $organogram = Organogram::find($organogramId);
            if(!($organogram)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing invalid organogram Member. Kindly access the valid one.',
                ]);
            }
            if($organogram->status == 1){
                $organogram->status = 0;
            }
            else if($organogram->status == 0){
                $organogram->status = 1;
            }
            $result = $organogram->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of organogram member. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Organogram Member Status Updated Now.',
            ], 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Your Exception is: '.$e->getMessage(),
            ], 500);
        }
    }

}
