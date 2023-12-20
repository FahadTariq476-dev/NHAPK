<?php

use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\BlogFrontEndController;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\SopAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostBlogsController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\HostelRegistrationController;
use App\Http\Controllers\Admin\CompliantTypeController;
use App\Http\Controllers\Client\LogoutClientController;
use App\Http\Controllers\Admin\ComplaintAdminController;
use App\Http\Controllers\Admin\ContactUsAdminController;
use App\Http\Controllers\Admin\NewsFeedsAdminController;
use App\Http\Controllers\Admin\MembershipAdminController;
use App\Http\Controllers\Client\DashboardClientController;
use App\Http\Controllers\Client\membership\MembershipClientController;
use App\Http\Controllers\Client\sops\SopsClientController;
use App\Http\Controllers\Frontend\Client\LoginClientController;

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

Route::get('/get-states/{country_id}', [StatesController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{state_id}', [CityController::class, 'getCities'])->name('get.cities');
Route::get('/get-properties/{city_id}', [PropertyController::class, 'getProperties'])->name('get.properties');
Route::get('/checkEmail/{email}', [UserController::class, 'uniqueEmail'])->name('frontEnd.users.check-email');
// Route the check the CNIC from the user table
Route::get('/checkCNIC/{cnic}', [UserController::class, 'uniqueCNIC'])->name('uniqueCNIC');



Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        // Route to show the admin login page
        Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.showForm');
        // Route to login the page
        Route::post('/login', [LoginController::class, 'AdminloginPost'])->name('admin.login.post');
    });
});

// Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['role:nhapk_admin', 'auth']], function () {
    // Admin Front Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.ShowDashboard');
    // Route::get('/admin/dashboard',[DashboardController::class,'showAdminDashboard'])->name('admin.ShowDashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Begin: Route for Complaint
    // Route to Show List Complaint View
    Route::get('/admin/listComplaint', [ComplaintAdminController::class, 'adminListComplaintView'])->name('admin.ListComplaintView');
    // Route for admin to list complaint
    Route::get('/get-adminListingComplaint', [ComplaintAdminController::class, 'adminListingComplaint'])->name('admin.adminListingComplaint');
    // Route for admin to update the complaint status
    Route::get('/complaint/update-status/{status}/{complaintId}', [ComplaintAdminController::class, 'updateComplaintStatus'])->name('admin.updateComplaintStatus');
    // Route to get the complaint details using complaint id
    Route::get('/admin/complaint/list-complaint/get-details/{id}',[ComplaintAdminController::class,'get_details'])->name('admin.complaints.get-details');
    // End: Route for Complaint

    // Begin: Route for Complaint_Types
    // Route for the admin to show the post-complaint_types.bldae.php
    Route::get('/admin/complaint-types/post',[CompliantTypeController::class,'index'])->name('admin.complaint-types.index');
    // Route for the admin to post the complaint_types in the db
    Route::post('/admin/complaint-types/post',[CompliantTypeController::class,'store'])->name('admin.complaint-types.store');
    // Route for the admin to show the edit-complaint-types.blade.php with complaints
    Route::get('/admin/complaint-types/edit-complaint-types/{id}',[CompliantTypeController::class,'edit'])->name('admin.complaint-types.edit');
    // Route for the admin to update the full complaint-types
    Route::post('/admin/complaint-types/update',[CompliantTypeController::class,'update'])->name('admin.complaint-types.update');
    // Route for the admin to show the list-complaint-types.blade.php
    Route::get('/admin/complaint-types/list-complaint-types',[CompliantTypeController::class,'list'])->name('admin.complaint-types.list');
    // Route for the admin to show the list-complaint-types.blade.php
    Route::get('/admin/complaint-types/list-complaint-types/get-complaint-types',[CompliantTypeController::class,'get_complaint_types'])->name('admin.complaint-types.get-complaint-types');
    // Route to update_status from active to inactive or vice verse 
    Route::get('/admin/complaint_types/list-complaint-types/update-status/{statu}/{id}',[CompliantTypeController::class,'update_status'])->name('admin.complaint-types.update-status');
    // Route for the admin to get the full description of complaint_types using complaint_types id
    Route::get('/admin/complaint-types/list-complaint-types/description/{id}',[CompliantTypeController::class,'get_description'])->name('admin.complaint-types.get_description');
    // End: Route for Complaint_Types

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

    // Begin: Route for FAQ's
    // Route for admin to show the post faqs page
    Route::get('/admin/post-faqs',[FaqAdminController::class,'index'])->name('admin.faqs.post-faqs');
    // Route for the admin to save the faq's
    Route::post('/admin/storeFaqs',[FaqAdminController::class,'storeFaqs'])->name('admin.faqs.storeFaqs');
    // Route for the admin to get the list of faqs and show them in the data table
    Route::get('/admin/get-faqs',[FaqAdminController::class,'adminListingFaqs'])->name('admin.faqs.adminListingFaqs');
    // Route for admin to update the status  of faqs from the listing page using ajax request
    Route::get('/admin/faqs/update-status/{status}/{faqsId}',[FaqAdminController::class,'updateFaqsStatus'])->name('admin.faqs.updateFaqsStatus');
    // Route for the admin to show the edit-faqs with faqs's requested from listing
    Route::get('/admin/faqs/editfaqs/{id}',[FaqAdminController::class,'editFaqsView'])->name('admin.faqs.editFaqsView');
    // Route for the admin to update the full faq's from the edit view
    Route::post('/admin/faqs/update',[FaqAdminController::class,'updateFullFaqs'])->name('admin.faqs.updateFullFaqs');
    // Route for admin to show the FAQ's listing page
    Route::get('/admin/list-faqs',[FaqAdminController::class, 'listFaqsView'])->name('admin.faqs.list-faqs');
    // Route for the the admin to get answer of FAQ's using the id
    Route::get('/admin/faqs/list-faqs/get-answer/{id}',[FaqAdminController::class,'get_answer'])->name('admin.faqs.get_answer');
    // Route for admin to delete the FAQ's from listing page
    Route::get('/admin/faqs/delete-faqs/{id}',[FaqAdminController::class,'delFaqs'])->name('admin.faqs.delFaqs');
    // End: Route for FAQ's

    // Begin: Route for SOP's & Legal Documentation
    // Route for admin to show the post sops page
    Route::get('/admin/sops/post-sops',[SopAdminController::class,'index'])->name('admin.sops.post-sops');
    // Route for admin to save the SOP's in database
    Route::post('/admin/sops/storeSops',[SopAdminController::class,'storeSops'])->name('admin.sops.storeSops');
    // Route for admin to list the SOP's page
    Route::get('/admin/sops/list-sops',[SopAdminController::class,'listSopsView'])->name('admin.sops.list-sops');
    // Route for admin to get the list of sops and show them in the data table
    Route::get('/admin/sops/get-list',[SopAdminController::class,'getSops'])->name('admin.sops.getSops');
    // ROute for admin to show the edit-sops having sopsId from listing page
    Route::get('/admin/sops/edit-sops/{sopsId}',[SopAdminController::class,'editSops'])->name('admin.sops.editSops');
    // Route for admin to update the full sops requested from edit-sops page
    Route::post('/admin/sops/update-sops',[SopAdminController::class,'updateSops'])->name('admin.sops.updateSops');
    // Route for admin to delete the sops requested from list-sops page
    Route::get('/admin/sops/delete-sops/{sopsId}',[SopAdminController::class,'deleteSops'])->name('admin.sops.deleteSops');
    // Route for the the admin to get description of sops using the id
    Route::get('/admin/sops/list-sops/get-description/{id}',[SopAdminController::class,'get_description'])->name('admin.sops.get_description');
    // End: Route for SOP's & Legal Documentation

    // Begin: Route for Users
    // Route for admin to list the users
    Route::get('/admin/users/list',[UserAdminController::class,'index'])->name('admin.users.list-users');
    // End: Route for Users


});




// Begin: Routes For FrontEnd
// Begin: About Us
// Route to Show the about Us Page on the front End
Route::get('/about', [AboutController::class, 'showAbout'])->name('forntEnd.showAbout');
// End: About Us

// Begin: Contact Us
// Show the contact us Form
Route::get('contact-us', [ContactUsController::class, 'showContactUsForm'])->name('ContactUsForm');
// Save the Contact Us data
Route::post('saveContactUs', [ContactUsController::class, 'saveData'])->name('saveContactUsData');
// End: Contact Us

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

// Begin: Route for FAQ's
// Route to show the FAQ's
Route::get('/faqs',[FaqController::class,'index'])->name('frontEnd.faqs');
// End: Route for FAQ's

// Begin: Route for Membership
// Route for the frontEnd to show the membership registration form.
Route::get('/membership/registration', [MembershipController::class, 'show'])->name('membershipRegister');
// Route for the frontEnd to show the membership registration form having encrypted atuhor_id in the token
Route::get('/membership/registration/referral/{token}', [MembershipController::class, 'show_membership_referal'])->name('membership.registration.refferal');
// Route for the frontEnd to store the membership registration form data from the post-memebrship-refferal.blade.ph
Route::post('//membership/registration/referral', [MembershipController::class, 'store_memebership_refferal'])->name('frontEnd.memebrship.registration.refferal.store');
// Route for the frontEnd to store the membership registration form data
Route::post('/addMembership', [MembershipController::class, 'addMembership'])->name('frontEnd.memebrship.store');
// Route to check the CNIC in Membership table
Route::get('/checkCNIC_Membership/{cnic}', [MembershipController::class, 'chkMembershipCNIC'])->name('checkCNIC_Membership');
// Route to check the transaction no from the membership table
Route::get('/checkTransaction_no/{id}', [MembershipController::class, 'checkTransaction_No'])->name('frontEnd.memebeship.checkTransaction_No');
// End: Route for Membership

