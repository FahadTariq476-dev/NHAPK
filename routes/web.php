<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HostelRegistrationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('frontEnd.index');
});
Auth::routes(['register' => false,'reset' => false, 'login'=>false]);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route for Membership
// Route::get('/membership/registration', function () {
//     return view('membership');
// });
Route::get('/membership/registration', [MembershipController::class, 'show'])->name('membershipRegister');
Route::post('/addMembership',[MembershipController::class,'addMembership']);
Route::get('/saveHostelForm', [MembershipController::class, 'saveHostel'])->name('saveHostelForm');
Route::get('/get-states/{country_id}', [StatesController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{state_id}', [CityController::class, 'getCities'])->name('get.cities');
Route::get('/get-properties/{city_id}', [PropertyController::class, 'getProperties'])->name('get.properties');
Route::get('/checkEmail/{email}', [UserController::class, 'uniqueEmail']);
// Route the check the CNIC from the user table
Route::get('/checkCNIC/{cnic}',[UserController::class,'uniqueCNIC'])->name('uniqueCNIC');
// Route to check the CNIC in Membership table
Route::get('/checkCNIC_Membership/{cnic}',[MembershipController::class,'chkMembershipCNIC'])->name('checkCNIC_Membership');
// Route to check the Hostel Id from the properties table
Route::get('/checkHostelId/{id}',[PropertyController::class,'properties_IdCheck'])->name('properties.checkHostelId');

Route::get('hostelRegistration/hostelOwnerCniccheck/{hostelOwnerCnic}', [HostelRegistrationController::class, 'hostelOwnerCniccheck'])->name('hostelRegistration.OwnerCnicCheck');
Route::get('hostelRegistration/hostelPartnerCniccheck/{hostelPartnerCnic}', [HostelRegistrationController::class, 'hostelPartnerCniccheck'])->name('hostelRegistration.PartnerCnicCheck');

Route::get('hostelRegistration/hostelName/{hostelName}', [HostelRegistrationController::class, 'hostelNameCheck'])->name('hostelRegistration.HostelNameCheck');
Route::post('hostelRegistration/save',[HostelRegistrationController::class, 'hostelRegister'])->name('hostelRegistration.save');

// Show the contact us Form
Route::get('contactUs',[ContactUsController::class,'showContactUsForm'])->name('ContactUsForm');
// Save the Contact Us data
Route::post('saveContactUs',[ContactUsController::class, 'saveData'])->name('saveContactUsData');