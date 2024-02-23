@extends('frontEnd.forntEnd_layout.main')
@section('title','Register New Account')
@section('main-container')
        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- d-flex flex-column align-items-center text-center">
                            <h2 class="text-white mb-3">Register New Account</h2>
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">Members</li> --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->


        <!-- ***** Team Area Start ***** -->
        <section class="section team-area bg-light pt-5 pb-5">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        
            <!-- Content Here -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Regsiter Your Account</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-4">
                                <!-- form -->
                                <form  id="userRegsiterForm" method="POST" action="{{route('front-end.client.storeReferralUser')}}">
                                    @csrf

                                    <!-- Full Name -->
                                    <div class="form-group">
                                        <label for="userFullName">Full Name:</label>
                                        <input type="text" name="userFullName" id="userFullName" class="form-control" placeholder="Enter Your Full Name Here:" value="{{old('userFullName')}}" minlength="3" maxlength="255" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userFullNameError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userFullName')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Father Name -->
                                    <div class="form-group">
                                        <label for="userFatherName">Father Name:</label>
                                        <input type="text" name="userFatherName" id="userFatherName" class="form-control" placeholder="Enter Your Father Name Here:" value="{{old('userFatherName')}}" minlength="3" maxlength="255" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userFatherNameError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userFatherName')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- User Email -->
                                    <div class="form-group">
                                        <label for="userEmail">User Email:</label>
                                        <input type="email" name="userEmail" id="userEmail" class="form-control" placeholder="Enter Your Email Here:" value="{{old('userEmail')}}" minlength="3" maxlength="255" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userEmailError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userEmail')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Cnic No  -->
                                    <div class="form-group">
                                        <label for="userCnicNo">Cnic No:</label> 
                                        <input type="text" name="userCnicNo" id="userCnicNo" class="form-control" placeholder="Enter Your Cnic No Here:" value="{{old('userCnicNo')}}" minlength="15" maxlength="15" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userCnicNoError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userCnicNo')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Referal Cnic No  -->
                                    <div class="form-group">
                                        <label for="referalCnicNo">Referal Cnic No:</label>
                                        <input type="text" name="referalCnicNo" id="referalCnicNo" class="form-control" value="{{$referalCnicNo}}" placeholder="Enter Your Cnic No Here:" minlength="15" maxlength="15" readonly>
                                        <div class="alert alert-danger" role="alert" id="referalCnicNoError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('referalCnicNo')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Mobile No  -->
                                    <div class="form-group" id="divUserMobileNo">
                                        <label for="userMobileNo">Mobile No:</label>
                                        <div class="input-group" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+92</span>
                                            </div>
                                            <input type="text" name="userMobileNo" id="userMobileNo" class="form-control" placeholder="Enter Your Mobile No Here:" value="{{old('userMobileNo')}}" minlength="10" maxlength="10" autofocus
                                            oninput="validateMobileNumber(this)">
                                        </div>
                                        <div class="alert alert-danger" role="alert" id="userMobileNoError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                        <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                    </div>
                                    @error('userMobileNo')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror

                                    <!-- Membership Roles -->
                                    <div class="form-group">
                                        <label for="userRoleId">Select Your Role</label>
                                        <select name="userRoleId" id="userRoleId" class="form-control">
                                            <option value="" selected disabled>Please Identify Your Self</option>
                                            @if (isset($roles) && count($roles) > 0)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" @if ($role->id == old('userRoleId')) selected @endif>{{ $role->name }}</option>
                                                @endforeach
                                            @else
                                                <option disabled>No Role Found.</option>
                                            @endif
                                        </select>
                                        <div class="alert alert-danger" role="alert" id="userRoleIdError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userRoleIdError')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
            
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="userPassword">Password:</label>
                                        <input type="password" name="userPassword" id="userPassword" class="form-control" placeholder="Enter Your Password Here:" minlength="8" maxlength="8" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userPasswordError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userPassword')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <label for="userConfirmPassword">Confirm Password:</label>
                                        <input type="password" name="userConfirmPassword" id="userConfirmPassword" class="form-control" placeholder="Enter Your Confirm Password Here:" minlength="8" maxlength="8" autofocus>
                                        <div class="alert alert-danger" role="alert" id="userConfirmPasswordError" style="display: none; padding: 0rem; margin-bottom: 0;"></div>
                                    </div>
                                    @error('userConfirmPassword')
                                        <div class="alert alert-danger" role="alert" style="display: none; padding: 0rem; margin-bottom: 0;">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <input type="checkbox" id="userShowPassword"> Show Password
                                    </div>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-success" id="resetBtn">Reset</button>
                                        <button type="submit" class="btn btn-success" id="userRegsterBtn">Register</button>
                                    </div>
            
                                </form>
                                <!-- form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Content Here -->
        
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
            c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
            c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Team Area End ***** -->


        <!--====== Call To Action Area Start ======-->
        <section class="section cta-area bg-overlay ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <!-- Section Heading -->
                        <div class="section-heading text-center m-0">
                            <h1 class="text-white">Looking for the best hostel registration &amp; marketing solution?</h1>
                            <p class="text-white d-block d-sm-block mt-4">We are National Hostel Association of Pakistan.</p>
                            <p class="text-white d-block d-sm-block mt-4">A non-profit organization. The hostel owners community named as National Hostels Association of Pakistan</p>
                            <a href="{{route('ContactUsForm')}}" class="btn btn-bordered-white mt-4">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Call To Action Area End ======-->
