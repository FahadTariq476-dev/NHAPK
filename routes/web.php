<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\PostBlogsController;
use App\Http\Controllers\BlogFrontEndController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HostelRegistrationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use App\Models\Membership;
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
})->name('Home');
// Auth::routes(['register' => false,'reset' => false, 'login'=>false]);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route for Membership
// Route::get('/membership/registration', function () {
//     return view('membership');
// });
Route::get('/membership/registration', [MembershipController::class, 'show'])->name('membershipRegister');
Route::post('/addMembership', [MembershipController::class, 'addMembership']);
Route::get('/saveHostelForm', [MembershipController::class, 'saveHostel'])->name('saveHostelForm');
Route::get('/get-states/{country_id}', [StatesController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{state_id}', [CityController::class, 'getCities'])->name('get.cities');
Route::get('/get-properties/{city_id}', [PropertyController::class, 'getProperties'])->name('get.properties');
Route::get('/checkEmail/{email}', [UserController::class, 'uniqueEmail']);
// Route the check the CNIC from the user table
Route::get('/checkCNIC/{cnic}', [UserController::class, 'uniqueCNIC'])->name('uniqueCNIC');
// Route to check the CNIC in Membership table
Route::get('/checkCNIC_Membership/{cnic}', [MembershipController::class, 'chkMembershipCNIC'])->name('checkCNIC_Membership');
// Route to check the Hostel Id from the properties table
Route::get('/checkHostelId/{id}', [PropertyController::class, 'properties_IdCheck'])->name('properties.checkHostelId');
// Route to check the transaction no from the membership table
Route::get('/checkTransaction_no/{id}', [MembershipController::class, 'checkTransaction_No'])->name('v');

Route::get('hostelRegistration/hostelOwnerCniccheck/{hostelOwnerCnic}', [HostelRegistrationController::class, 'hostelOwnerCniccheck'])->name('hostelRegistration.OwnerCnicCheck');
Route::get('hostelRegistration/hostelPartnerCniccheck/{hostelPartnerCnic}', [HostelRegistrationController::class, 'hostelPartnerCniccheck'])->name('hostelRegistration.PartnerCnicCheck');

Route::get('hostelRegistration/hostelName/{hostelName}', [HostelRegistrationController::class, 'hostelNameCheck'])->name('hostelRegistration.HostelNameCheck');
Route::post('hostelRegistration/save', [HostelRegistrationController::class, 'hostelRegister'])->name('hostelRegistration.save');

// Show the contact us Form
Route::get('contactUs', [ContactUsController::class, 'showContactUsForm'])->name('ContactUsForm');
// Save the Contact Us data
Route::post('saveContactUs', [ContactUsController::class, 'saveData'])->name('saveContactUsData');


Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        // Route to show the admin login page
        Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.showForm');
        // Route to login the page
        Route::post('/login', [LoginController::class, 'AdminloginPost'])->name('admin.login.post');
    });
});



Route::group(['middleware' => ['role:nhapk_admin', 'auth']], function () {
    // Admin Front Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.ShowDashboard');
    // Route::get('/admin/dashboard',[DashboardController::class,'showAdminDashboard'])->name('admin.ShowDashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Route to Show List Complaint View
    Route::get('/admin/listComplaint', [ComplaintController::class, 'adminListComplaintView'])->name('admin.ListComplaintView');
    // Route for admin to list complaint
    Route::get('/get-adminListingComplaint', [ComplaintController::class, 'adminListingComplaint'])->name('admin.adminListingComplaint');
    // Route for admin to update the complaint status
    Route::get('/complaint/update-status/{status}/{complaintId}', [ComplaintController::class, 'updateComplaintStatus'])->name('admin.updateComplaintStatus');

    // Route to show post-blogs page
    Route::get('/admin/post-blogs',[PostBlogsController::class, 'index'])->name('admin.post-blogs');
    // Route to save the blog post
    Route::post('/admin/saveBlogPost',[PostBlogsController::class, 'saveBlogPost'])->name('admin.saveBlogPost');
    // Route to show the list-blog page
    Route::get('/admin/list-blogs',[PostBlogsController::class,'listBlogView'])->name('admin.list-blogs');
    // Rote display or list the all posted blogs
    Route::get('/admin/get-blogList',[PostBlogsController::class,'adminListingPostedBlogs'])->name('admin.get-blogList');
    // Route for admin to update the posted blog status
    Route::get('/admin/blogs/update-status/{status}/{complaintId}',[PostBlogsController::class,'updatePostStatus'])->name('admin.updatePostStatus');
});




// Routes For FronEnd
// Route to Show the about Us Page on the front End
Route::get('/about', [AboutController::class, 'showAbout'])->name('forntEnd.showAbout');

// Begin: Routes for Complaint
// Route to show thw complaint form on the front end
Route::get('/complaint', [ComplaintController::class, 'showComplaintForm'])->name('forntEnd.showComplaintForm');
Route::post('complaintPost', [ComplaintController::class, 'saveComplaint'])->name('frontEnd.saveComplaint');
// End: Routes for Complaint

// Begin: Route for Blogs
// Route to DIsplay the Blogs Page
Route::get('/blogs',[BlogFrontEndController::class,'index'])->name('frontEnd.list-blogs');
// Route to Display the full blod using blog id
Route::get('/blogDetails/{slug}',[BlogFrontEndController::class,'viewFullBlogById'])->name('frontEnd.viewFullBlogBySlug');

// End: Route for Blogs