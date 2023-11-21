@extends('frontEnd.forntEnd_layout.main')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb-content text-center">
                            <h2 class="text-white text-uppercase mb-3">Contact Us</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-uppercase text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-uppercase text-white" href="/">Pages</a></li>
                                <li class="breadcrumb-item text-white active">Contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->

        <!--====== Contact Area Start ======-->



        <section id="contact" class="contact-area ptb_100">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-5">
                        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Contact Us</h2>
            </div>
            <div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>

                        <!-- Contact Box -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="contact-form" action="{{route('saveContactUsData')}}" method="POST" id="contactForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name Here:" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mob_no">Mobile Number:</label>
                                        <label>+923</label>
                                        <input type="tel" class="form-control" id="mob_no" name="mob_no" pattern="[0-9]{9}" maxlength="9" minlength="9" placeholder="Enter Your Mobile Number Here:" required>
                                        <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Here:" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message:</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </section>
        <!--====== Contact Area End ======-->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script>
            $(document).ready(function () {
                function isValidEmail(email) {
                    // Regular expression for a simple email validation
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }
                $('#contactForm').submit(function (e) {
                    // Perform form validation here
                    function showErrorAlert(message, elementId) {
                        alert(message);
                        $(elementId).focus();
                        e.preventDefault();
                    }
                    var name = $('#name').val();
                    var mob_no = $('#mob_no').val();
                    var email = $('#email').val();
                    var message = $('#message').val();
                    if (!name) {
                        showErrorAlert("Name must be provided.", '#name');
                        return;
                    }
                    if (!mob_no) {
                        showErrorAlert("Mobile Number must be provided.", '#mob_no');
                        return;
                    }
                    if (mob_no.length !== 9) {
                        showErrorAlert("Mobile Number must be provided correctly.", '#mob_no');
                        return;
                    }
                    if (!email) {
                        showErrorAlert("Email must be provided.", '#email');
                        return;
                    }
                    if (!isValidEmail(email)) {
                        showErrorAlert("Email should be provided in correct format.", '#email');
                        return;
                    }
                    if (!message) {
                        showErrorAlert("Message must be provided.", '#message');
                        return;
                    }
                });
            });
        </script>

        <!--====== Map Area Start ======-->
        <section class="section map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2485.596666220624!2d-0.16124461362595294!3d51.46556134684942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487605a25375dfb7%3A0xe0d9fa09dcf932a8!2s15%20Theatre%20St%2C%20Battersea%2C%20London%20SW11%205ND%2C%20UK!5e0!3m2!1sen!2sbd!4v1567427969685!5m2!1sen!2sbd" width="100" height="100" style="border:0;" allowfullscreen=""></iframe>
        </section>
        <!--====== Map Area End ======-->

        @endsection()