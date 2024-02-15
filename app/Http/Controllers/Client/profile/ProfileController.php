<?php

namespace App\Http\Controllers\Client\profile;

use Exception;
use App\Models\Area;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Properties;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Function to view profile
     */
    public function viewProfile(){
        try{
            $users = Auth::user();
            // dd($users->toArray());
            $userRoles = $users->roles;
            $userCountry = $users->countryId;
            $userState = $users->stateId;   
            $userCity = $users->cityId;
            $countriesAll = Country::all();
            $statesAll = State::where('country_id',$userCountry)->get();
            $citiesAll = City::where('states_id',$userState)->get();
            if(!empty($userCity)){
                $areas = Area::where('cityId', $userCity)->get();
                $hostels = Properties::where('city_id', $userCity)->get();
            }else{
                $areas = [];
                $hostels = [];
            }
            
            return view('client.profile.list-profile')->with([
                'users' => $users,
                'userRoles' => $userRoles,
                'countriesAll' => $countriesAll,
                'statesAll' => $statesAll,
                'citiesAll' => $citiesAll,
                'userCountry' => $userCountry,
                'areas' => $areas,
                'hostels' => $hostels,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exxception is: '.$e->getMessage());
        }
    }

    /**
     * Function to update profile
    */
    public function updateProfile(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->all());
            $userOldInfo = Auth::user();
            $oldUserProfile = $userOldInfo->picture_path;
            
            $rules = [
                'firstName' =>'required|string|min:3|max:255',
                'lastName' =>'required|string|min:3|max:255',
                'shortDescription' =>'required|string|min:3|max:255',
                'userAddress' =>'required|string|min:3|max:255',
                'userDob' =>'required|date',
                'countryId' =>'required|exists:countries,id',
                'stateId' =>'required|exists:states,id',
                'cityId' =>'required|exists:cities,id',
                'areaId' => ['required', 'exists:nhapk_areas,id'],
                'hostelId' => ['required', 'exists:properties,id'],
            ];
            if($oldUserProfile == null){
                $rules['userProfileImage']='required|image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048';
            }
            else{
                $rules['userProfileImage']='sometimes|image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048';
            }
            $this->validate($request,$rules);
            // dd($request->all());
        
            $name = $request->firstName." ".$request->lastName;
            $slug = Str::slug($name);
            // Make the slug unique
            $uniqueSlug = $this->makeSlugUnique($slug);

            // Handle user profile image
            if ($request->hasFile('userProfileImage')) {
                // Upload and save the new profile image
                // $newProfileImagePath = $request->file('userProfileImage')->store('profile_images', 'public');
                $filename = 'profile_image_' . time() . '.' . $request->file('userProfileImage')->getClientOriginalExtension();

                // Upload and save the new profile image
                $newProfileImagePath = $request->file('userProfileImage')->storeAs('profile_images', $filename, 'public');

                // Unlink the old profile image if it exists
                if ($oldUserProfile != null) {
                    // Assuming your profile images are stored in the 'public' disk
                    $oldProfileImagePath = public_path("storage/{$oldUserProfile}");

                    if (file_exists($oldProfileImagePath)) {
                        unlink($oldProfileImagePath);
                    }
                }
            }
            $user = User::find(Auth::id());
            $user->name = $name;
            $user->firstname = $request->firstName;
            $user->lastname = $request->lastName;
            $user->short_description = $request->shortDescription;
            $user->address = $request->userAddress;
            $user->date_of_birth = $request->userDob;
            if ($request->hasFile('userProfileImage')) {
                $user->picture_path = $newProfileImagePath;
            }
            $user->slug = $uniqueSlug;
            $user->countryId = $request->countryId;
            $user->stateId = $request->stateId;
            $user->cityId = $request->cityId;
            $user->areaId = $request->areaId;
            $user->hostel_name = $request->hostelId;
            $results = $user->save();
            if(!$results){
                DB::commit();
                return redirect()->back()->with('error', 'There is an error while updating the profile. Kindly Try Again.');
            }
            DB::commit();
            return redirect()->route('client.dashboard.index')->with('success', 'Profile Updated Now successfully');
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
     * Function make slug unique
     */
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

}
