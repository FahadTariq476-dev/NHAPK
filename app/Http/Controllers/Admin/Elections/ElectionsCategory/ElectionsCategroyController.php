<?php

namespace App\Http\Controllers\Admin\Elections\ElectionsCategory;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ElectionsCategroy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class ElectionsCategroyController extends Controller
{
    /**
     * Function to show save election category form
     */
    public function post(){
        try{
            return view('admin.elections.elections-category.post-elections-category');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store elction category in the table
    */
    public function store(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->all());
            $rules = [
                'name' => 'required|string|min:3|max:255|unique:nhapk_election_categories,name',
                'description' => 'required|string|min:3',
            ];
            $this->validate($request,$rules);
            $electionCategories = new ElectionsCategroy();
            $electionCategories->name = $request->name;
            $electionCategories->description = $request->description;
            $result = $electionCategories->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error while saving the election category. Kindly try again.');
            }else{
                DB::commit();
                return redirect()->back()->with('success','Successfully! Election Category Saved Now.');
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

    /**
     * Function to list the election category
     */
    public function index(Request $request){
        try{
            if($request->ajax()){
                $electionCategories = ElectionsCategroy::latest()->get();
                return DataTables::of($electionCategories)->addIndexColumn()->make(true);
            }else{
                return view('admin.elections.elections-category.list-elections-category');
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to show the edit blade
    */
    public function edit($electionCategoryId){
        try{
            DB::beginTransaction();
            $electionCategories = ElectionsCategroy::find($electionCategoryId);
            if(!($electionCategories)){
                DB::commit();
                return redirect()->route('admin.electionCategeories.index')->with('invalid','You are accessing the invalid Election Category. Kindly acces the valid one.');
            }
            else{
                DB::commit();
                return view('admin.elections.elections-category.edit-elections-category')->with([
                    'electionCategories' => $electionCategories,
                ]);
            }
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exceotion is: '.$e->getMessage());
        }
    }

    /**
     * Function to update elction category in the table
    */
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $electionCategoryId = $request->electionCategoryId;
            $electionCategories = ElectionsCategroy::find($electionCategoryId);
            if(!($electionCategories)){
                DB::commit();
                return redirect()->route('admin.electionCategeories.index')->with('invalid','You are accessing the invalid election category. Kidnly access the valid one.');
            }
            // dd($request->all());
            $rules = [
                'name' => ['required','string','min:3','max:255', Rule::unique('nhapk_election_categories', 'name')->ignore($electionCategoryId),],
                'description' => 'required|string|min:3',
            ];
            $this->validate($request,$rules);
            $electionCategories->name = $request->name;
            $electionCategories->description = $request->description;
            $result = $electionCategories->save();
            if(!($result)){
                DB::commit();
                return redirect()->route('admin.electionCategeories.index')->with('error','There is an error while saving the election category. Kindly try again.');
            }else{
                DB::commit();
                return redirect()->route('admin.electionCategeories.index')->with('success','Successfully! Election Category Updated Now.');
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

    /**
     * Function to check the unique name of election category
     */
    public function delete($electionCategoryId){
        try{
            DB::beginTransaction();
            $electionCategories = ElectionsCategroy::find($electionCategoryId);
            if(!($electionCategories)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing the invalid election category. Kidnly access the valid one.',
                ]);
            }
            else{
                $result = $electionCategories->delete();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while deleting the election category. Kindly try again.',
                    ]);
                }
                else{
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Succesfully! Election Category Deleted Now.',
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
     * Function to check the unique name of election category
     */
    public function changeStatus($electionCategoryId){
        try{
            DB::beginTransaction();
            $electionCategories = ElectionsCategroy::find($electionCategoryId);
            if(!($electionCategories)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing the invalid election category. Kidnly access the valid one.',
                ]);
            }
            else{
                if($electionCategories->status == 1){
                    $electionCategories->status = 0;
                }
                else if($electionCategories->status == 0){
                    $electionCategories->status = 1;
                }
                else{
                    DB::commit();
                    return response()->json([
                        'status' => 'invalid',
                        'message' => 'You are accessing the invalid status. Kidnly access the valid one.',
                    ]);
                }
                $result = $electionCategories->save();
                if(!($result)){
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There is an error while updating the status of election category. Kindly try again.',
                    ]);
                }
                else{
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Succesfully! Election Category Status Changed Now.',
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
     * Function to check the unique name of election category
     */
    public function uniqueName($name){
        try{
            DB::beginTransaction();
            $electionCategories = ElectionsCategroy::where('name',$name)->get();
            if(count($electionCategories)>0){
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Election Category Name alreadyt Exist. Kindly use the Unique Name.',
                ]);
            }
            else{
                DB::commit();
                return response()->json([
                    'status' => 0,
                    'message' => 'Election Category Name is the Unique Name.',
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