// Begin: Route for Register Hostel
// Route to show register hostel form
Route::get('/saveHostelForm', [HostelRegistrationController::class, 'saveHostel'])->name('saveHostelForm');
// Route to save the register the hostel in db
Route::post('hostelRegistration/save', [HostelRegistrationController::class, 'hostelRegister'])->name('hostelRegistration.save');
// Route to check the Hostel Owner CNIC fron the properties table
Route::get('hostelRegistration/hostelOwnerCniccheck/{hostelOwnerCnic}', [HostelRegistrationController::class, 'hostelOwnerCniccheck'])->name('hostelRegistration.OwnerCnicCheck');
// Route to  check the Hostel partner CNIC from the properties_partner table
Route::get('hostelRegistration/hostelPartnerCniccheck/{hostelPartnerCnic}', [HostelRegistrationController::class, 'hostelPartnerCniccheck'])->name('hostelRegistration.PartnerCnicCheck');
// Route to  check the Hostel warden CNIC from the properties_wardenr table
Route::get('hostelRegistration/hostelWardenCniccheck/{hostelWardenCnic}', [HostelRegistrationController::class, 'hostelWaardenCnicCheck'])->name('hostelRegistration.WardenCnicCheck');
// Route to check the hostel name is unique or not
Route::get('hostelRegistration/hostelName/{hostelName}', [HostelRegistrationController::class, 'hostelNameCheck'])->name('hostelRegistration.HostelNameCheck');
// Route to check the Hostel Id from the properties table
Route::get('/checkHostelId/{id}', [PropertyController::class, 'properties_IdCheck'])->name('properties.checkHostelId');
// Route to getHostelSuggestions
Route::get('/get-hostel-suggestions', [PropertyController::class, 'getHostelSuggestions'])->name('frontEnd.getHostelSuggestions');
// Route for the frontEnd to take HostelRegNo form the banner of homepage
Route::post('/hostels/hostel-details', [PropertyController::class,'findHostelById'])->name('frontEnd.hostels.findHostelById');
// End: Route for Register Hostel

// Route to check that mobile number is exist or not
Route::get('/check-phone_number/{phone_number}',[LoginClientController::class,'checkPhoneNumber'])->name('checkPhoneNumber');
// Route to check that mobile number is exist or not with given Cnic
Route::get('/check-phone_number/{cnic_no}/{phone_number}',[LoginClientController::class,'cnicCheckPhoneNumber'])->name('cnic.checkPhoneNumber');

// End: Routes For FrontEnd


// Begin: Routes For FrontEnd
////////user list
Route::get('/list',[UserController::class,'index'])->name('admin.user');


// Begin: Login Route for Client
Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'client'], function () {
        // Route to show the client login page
        Route::get('/login', [LoginClientController::class, 'index'])->name('front-end.client.login');
        // Route to login the page
        Route::post('/login', [LoginClientController::class, 'login_credentials'])->name('front-end.client.login_credentials');
        // Route to store new use
        Route::post('/login/store',[LoginClientController::class,'storeNewUser'])->name('front-end.storeNewUser');
    });
});
// End: Login Route for Client

// Begin: Route for Client
Route::group(['middleware' => ['role:nhapk_client', 'auth']], function () {
    // Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.ShowDashboard');
    // Route::get('/admin/dashboard',[DashboardController::class,'showAdminDashboard'])->name('admin.ShowDashboard');

    Route::get('/client/dashboard',[DashboardClientController::class,'index'])->name('client.dashboard.index');
    
    // Route for client to logout
    Route::get('client/logout',[LogoutClientController::class,'logout'])->name('client.logout');

    // Begin: Membership
        Route::get('client/membership/index',[MembershipClientController::class,'index'])->name('client.membership.index');
        // Route for client to show referal link of membership
        Route::get('/client/memebership/referal',[MembershipClientController::class,'show_refferal'])->name('client.membership.show_refferal');
    // End: Membership

    // Begin: SOPS
        // Route for client to list and download the sops
        Route::get('/client/sops/list',[SopsClientController::class,'list_sops'])->name('client.sops.list_sops');
        // Route for the the client to get description of sops using the id
        Route::get('/client/sops/list/get-description/{id}',[SopAdminController::class,'get_description'])->name('client.sops.get_description');
    // End: SOPS

});
// End: Route for Client