@endsection
@section('frontEnd-js')
    <script type="text/javascript">
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
        $(document).ready(function () {
            // Begin:   Toggle password visibility
            $("#userShowPassword").click(function() {
                var passwordInput = $("#userPassword");
                var confirmPasswordInput = $("#userConfirmPassword");
                passwordInput.attr("type", passwordInput.attr("type") === "password" ? "text" : "password");
                confirmPasswordInput.attr("type", confirmPasswordInput.attr("type") === "password" ? "text" : "password");
            });
            // End:   Toggle password visibility


            // Begin:   Function to format CNIC dynamically (323226161887 => 32322-616188-7)
            function formatField(field) {
                var value = field.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
                var formattedValue = formatCnic(value);
                field.val(formattedValue);
            }

            // Function to format CNIC dynamically (323226161887 => 32322-616188-7)
            function formatCnic(value) {
                if (value.length >= 5 && value.length < 12) {
                    return value.slice(0, 5) + '-' + value.slice(5);
                } else if (value.length >= 12) {
                    return value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 15);
                } else {
                    return value;
                }
            }
            
            // Format firstCnic_no on input
            $('#userCnicNo').on('input', function() {
                formatField($(this));
            });
            // End:   Function to format CNIC dynamically (323226161887 => 32322-616188-7)

            // Begin: Function to verify the unique userEmail
            // Function to verify the format of email
            function isValidEmail(email) {
                // Regular expression for a simple email validation
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            $("#userEmail").focusout(function(){
                let userEmail = $("#userEmail").val();
                $("#emailDangerAlert").remove();
                if(userEmail.length!=0 && isValidEmail(userEmail)){
                    // 
                    $.ajax({
                        url: '/users/email-unique/' + userEmail,
                        type: 'GET',
                        success: function(response){
                            if (response.status == 0) {
                                $("#userEmail").after('<div class="alert alert-danger" id="emailDangerAlert">'+userEmail+': Email already exists. Kindly use the unique email.</div>');
                                $("#userEmail").val('');
                                $("#userEmail").focus();
                                return;
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred: ' + error.responseJSON.message,
                            });
                        }
                    });
                }
                else if(userEmail.length == 0){
                    return;
                }
                else{
                    $("#userEmail").after('<div class="alert alert-danger" id="emailDangerAlert">Valid Email Shiuld be provided</div>');
                    $("#userEmail").focus();
                    $("#userEmail").val('');
                }
            });
            // End: Function to verify the unique userEmail


            // Begin: Function to verify the unique userMobileNo
            $("#userMobileNo").focusout(function () {
                $("#dangerAlertUserMobileNo").remove();
                let userMobileNo = $("#userMobileNo").val();
                if(userMobileNo.trim() === '' || userMobileNo == null || userMobileNo.length == 0){
                    return false;
                }
                else if(userMobileNo.length>0 && userMobileNo.length != 10){
                    $("#divUserMobileNo").after('<div class="alert alert-danger" id="dangerAlertUserMobileNo">Valid Mob No Should be provided.</div>');
                    $("#userMobileNo").focus();
                    return false;
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/users/mob-no-unique/+92"+userMobileNo,
                        success: function (response) { 
                            if(response.status == 0){
                                $("#divUserMobileNo").after('<div class="alert alert-danger" id="dangerAlertUserMobileNo">This Mob No exist in our record. Kindly Provide the Unique Mobile No..</div>');
                                $("#userMobileNo").focus();
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred: ' + error.responseJSON.message,
                            });
                        }
                    });
                }
            });
            // End: Function to verify the unique userMobileNo

            // Begin: Function to verify the unique userCnicNo 
            $("#userCnicNo").focusout(function () { 
                $("#dangerAlertUserCnicNo").remove();
                let userCnicNo = $("#userCnicNo").val();
                if(userCnicNo.trim() === '' || userCnicNo == null || userCnicNo.length == 0){
                    return false;
                }
                else if(userCnicNo.length>0 && userCnicNo.length != 15){
                    $("#userCnicNo").after('<div class="alert alert-danger" id="dangerAlertUserCnicNo">Valid Cnic No Should be provided.</div>');
                    $("#userCnicNo").focus();
                    return false;
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/users/cnic-unique/"+userCnicNo,
                        success: function (response) {
                            if(response.status == 0){
                                $("#userCnicNo").after('<div class="alert alert-danger" id="dangerAlertUserCnicNo">'+response.message+'</div>');
                                $("#userCnicNo").focus();
                                return;
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred: ' + error.responseJSON.message,
                            });
                        }
                    });
                }
            });
            // End: Function to verify the unique userCnicNo 


            // Add validation rules to the form
            $("#userRegsiterForm").validate({
                rules: {
                    userFullName: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    userFatherName: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    userEmail: {
                        required: true,
                        email: true,
                    },
                    userCnicNo: {
                        required: true,
                        minlength: 15,
                        maxlength: 15,
                    },
                    referalCnicNo: {
                        required: true,
                        minlength: 15,
                        maxlength: 15,
                    },
                    userMobileNo: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true,
                    },
                    userRoleId: {
                        required: true,
                    },
                    userPassword: {
                        required: true,
                        minlength: 8,
                        maxlength: 8,
                    },
                    userConfirmPassword: {
                        required: true,
                        minlength: 8,
                        maxlength: 8,
                        equalTo: "#userPassword",
                    },
                    // Add rules for other fields here...
                },
                messages: {
                    userFullName: {
                        required: "Please Enter Full Name.",
                        minlength: "Full Name must be at least 3 characters.",
                        maxlength: "Full Name must not exceed 255 characters."
                    },
                    userFatherName: {
                        required: "Please Enter Father Name.",
                        minlength: "Father Name must be at least 3 characters.",
                        maxlength: "Father Name must not exceed 255 characters."
                    },
                    userEmail: {
                        required: "Please Enter an Email.",
                        email: "Please Enter Valid Email.",
                    },
                    userCnicNo: {
                        required: "Please Enter Cnic No.",
                        minlength: "Cnic No Number must be at least 15 characters.",
                        maxlength: "Cnic No Number must not be exceed 15 characters.",
                        digits: "Please Enter digits only."
                    },
                    referalCnicNo: {
                        required: "Please Enter Mobile Number",
                        minlength: "Mobile Number must be at least 9 characters.",
                        maxlength: "Mobile Number must not be exceed 9 characters.",
                        digits: "Please Enter Digits only."
                    },
                    userMobileNo: {
                        required: "Please Enter Mobile Number",
                        minlength: "Mobile Number must be at least 9 characters.",
                        maxlength: "Mobile Number must not be exceed 9 characters.",
                        digits: "Please Enter Digits only.",
                    },
                    userRoleId: {
                        required: "Please Select the Role.",
                    },
                    userPassword: {
                        required: "Please Enter Password.",
                        minlength: "Password must be at least 8 characters.",
                        maxlength: "Password must not be exceed 8 characters.",
                    },
                    userConfirmPassword: {
                        required: "Please Enter Confirm Password.",
                        minlength: "Confirm Password must be at least 8 characters.",
                        maxlength: "Confirm Password must not be exceed 8 characters.",
                        equalTo: "Confirm Password doesn\'t Match with Password.",
                    },
                    // Add messages for other fields here...
                },
                errorPlacement: function (error, element) {
                    // Display the validation error in the corresponding alert div
                    $("#" + element.attr("id") + "Error").html(error.text()).show();
                },
                success: function (label, element) {
                    // Clear the error message when the field is valid
                    $("#" + element.id + "Error").html("").hide();
                },
                submitHandler: function (form) {
                    // Form is valid, you can submit it here
                    form.submit();
                }
            });


        });
    </script>
@endsection