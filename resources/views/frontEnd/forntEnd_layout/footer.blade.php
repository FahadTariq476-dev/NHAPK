    <!--====== Footer Area Start ======-->
    <footer class="section footer-area">
        <!-- Footer Top -->
        <div class="footer-top ptb_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title mb-2">About Us</h3>
                            <ul>
                                <li class="py-2"><a class="text-black-50" href="#">Company Profile</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Testimonials</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Careers</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Partners</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Affiliate Program</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title mb-2">Services</h3>
                            <ul>
                                <li class="py-2"><a class="text-black-50" href="#">Web Application</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Product Management</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">User Interaction Design</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">UX Consultant</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Social Media Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title mb-2">Support</h3>
                            <ul>
                                <li class="py-2"><a class="text-black-50" href="{{route('frontEnd.faqs')}}">Frequently Asked</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Terms &amp; Conditions</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Privacy Policy</a></li>
                                <li class="py-2"><a class="text-black-50" href="#">Help Center</a></li>
                                <li class="py-2"><a class="text-black-50" href="{{route('ContactUsForm')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title mb-2">Follow Us</h3>
                            <p class="mb-2 text-justify">We are National Hostel Association of Pakistan. A non-profit organization. The hostel owners community named as National Hostels Association of Pakistan</p>
                            <!-- Social Icons -->
                            <ul class="social-icons list-inline pt-2">
                                <li class="list-inline-item px-1"><a href="https://www.facebook.com/natioanalhostelsassociation" target="_blank"><i class="fab fa-facebook"></i></a></li>
                                <li class="list-inline-item px-1"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item px-1"><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li class="list-inline-item px-1"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="list-inline-item px-1"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom -->
        <div class="footer-bottom bg-grey">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Copyright Area -->
                        <div class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                            <!-- Copyright Left -->
                            <div class="copyright-left">&copy; Copyrights 2023 NHAPK All rights reserved.</div>
                            <!-- Copyright Right -->
                            <div class="copyright-right">Made with <i class="fas fa-heart"></i> By <a href="#">NHAPK</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--====== Footer Area End ======-->



    <!--====== Modal Responsive Menu Area Start ======-->
    <div id="menu" class="modal fade p-0">
        <div class="modal-dialog dialog-animated">
            <div class="modal-content h-100">
                <div class="modal-header" data-dismiss="modal">
                    Menu <i class="far fa-times-circle icon-close"></i>
                </div>
                <div class="menu modal-body">
                    <div class="row w-100">
                        <div class="items p-0 col-12 text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Modal Responsive Menu Area End ======-->

    
    @include('frontEnd.forntEnd_layout.loginmodal')

