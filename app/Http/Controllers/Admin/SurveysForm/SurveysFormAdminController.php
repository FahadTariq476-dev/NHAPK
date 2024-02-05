<?php

namespace App\Http\Controllers\Admin\SurveysForm;

use Exception;
use Illuminate\Http\Request;
use App\Models\DynamicSurveysForms;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SurveysFormAdminController extends Controller
{
    /**
     * Function to show Post survey's form. blade file
     */
    public function post(){
        try{
            $roles = Role::where('nhapk_register', 1)->get();
            return view('admin.surveysForm.post-surveys-form')->with([
                'roles' => $roles,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }
    
    /**
     * Function to store Post survey's form. blade file
     */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $validatedData = $request->validate([
                'title' => 'required|string',
                'form_structure' => 'required|string',
                'description' => 'required|string',
                'role_id' => 'required|exists:roles,id',
            ]);

            // If you want to store the form structure in the database
            $dynamicSurveysForm = new DynamicSurveysForms();
            $dynamicSurveysForm->title = $request->title;
            $dynamicSurveysForm->description = $request->description;
            $dynamicSurveysForm->role_id = $request->role_id;
            $dynamicSurveysForm->form_structure = $validatedData['form_structure'];
            $result = $dynamicSurveysForm->save();

            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error', 'There is an error while saving the data. Kindly try again!');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Dynamic form saved successfully!');
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to list survey's form
     */
    public function list(Request $request){
        try{
            if($request->ajax()){
                $dynamicSurveysForms = DynamicSurveysForms::latest()->get();
                return DataTables::of($dynamicSurveysForms)
                ->addIndexColumn()
                ->addColumn('role_name', function ($dynamicSurveysForm) {
                    return $dynamicSurveysForm->roleId->name ? $dynamicSurveysForm->roleId->name : 'Null';
                })
                ->make(true);
            }
            $roles = Role::where('nhapk_register', 1)->get();
            return view('admin.surveysForm.list-surveys-form')->with([
                'roles' => $roles,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to change status of surveys form
    */
    public function changeStatus($dynamicSurveysFormId){
        try{
            DB::beginTransaction();
            $dynamicSurveysForm = DynamicSurveysForms::find($dynamicSurveysFormId);
            if(!($dynamicSurveysForm)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Survey\'s Form. Kindly access the valid one.',
                ]);
            }
            if($dynamicSurveysForm->status == 1){
                $dynamicSurveysForm->status = 0;
            }
            else if($dynamicSurveysForm->status == 0){
                $dynamicSurveysForm->status = 1;
            }
            else{
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid status of Survey\'s Form. Kindly access the valid one.',
                ]);
            }
            $result = $dynamicSurveysForm->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the status of Survey\'s Form. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Dynamic Survey\'s Form Status Updated Now.',
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
     * Function to change role to show of surveys form
    */
    public function changeShowRole($dynamicSurveysFormId, $roleId){
        try{
            DB::beginTransaction();
            $roles = Role::where('nhapk_register', 1)->where('id', $roleId)->first();
            if(!($roles)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Roles to Show. Kindly access the valid one.',
                ]);
            }
            $dynamicSurveysForm = DynamicSurveysForms::find($dynamicSurveysFormId);
            if(!($dynamicSurveysForm)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Survey\'s Form. Kindly access the valid one.',
                ]);
            }
            $dynamicSurveysForm->role_id = $roleId;
            $result = $dynamicSurveysForm->save();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while updating the Roles to Show of Survey\'s Form. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Dynamic Survey\'s Form Roles to Show Updated Now.',
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
     * Function to change status of surveys form
    */
    public function delete($dynamicSurveysFormId){
        try{
            DB::beginTransaction();
            $dynamicSurveysForm = DynamicSurveysForms::find($dynamicSurveysFormId);
            if(!($dynamicSurveysForm)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Survey\'s Form. Kindly access the valid one.',
                ]);
            }
            $result = $dynamicSurveysForm->delete();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while deleting the status of Survey\'s Form. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully! Dynamic Survey\'s Form Deleted Updated Now.',
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
