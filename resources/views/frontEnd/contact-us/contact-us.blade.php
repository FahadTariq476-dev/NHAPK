@extends('frontEnd.forntEnd_layout.main')
@section('title','Contact Us')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area d-flex align-items-center"
        style="background-image: url('{{ asset('contact_us_bgImage.jpg') }}'); background-size: cover; background-position: center;"        
        >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">Contact Us</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-uppercase text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">Contact Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->
        <br>
        <br>

        <!--====== Contact Area Start ======-->
        <section class="section contact-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h2 class="contact-title text-center">Contact Us</h2>
                            <!-- Form -->
                            <form action="{{route('saveContactUsData')}}" method="POST" id="contactForm">
                                @csrf
                                {{-- Begin: Name Here --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Your Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter Your Name Here:">
                                        </div>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End: Message Here --}}
                                
                                {{-- Begin: Mobile Number --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group" id="divMobNo">
                                            <label for="mob_no">Mobile Number:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+92</span>
                                                </div>
                                                <input type="tel" class="form-control" id="mob_no" name="mob_no" pattern="[0-9]{10}" maxlength="10" minlength="10" 
                                                value="{{old('mob_no')}}" placeholder="Enter Your Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                            </div>
                                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                        </div>
                                        @error('mob_no')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End: Mobile Number --}}

                                {{-- Begin: Email --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Your Email:</label>
                                            <input type="email" class="form-control" id="userEmail" name="email" value="{{old('email')}}" placeholder="Enter Your Email Here:">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End: Email --}}

                                {{-- Begin: Message Here --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message">Your Message:</label>
                                            <textarea class="form-control" id="message" name="message" rows="5">{{old('message')}}</textarea>
                                        </div>
                                        @error('message')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End: Message Here --}}

                                {{-- Begin: Captcha --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group" id="captcha_error">
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                        @error('g-recaptcha-response')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End: Captcha --}}

                                {{-- Begin: Submit Button Here --}}
                                
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                {{-- End: Message Here --}}
                            </form>
                            <!-- Form End -->
        
                            <!-- Success Message -->
                            @if(session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: true,
                                    });
                                </script>
                            @endif

                            <!-- Error Message -->
                            @if(session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: '{{ session('error') }}',
                                        showConfirmButton: true,
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--====== Contact Area End ======-->
        <br>
        <br>
        <!--====== Map Area Start ======-->
        <section class="section map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2485.596666220624!2d-0.16124461362595294!3d51.46556134684942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487605a25375dfb7%3A0xe0d9fa09dcf932a8!2s15%20Theatre%20St%2C%20Battersea%2C%20London%20SW11%205ND%2C%20UK!5e0!3m2!1sen!2sbd!4v1567427969685!5m2!1sen!2sbd" width="100" height="100" style="border:0;" allowfullscreen=""></iframe>
        </section>
        <!--====== Map Area End ======-->

        @endsection()
        @section('frontEnd-js')
        <script>
            function validateMobileNumber(input) {
                // Remove any non-digit characters
                let sanitizedValue = input.value.replace(/\D/g, '');
            
                // Ensure the first digit is 3
                if (sanitizedValue.length > 0 && sanitizedValue[0] !== '3') {
                    // If the first digit is not 3, remove it
                    sanitizedValue = sanitizedValue.slice(1);
                }
            
                // Update the input value with the sanitized value
                input.value = sanitizedValue;
            }
        </script>
        <script>
            $(document).ready(function () {
                function isValidEmail(email) {
                    // Regular expression for a simple email validation
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }
                function validateCaptcha() {
                    var response = grecaptcha.getResponse();
                    if (!response) {
                        $(".alert-danger").remove();
                        $("#captcha_error").after('<div class="alert alert-danger">Please complete the captcha.</div>');
                        return false;
                    }
                    else{
                        return true;
                    }
                }
                // 
                $('#contactForm').submit(function (e) {
                    $(".alert-danger").remove();
                    // Perform form validation here

                    var name = $('#name').val();
                    if(name.trim()===''){
                        e.preventDefault();
                        $('#name').after('<div class="alert alert-danger">Name should be provided</div>');
                    }

                    // check the mobile number is empty or not
                    var mob_no = $('#mob_no').val();
                    if (mob_no.length !== 10 || mob_no[0] !== '3' || !/^\d+$/.test(mob_no)) {
                        e.preventDefault();
                        $("#divMobNo").after('<div class="alert alert-danger">Mobile Number should be provided and should start with 3 and contain only ten digits.</div>');
                    }

                    //  CHeck the email is valid or not
                    var email = $('#userEmail').val();
                    if(email.length==0 || !(isValidEmail(email))){
                        e.preventDefault();
                        $("#userEmail").after('<div class="alert alert-danger">Email should be provided and should be in the correct format.</div>');
                    }

                    var message = $('#message').val();
                    if (!message || message.trim()==='') {
                        e.preventDefault();
                        $("#message").after('<div class="alert alert-danger">Message should be provided.</div>');
                    }
                    // Validate captcha
                    if (!validateCaptcha()) {
                        e.preventDefault();
                    }
                });
            });
        </script>
        @endsection