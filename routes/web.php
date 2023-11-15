<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\HostelRegistrationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatesController;
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


Route::get('hostelRegistration/hostelOwnerCniccheck/{hostelOwnerCnic}', [HostelRegistrationController::class, 'hostelOwnerCniccheck'])->name('hostelRegistration.OwnerCnicCheck');
Route::get('hostelRegistration/hostelName/{hostelName}', [HostelRegistrationController::class, 'hostelNameCheck'])->name('hostelRegistration.HostelNameCheck');
Route::post('hostelRegistration/save',[HostelRegistrationController::class, 'hostelRegister'])->name('hostelRegistration.save');