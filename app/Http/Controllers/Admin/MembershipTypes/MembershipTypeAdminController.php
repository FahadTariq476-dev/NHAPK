<?php

namespace App\Http\Controllers\Admin\MembershipTypes;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\MembershipTypes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Validation\ValidationException;

class MembershipTypeAdminController extends Controller
{
    /**
     * Begin: Function to list Membership Types
    */
    public function index(Request $request){
        try{
            if($request->ajax()){
                $membershipTypes = MembershipTypes::latest()->get();
                // $membershipTypes = MembershipTypes::with('roles')->latest()->get();
                // dd($membershipTypes->toArray());
                return DataTables::of($membershipTypes)
                ->addIndexColumn()->make(true);
            }
            return view('admin.memberships.membership-types.list-membership-types');
        }
        catch (Exception $e){
            return redirect()->back()->with('error','Your Exception is:'.$e->getMessage());
        }
    }

    /**
     * Begin: Function to show the post Memberhsip Types
     */
    public function post(){
        try{
            $roles = Role::where('nhapk_register', 1)->latest()->get();
            return view('admin.memberships.membership-types.post-membership-types')->with(['roles'=>$roles]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to store Membership Types in a db
    */
    public function storeMembershipTypes(Request $request){
        try{
            DB::beginTransaction();
           
            $rules = [
                'name' => 'required|string|min:3|max:255|unique:membership_types,name',
                'description' => 'required|string|min:3',
                'membershipRoleId' => 'required|unique:membership_types,role_id|exists:roles,id'
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $membershipTypes = new MembershipTypes();
            $membershipTypes->name = $request->name;
            $membershipTypes->description = $request->description;
            $membershipTypes->role_id = $request->membershipRoleId;
            $result = $membershipTypes->save();
            if(!$result){
                DB::commit();
                return redirect()->back()->with('error','There is an error wwhile saving the Membership Type. Kindly Try Again.');
            }
            DB::commit();
            return redirect()->back()->with('success','Successfully Membership Type saved now.');
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
     * Function to show edit membership types
    */
    public function editMembershipTypes($membershipTypeId){
        try{
            $membershipTypes = MembershipTypes::find($membershipTypeId);
            if(!($membershipTypes)){
                return redirect()->back()->with('invalid','You are accessing invalid Mmebership Type. Kindly try again with the valid one.');
            }
            $roles = Role::where('nhapk_register', 1)->latest()->get();
            return view('admin.memberships.membership-types.edit-membership-types')->with([
                'roles'=>$roles,
                'membershipTypes'=>$membershipTypes,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    /**
     * Function to update membership types
    */
    public function updateMembershipTypes(Request $request){
        try{
            DB::beginTransaction();
            $membershipTypes = MembershipTypes::find($request->membershipTypesId);
            if(!($membershipTypes)){
                DB::commit();
                return redirect()->back()->with('invalid','You are accessing invalid Membership Types. Kindly access the valid membership types');
            }
            $rules = [
                'name' => ['required','string','min:3','max:255',Rule::unique('membership_types','name')->ignore($membershipTypes->id),],
                'description' => 'required|string|min:3',
                'membershipRoleId' => ['required','exists:roles,id',Rule::unique('membership_types','role_id')->ignore($membershipTypes->id),],
            ];
            $this->validate($request,$rules);
            $membershipTypes->name = $request->name;
            $membershipTypes->description = $request->description;
            $membershipTypes->role_id = $request->membershipRoleId;
            $result = $membershipTypes->save();
            if(!($result)){
                DB::commit();
                return redirect()->back()->with('error','There is an error. While updating the membership types. Kindly Try again.');
            }
            DB::commit();
            return redirect()->route('admin.membership.membershipTypes.list')->with('success','Succesfully! Membership Updated Now.');
        }
        catch(ValidationException $validationError){
            return redirect()->back()->withErrors($validationError->validator->getMessageBag())->withInput();
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Your Exceptions is: '.$e->getMessage());
        }
    }

    /**
     * Function to delte the membership type
    */
    public function deleteMembershipType($membershipTypeId){
        try{
            DB::beginTransaction();
            $membershipTypes = MembershipTypes::find($membershipTypeId);
            if(!($membershipTypes)){
                DB::commit();
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid Membership Types. Kindly access the valid one.',
                ]);
            }
            $result = $membershipTypes->delete();
            if(!($result)){
                DB::commit();
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is an error while deleting the membership type. Kindly try again.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Membership Type Succesfully Delete Now!',
            ]);
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
     * Function to check the unique name of Membership types
    */
    public function uniqueMembershipTypeName($name){
        try{
            DB::beginTransaction();
            $membershipTypes = MembershipTypes::where('name',$name)->get();
            if(count($membershipTypes)>0){
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Membership Type Name is already exist. Use the unique name.',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => 'Membership Type Name is Unique.',
            ]);
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
