<?php

namespace App\Http\Controllers\Frontend\Client;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginClientController extends Controller
{
    //
    public function index(){
        try{
            // 
            return view('frontEnd.client.login-client');
        }
        catch(Exception $e){
            return redirect()->route('Home')->with('error','Your Exception is: '.$e->getMessage());
        }
    }

    // Begin: Function to check the credentails and logged in the client user
    public function login_credentials(Request $req){
        // dd($req->toArray());
        try{
            // 
            echo '+923'.$req->phone_number_login;
            $users = User::where('phone_number','+923'.$req->phone_number_login)->first();
            if(!($users)){
                return redirect()->route('Home')->with('error', 'Invalid Credentials');
            }
            $email =$users->email;
            $password=$req->password;
            // Retrieve the submitted login credentials
            $credentials = ['email' => $email, 'password' => $password];
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                /// Check the user's role after successful login
                $userRoles = Auth::user()->getRoleNames();
    
                if ($userRoles->contains('nhapk_client')) {
                    // dd("Yes Client");
                    // Redirect to the desired route for nhapk_client role
                    return redirect()->route('client.dashboard.index')->with('success',"Successfully Logged in Now!");
                } 
                
                else {
                    Auth::logout();
                    return redirect()->route('Home')->with('error', 'Invalid Credentials');
                }
            } else {
                return redirect()->route('Home')->with('error', 'Invalid Credentials');
            }
        }
        catch(Exception $e){
            return redirect()->route('Home')->with('error','Your Exception is:'.$e->getMessage());
        }
    }
    // End: Function to check the credentails and logged in the client user

    /**
     * Begin: Function to check the phone_number exist or not
    */
    public function checkPhoneNumber($phone_number){
        try{
            // 
            $users = User::where('phone_number','+923'.$phone_number)->get();
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
     * Begin: Function to store new user
     */
        public function storeNewUser(Request $request){
            try{
                // 
                // dd($request->new_phone_number);
                $rules = [
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'cnic_no' => 'required|string|max:15|min:15|unique:users,cnic_no',
                    // 'new_phone_number' => 'required|string|required|regex:/^[0-9]{9}$/',
                    'new_phone_number' => [
                        'required',
                        'string',
                        'regex:/^[0-9]{9}$/',
                        Rule::unique('users', 'phone_number')->where(function ($query) use ($request) {
                            // Customize the condition to match your database structure
                            $query->where('phone_number', '+923' . $request->new_phone_number);
                        }),
                    ],
                    'password' => 'required|string|required|max:8|min:8',
                    'confirmPassword' => 'required|string|required|max:8|min:8|required_with:password|same:password',
                ];
                $this->validate($request,$rules);
                // Generate the initial slug from the title
                $name = $request->firstname." ".$request->lastname;
                $slug = Str::slug($name);
                // Make the slug unique
                $uniqueSlug = $this->makeSlugUnique($slug);
                // dd($request->toArray());
                // 'password' => Hash::make($data['password']),
                $user = new User();
                $user->name = $name;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->cnic_no = $request->cnic_no;
                $user->email = $request->email;
                $user->phone_number = '+923'.$request->new_phone_number;
                $user->slug = $uniqueSlug;
                $user->password = Hash::make($request->password);
                $user->nhapk_register = 1;
                // Save the user
                $results = $user->save();

                // Assign role only if the user is successfully saved
                if ($results) {
                    $user->assignRole("nhapk_client");
                    return redirect()->route('Home')->with('success', 'User created successfully');
                } else {
                    return redirect()->route('Home')->with('error', 'Due to some error. User not saved. Kindly try again');
                }
            }
            catch(ValidationException $vaildationExceptionErrors){
                return redirect()->back()->withErrors($vaildationExceptionErrors->validator->getMessageBag())->withInput();;
            }
            catch(Exception $e){
                return redirect()->route('Home')->with('error','Your Exception is: '.$e->getMessage());
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
