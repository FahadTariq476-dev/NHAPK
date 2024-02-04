<?php

namespace App\Http\Controllers\Admin\Organogram\OrganogramDesignation;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrganogramDesignation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class OrganogramDesignationAdminController extends Controller
{
    /**
     * Function to show post oraganoram-designation blade file
     */
    public function post(){
        try{
            return view('admin.organogram.designation.post-designation');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show list organogram-designation blade file
    */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $organogramDesignations = OrganogramDesignation::latest()->get();
                return DataTables::of($organogramDesignations)
                ->addIndexColumn()
                ->make(true);
            }
            return view('admin.organogram.designation.list-designation');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show edit organogram-designation blade file
     */
    public function edit($organogramDesignationId){
        try{
            $organogramDesignation = OrganogramDesignation::find($organogramDesignationId);
            if(!($organogramDesignation)){
                return redirect()->route('admin.organogramDesignation.list')->with('invalid', 'You are accessing the invalid oraganogram desgination. Kindly access the valid one.');
            }else{
                return view('admin.organogram.designation.edit-designation')->with([
                    'organogramDesignation' => $organogramDesignation,
                ]);
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store the organogram-designation in the table
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'title' => 'required|string|min:3|max:255|unique:nhapk_organogram_designations,title',
                'description' => 'required|string|min:3',
            ];
            $this->validate($request, $rules);
            $organogramDesignation = new OrganogramDesignation();
            $organogramDesignation->title = $request->title;
            $organogramDesignation->description = $request->description;
            $result = $organogramDesignation->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error', 'There is an error wile saving the organogram designation. Kindly try again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully! Organogram Designation Saved Now.');
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
     * Function to update the organogram-designation in the table
     */
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $organogramDesignationId = $request->organogramDesignationId;
            $organogramDesignation = OrganogramDesignation::find($organogramDesignationId);
            if(!($organogramDesignation)){
                return redirect()->route('admin.organogramDesignation.list')->with('invalid', 'You are accessing the invalid oraganogram desgination. Kindly access the valid one.');
            }
            $rules = [
                'title' => [ 'required', 'string', 'min:3', 'max:255', Rule::unique('nhapk_organogram_designations', 'title')->ignore($organogramDesignationId), ],
                'description' => 'required|string|min:3',
            ];
            $this->validate($request, $rules);
            $organogramDesignation->title = $request->title;
            $organogramDesignation->description = $request->description;
            $result = $organogramDesignation->save();
            if(!($result)){
                DB::commit();
                return redirect()->route('admin.organogramDesignation.list')->with('error', 'There is an error wile updating the organogram designation. Kindly try again.');
            }
            DB::commit();
            return redirect()->route('admin.organogramDesignation.list')->with('success','Successfully! Organogram Designation Updated Now.');
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
     * Function to delete the organogram designation
     */
    public function delete($organogramDesignationId){
        try{
            DB::beginTransaction();
            $organogramDesignation = OrganogramDesignation::find($organogramDesignationId);
            if(!($organogramDesignation)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Your are accessing the invalid organogram designation. Kindly access the valid one',
                ]);
            }
            else{
                $result = $organogramDesignation->delete();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while deleting the organoram designation. Kindly try again.',
                    ]);
                }
                else{
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Successfully! Organogram Designation Deleted Now.',
                    ], 200);
                }
            }
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
     * Function to check uniqueTitle of the organogram designation
     */
    public function uniqueTitle($organogramDesignationTitle){
        try{
            DB::beginTransaction();
            $organogramDesignation = OrganogramDesignation::where('title', $organogramDesignationTitle)->first();
            if(!($organogramDesignation)){
                DB::commit();
                return response()->json([
                    'status' => 0,
                    'message' => 'Given Title of Organogram Designation is Unique.',
                ], 200);
            }
            else{
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Given Title of Organogram Designation is Already Exist. Kindly Provide the Unique Title',
                ], 200);
            }
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
