<?php

namespace App\Http\Controllers\Client\hostelites;

use Exception;
use App\Models\User;
use App\Models\Membership;
use App\Models\Properties;
use Illuminate\Http\Request;
use App\Models\HosteliteMeta;
use App\Models\MembershipTypes;
use App\Models\PropertiesMetas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HostelitesController extends Controller
{
    /**
     * Function to get Hostel Id and Show the Hostel Owner Name and Hostel Contact Number
     */
    public function hostelContactAndAuthor($hostelId){
        try{
            $hostels = Properties::find($hostelId);
            if(!($hostels)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'You are accessing invalid hostel. Kindly access the valid one.',
                ]);
            }
            else{
                $hostelOwnerDetails = $hostels->users;
                $hostelOwnerName = $hostelOwnerDetails->name;
                if(!($hostelOwnerName)){
                    $hostelOwnerName="Owner Name is not available now.";
                }
                $propertyMetas = PropertiesMetas::where('property_id', $hostelId)->first();
                if(!($propertyMetas)){
                    $hostelContactNumber = "Mobile Number is not available";
                }
                else{
                    if(!($propertyMetas->contact_number)){
                        $hostelContactNumber = "Hostel Contact Number is not given.";
                    }
                    else{
                        $hostelContactNumber = $propertyMetas->contact_number;
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'hostelOwnerName' =>$hostelOwnerName,
                    'hostelContactNumber' =>$hostelContactNumber,
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

    public function storeHosteliteMetas(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'countryId' => 'required|exists:countries,id',
                'stateId' => 'required|exists:states,id',
                'cityId' => 'required|exists:cities,id',
                'hostelId' => 'required|exists:properties,id',
                'livingSince' => 'required|date',
                'referralCnic' => 'required|exists:users,cnic_no',
                'transactionNo' => 'required|unique:users,id',
            ];
            $this->validate($request,$rules);
            // dd($request->all());
            $userCnicNo = Auth::user()->cnic_no;
            // dd($request->all());
            $hosteliteMetas = new HosteliteMeta();
            $hosteliteMetas->hostelite_id = Auth::id();
            $hosteliteMetas->property_id = $request->hostelId;
            $resultHosteliteMetas = $hosteliteMetas->save();
            if(!($resultHosteliteMetas)){
                DB::commit();
                return redirect()->back()->with('error','There is an error While Saving the Data. Kindly Try Again');
            }
            $memberships = Membership::where('cnic',$userCnicNo)->first();
            if(!($memberships)){
                $memberships = new Membership();
                $userDetails = Auth::user();
                $rolesUserDetails = $userDetails->roles;
                $roleIds = $rolesUserDetails->pluck('id')->toArray();
                $membershipTypes = MembershipTypes::whereIn('role_id', $roleIds)->first();
                $memberships->name = $userDetails->name;
                $memberships->cnic = $userDetails->cnic_no;
                $memberships->membershiptype_id = $membershipTypes->id;
                $cnic_no = $userDetails->cnic_no;
                $last_digit = substr($cnic_no, -1);

                if (intval($last_digit) % 2 == 0) {
                    $memberships->gender = 'female';
                } else {
                    $memberships->gender = 'male';
                }
            }
            $memberships -> hostelreg_no = $request->hostelId;
            $memberships -> referal_cnic = $request->referralCnic;
            $memberships -> transaction_no = $request->transactionNo;
            $memberships -> since = $request->livingSince;
            $memberships -> previous_hostel = $request->previousHostel;
            $memberships -> country_id = $request->countryId;
            $memberships -> states_id = $request->stateId;
            $memberships -> city_id = $request->cityId;
            $memberships -> property_id = $request->hostelId;
            $userReferal = User::where('cnic_no', $request->referralCnic)->first();
            $memberships -> parent_id = $userReferal->id;
            $resultMemberships = $memberships->save();   
            if(!($resultMemberships)){
                DB::rollBack();
                return redirect()->back()->with('error','There is an error While Saving the Data. Kindly Try Again');
            }
            DB::commit();
            return redirect()->route('client.dashboard.index')->with('success','Data Succesfully Saved Now');
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
