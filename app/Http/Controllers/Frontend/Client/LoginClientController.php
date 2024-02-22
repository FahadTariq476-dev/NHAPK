<?php

namespace App\Http\Controllers\Frontend\Client;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MembershipTypes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginClientController extends Controller
{
    // Begin: Function to check the credentails and logged in the client user
    public function login_credentials(Request $req){
        try{
            // dd($req->all());
            $users = User::where('cnic_no',$req->cnic_no_login)->first();
            if(!($users)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Invalid User',
                ], 200);
            }
            $userRoles = $users->getRoleNames(); 
            if ($userRoles->contains('nhapk_admin')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Roles',
                ], 200);
            } else if (!$userRoles->contains('nhapk_client')) {
                $users->assignRole("nhapk_client");
            }
            $email =$users->email;
            $password=$req->password;
            // Retrieve the submitted login credentials
            $credentials = ['email' => $email, 'password' => $password];
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                if($users->nhapk_verified == 0){
                    $users->nhapk_verified = 1;
                    $users->save();
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Logged in Now!',
                    'redirect' => route('client.dashboard.index'), // Adjust this to your dashboard route
                ], 200);
            } else {
                return response()->json([
                    'status' => 'invalidCredentials',
                    'message' => 'Invalid Password.',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to login the user'.$e->getMessage(),
            ], 500);
        }
    }
    // End: Function to check the credentails and logged in the client user

    /**
     * Begin: Function to check the phone_number exist or not
    */
    public function checkPhoneNumber($phone_number){
        try{
            // 
            $users = User::where('phone_number','+92'.$phone_number)->get();
            if(count($users)>0){
                return 1;
            }
            else{
                return 0;
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('error','Your Exception is:'.$e->getMessage());
        }
    }
    /**
     * End: Function to check the phone_number exist or not
    */
    
    /**
     * Begin: Function to check the phone_number exist or not
    */
    public function cnicCheckPhoneNumber($cnic_no,$phone_number){
        try{
            $user = User::where('cnic_no',$cnic_no)->first();
            if(($user)){
                if($user->phone_number == $phone_number){
                    if($user->nhapk_verified == 0){
                        return response()->json([
                            'status' => -1,    // It means that user exist but it is not verified it will verify the otp here
                            'message' => 'This is is your first visit on NHAPK. Kindly Verify Your OTP to Login.',
                        ], 200);
                    }
                    else{
                        return response()->json([
                            'status' => 1,    // It means that user exist and it is nhapk_verified it will enter the password here
                            'message' => 'Show Password Modal. User is verified.',
                        ], 200);
                    }
                }
                else{
                    return response()->json([
                        'status' => 0,    // It means that user mobile number doesn't match with cnic.
                        'message' => 'Your Mobile Number doesn\'t match with given cnic. Kindly Provide the Correct Mob No.',
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'invalid',     
                    'message' => 'You are accessing invalid user. User with this cnic doesn\'t exist our record. Kindly Go to Sign Up & Register Your Account.',
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
    /**
     * End: Function to check the phone_number exist or not
    */

    /**
     * Function to change Password
     */
    public function changePassword(Request $request){
        try{
            $user = User::where('cnic_no',$request->cnic_no_restePassword)->first();
            if(!($user)){
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Invalid Cnic No',
                ]);
            }
            $newPassword = $request->restePassword;
            if(strlen($newPassword) !=8){
                return response()->json([
                    'status' => 'validationError',
                    'message' => 'New Password Length Should be of 8 characters.',
                ]);
            }
            // Hash the new password
            $hashedPassword = Hash::make($newPassword);

            // Update the user's password in the database
            $user->update([
                'password' => $hashedPassword,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password successfully updated.',
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
     * Begin: Function to store new user
     */
        public function storeNewUser(Request $request){
            try{
                // dd($request->all());
                $allwoedrulesforLogin = 
                [
                    'Who did not  decided  role yet',
                    'I am Hostelites',
                    'Hostel Working Staff eg. Made,  Helper, Doormen / Guard',
                    'Admin / Manager / Cook / Warden',
                    'Staff or Team Member of NHAP',
                    'Sponsor / Supporter of NHAP',
                    'Private Hostel Owner/ Antiusist',
                ];
                DB::beginTransaction();
                $rules = [
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'cnic_no_register' => 'required|string|max:15|min:15|unique:users,cnic_no',
                    'new_phone_number_register' => [
                        'required',
                        'numeric',
                        'digits:10',
                        'regex:/^3\d{9}$/',
                        Rule::unique('users', 'phone_number')->where(function ($query) use ($request) {
                            // Customize the condition to match your database structure
                            $query->where('phone_number', '+92' . $request->new_phone_number);
                        }),
                    ],
                    'roleId' =>['required', Rule::exists('roles', 'id')->where(function ($query) use ($allwoedrulesforLogin) {
                        $query->where('nhapk_register', 1)->whereIn('name',$allwoedrulesforLogin);
                    }),
                ],
                    'password' => 'required|string|required|max:8|min:8',
                    'confirmPassword' => 'required|string|required|max:8|min:8|required_with:password|same:password',
                ];
                $this->validate($request,$rules);
                // dd($request->all());
                // Generate the initial slug from the title
                $name = $request->firstname." ".$request->lastname;
                $slug = Str::slug($name);
                // Make the slug unique
                $uniqueSlug = $this->makeSlugUnique($slug);
                $user = new User();
                $user->name = $name;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->cnic_no = $request->cnic_no_register;
                $user->email = $request->email;
                $user->phone_number = '+92'.$request->new_phone_number_register;
                $user->slug = $uniqueSlug;
                $user->password = Hash::make($request->password);
                $user->nhapk_register = 1;
                $user->nhapk_verified = 1;
                // Save the user
                $results = $user->save();

                $roles= Role::find($request->roleId);
                // Assign role only if the user is successfully saved
                if ($results) {
                    $user->assignRole($roles->name);
                    $user->assignRole("nhapk_client");
                    $membershipTypes = MembershipTypes::where('role_id', $request->roleId)->first();
                    $membership = new Membership();
                    $membership->name = $name;
                    $membership->cnic = $request->cnic_no;
                    $membership->membershiptype_id = $membershipTypes->id;
                    $cnic_no = $request->cnic_no;
                    $last_digit = substr($cnic_no, -1);

                    if (intval($last_digit) % 2 == 0) {
                        $membership->gender = 'female';
                    } else {
                        $membership->gender = 'male';
                    }
                    $membership->since = now();
                    $resultMemberships = $membership->save();
                    if(!$resultMemberships){
                        DB::rollBack();
                        DB::commit();
                        return response()->json([
                            'status' => 'error',
                            'message' => 'There is an error while saving the user. Try again',
                        ]);
                    }
                    DB::commit();
                    Auth::login($user);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'User added successfully',
                        'redirect' => route('client.dashboard.index'), // Adjust this to your dashboard route
                    ]);
                } else {
                    DB::commit();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User Not saved successfully',
                    ]);
                }
            }
            catch(ValidationException $vaildationExceptionErrors){
                return response()->json([
                    'status' => 'error',
                    'errors' => $vaildationExceptionErrors->validator->getMessageBag(),
                ], 422);
            }
            catch(Exception $e){
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add user',
                    'exception' => $e->getMessage(),
                ], 500);
            }
        }
     /**
     * End: Function to store new user
    */

    // Begin: Function to make slug unique
    private function makeSlugUnique($slug, $counter = 1)
    {
        // Check if a record with the same slug already exists
        $existingUsers = User::where('slug', $slug)->first();

        // If a record with the same slug exists, modify the slug to make it unique
        if ($existingUsers) {
            $modifiedSlug = $slug . '-' . $counter;
            // Recursive call to ensure the modified slug is also unique
            return $this->makeSlugUnique($modifiedSlug, $counter + 1);
        }

        // If the slug is already unique, return it
        return $slug;
    }
    // End: Function to make slug unique

     
}
