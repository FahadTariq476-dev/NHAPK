<?php

use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ContactUsAdminController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\BlogFrontEndController;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipAdminController;
use App\Http\Controllers\Admin\NewsFeedsAdminController;
use App\Http\Controllers\Admin\PostBlogsController;
use App\Http\Controllers\HostelRegistrationController;
use App\Http\Controllers\NewsFeedController;

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
// Route::get('/', function () {
//     return view('frontEnd.index');
// })->name('Home');
Route::get('/',[HomeDashboardController::class,'index'])->name('Home');
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
    // Route for admin to delete the posted blog
    Route::get('/admin/deleteBlog/{id}',[PostBlogsController::class,'deleteBlog'])->name('admin.deleteBlog');
    // Route for admin to load the edit blog from lis-blog page
    Route::get('/admin/editBlog/{id}',[PostBlogsController::class,'editBlogView'])->name('admin.editBlogView');
    // Route for admin to update the full blog from edit blog page
    Route::post('/admin/updateBlog',[PostBlogsController::class,'updateFullBlog'])->name('admin.updateFullBlog');


    // Begin: Routes for Membership
    // Route for admin to show the lis-mmebrship blade
    Route::get('/admin/list-memebership',[MembershipAdminController::class,'indexMembership'])->name('admin.list-memebership');
    // Route to dislpay the membership on listMembership page using datable
    Route::get('/admin/get-membershipList',[MembershipAdminController::class,'adminListingMemebership'])->name('admin.get-membershipList');
    // Rute for admin to display the edit membership view from list-memebrship page having id of membership
    Route::get('/admin/editMembership/{id}',[MembershipAdminController::class,'editMemebershipView'])->name('admin.editMemebershipView');
    // Route for admin to update the membership in controller 
    Route::post('/admin/updateMembership',[MembershipAdminController::class,'updateMembership'])->name('admin.updateMembership');
    // End: Routes for Membership

    // Begin: Route for Contact Us 
    // Route for Contact Us to show the list of  list-contactus blade file
    Route::get('/admin/list-contctUs',[ContactUsAdminController::class,'index'])->name('admin.contactUs.list-contactus');
    // Route for admin to get the list of cantact us using ajax request
    Route::get('/admin/get-contactus',[ContactUsAdminController::class,'adminListContactUs'])->name('admin.contactUs.get-contactUs');
    // Route for the the admin to get message of contct us using the id
    Route::get('/admin/contactus/get-message/{id}',[ContactUsAdminController::class,'get_message'])->name('admin.contactus.get-message');
    // End: Route for Contact Us 
    

    // Begin: Route for News & Feeds
    // Route for admin to show the post news and feed page
    Route::get('/admin/post-newsfeeds',[NewsFeedsAdminController::class,'index'])->name('admin.newsfeeds.post-newsfeeds');
    // Route for admin to save the news and feed
    Route::post('/admin/saveNewsfeeds',[NewsFeedsAdminController::class,'saveNewsfeeds'])->name('admin.saveNewsfeeds');
    // Route for admin to show the news & feeeds listing page
    Route::get('/admin/list-newsfeeds',[NewsFeedsAdminController::class, 'listNewsfeedsView'])->name('admin.newsfeeds.list-newsfeeds');
    // Route for admin to get the list of newsfeeds to show them in the data table
    Route::get('/admin/get-newfeedList',[NewsFeedsAdminController::class,'adminListingNewsfeeds'])->name('admin.newsfeeds.get-newsfeedList');
    // Route for admin to update the status of new feed from the listing page using ajax request
    Route::get('/admin/newsfeeds/update-status/{status}/{newsId}',[NewsFeedsAdminController::class,'updateNewsfeedStatus'])->name('admin.newsfeeds.updateNewsfeedStatus');
    // Route for admin to delete the newsfeed at listin page using newsId
    Route::get('/admin/delete-newsfeeds/{newsId}',[NewsFeedsAdminController::class,'deleteNewsfeed'])->name(('admin.newsfeeds.deleteNewsfeed'));
    // Route for admin to show the edit-news veiw page with news
    Route::get('/admin/editNewsfeeds/{newsId}',[NewsFeedsAdminController::class,'editNewsfeedView'])->name('admin.newsfeed.editNewsfeedView');
    // Route for admin to update the full news from edi-newsfeeds page
    Route::post('/admin/updateNewsfeeeds',[NewsFeedsAdminController::class,'updateFullNewsfeed'])->name('admin.newsfeeds.updateFullNewsfeed');
    // End: Route for News & Feeds


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

// Begin: Route for Newsfeed
// Route to Display the Newsfeed Page
Route::get('/newsfeeds',[NewsFeedController::class,'index'])->name('frontEnd.newsfeed.list-newsfeeds');
// Route to Display the full Newsfeed using slug
Route::get('/newsfeedsDetails/{slug}',[NewsFeedController::class,'viewFullNewsfeedBySlug'])->name('frontEnd.newsfeed.viewFullNewsfeedBySlug');

// End: Route for Newsfeed



