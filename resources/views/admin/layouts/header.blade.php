

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">
                                {{-- John Doe --}}
                                {{ auth()->user()->name }}
                            </span>
                            <span class="user-status">
                                {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}
                            </span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{asset('app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="mail"></i> Inbox</a>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="check-square"></i> Task</a>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="message-square"></i> Chats</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="settings"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="credit-card"></i> Pricing</a>
                        <a class="dropdown-item" href="#"><i class="me-50" data-feather="help-circle"></i> FAQ</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="me-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{route('admin.ShowDashboard')}}">
                        <span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <h2 class="brand-text">NHAPK</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="active nav-item"><a class="d-flex align-items-center" href="{{route('admin.ShowDashboard')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Menus</span><span class="badge badge-light-danger rounded-pill ms-auto me-1">8</span>
                    </a>
                    <!-- Begin: Areas -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Areas</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.areas.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Add New Area</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.areas.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Areas</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Areas -->
                    <!-- Begin: Complaints -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Complaints</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.ListComplaintView')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Complaint List</span></a>
                            </li>
                            <!-- Begin: Complaint_Types -->
                            <li class="nav-item">
                                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Complaint Types</span></a>
                                <ul class="menu-content">
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.complaint-types.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Complaint Types</span></a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.complaint-types.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Complaint Types</span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End: Complaint_Types -->
                        </ul>
                    </li>
                    <!-- End: Complaints -->

                    <!-- Begin: Blogs (News Feed) -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Blogs (News Feed)</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.post-blogs')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Blogs</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.list-blogs')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Blogs</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Blogs (News Feed) -->
                    
                    <!-- Begin: NewsFeeds -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">News & Media</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.newsfeeds.post-newsfeeds')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post News & Media</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.newsfeeds.list-newsfeeds')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List News & Media</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: NewsFeeds -->

                    <!-- Begin: Membership -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Membership</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.list-memebership')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Membership</span></a>
                            </li>
                            <!-- Begin: Membership Types -->
                            <li class="nav-item">
                                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Membership Types</span></a>
                                <ul class="menu-content">
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.membership.membershipTypes.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Membership Types</span></a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.membership.membershipTypes.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Membership Types</span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End: Membership Types -->
                        </ul>
                    </li>
                    <!-- End: Membership -->
                    
                    <!-- Begin: Contact Us -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Contact Us</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.contactUs.list-contactus')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Contact Us</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Contact Us -->
                    <!-- Begin: FAQ's -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">FAQ's</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.faqs.post-faqs')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post FAQ's</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.faqs.list-faqs')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List FAQ's</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: FAQ's -->

                    <!-- Begin: SOP's & Legal Documentation -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">SOP's & Legal Documentation</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.sops.post-sops')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post SOP's & Legal Documentation</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.sops.list-sops')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List SOP's & Legal Documentation</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: SOP's & Legal Documentation -->
                    
                    
                   <!-- Begin: Users -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Users</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.users.list-users')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Users</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Users -->
                    
                    <!-- Begin: Referral Levels -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Referral Levels</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.referralLevels.postReferralLevel')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Post Referral Levels</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.referralLevels.listReferralLevel')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Referral Levels</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Referral Levels -->

                    <!-- Begin: Elections -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Elections</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.elections.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Post Elections</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.elections.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Elections</span></a>
                            </li>
                            <!-- Begin: Elections Category -->
                            <li class="nav-item">
                                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Elections Category</span></a>
                                <ul class="menu-content">
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.electionCategeories.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Elections Category</span></a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.electionCategeories.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Elections Category</span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End: Elections Category -->
                            
                            <!-- Begin: Elections Seats -->
                            <li class="nav-item">
                                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Elections Seats</span></a>
                                <ul class="menu-content">
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.electionSeats.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Elections Seats</span></a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.electionSeats.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Elections Seats</span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End: Elections Seats -->
                        </ul>
                    </li>
                    <!-- End: Elections -->

                    <!-- Begin: Candidate Nomination -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Candidate Nomination</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.CandidateNomination.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Candidate Nomination</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.CandidateNomination.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Save Candidate Nomination</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Candidate Nomination -->

                    <!-- Begin: Election Suggestion / Objection -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Election Suggestion / Objection</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.electionSuggestion.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Election Suggestion / Objection</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Election Suggestion / Objection -->
                    
                    <!-- Begin: Vote -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Vote</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.Vote.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Vote</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Vote -->
                    
                    <!-- Begin: Election Result -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Election Result</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.electionsResult.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">View Election Result</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- End: Election Result -->

                    <!-- Begin: Organogram -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Organogram</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.organogram.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Post Organogram</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.organogram.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Organogram</span></a>
                            </li>
                            <!-- Begin: Organogram Designation -->
                            <li class="nav-item">
                                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Organogram Designation</span></a>
                                <ul class="menu-content">
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.organogramDesignation.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Post Organogram Designation</span></a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-items-center" href="{{route('admin.organogramDesignation.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Organogram Designation</span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End: Organogram Designation -->
                        </ul>
                    </li>
                    <!-- End: Organogram -->
                    
                    <!-- Begin: Survey's Form -->
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Survey's Form</span></a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.suverysForm.post')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Post Survey's Form</span></a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center" href="{{route('admin.suverysForm.list')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">List Survey's Form</span></a>
                            </li>
                            <!-- End: Survey's Form  -->
                        </ul>
                    </li>
                    <!-- End: Organogram -->
                </li>
            </ul>
        </div>
        
    </div> 
    <!-- END: Main Menu -->
