{{-- <button class="btn btnn" data-toggle="modal" data-target="#cnicModal">login</button> --}}

<!-- End Zero Modal cnicModal-->
    <div class="modal fade" id="cnicModal" tabindex="-1" role="dialog" aria-labelledby="cnicModalModalLabel" aria-hidden="true" style="height: auto;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-top: 3px solid #7367f0;">
                <div class="modal-header" style="border: none;">
                    <h1 class="modal-title fs-5" id=""></h1>
                    <button type="button" class="close" id="closeEcnicModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="row g-3 d-flex justify-content-center" id="fristCnicForm">
                    <div class="col-8 mb-2">
                        <label for="phone" class="form-label">
                            <h5 style="color: #7367f0; font-family: inherit;">Enter Your CNIC Number</h5>
                        </label>
                        <div class="input-group w-100" style="border-top: none;" id="divFirstCnic_no">
                            <input type="text" id="firstCnic_no" class="form-control error mt-2" name="firstCnic_no" minlength="15" maxlength="15"
                                placeholder="Enter your CNIC number"
                                >
                        </div>
                    </div>
                    <div class="col-8 mb-2">
                        <div class="modal-footer" style="border: none;">
                            <button class="btn" type="submit" id="btnLogin" data-toggle="modal">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- End Zero Modal cnicModal-->

<!-- BEGIN FIRST MODAL phoneNumModal -->
<div class="modal fade" id="MobModal" tabindex="-1" role="dialog" aria-labelledby="phoneNumModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" id="closeEnterNumber" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="mobNoForm">
                <div class="col-8 mb-2">
                    <label for="phone" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Phone Number</h5>
                    </label>
                    <div class="input-group w-100" style="border-top: none;">
                        <div class="input-group" id="divPhone_number">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+92</span>
                            </div>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" maxlength="10" minlength="10" 
                            value="{{old('phone_number')}}" placeholder="Enter Your Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                        </div>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border: none;">
                        <button class="btn" type="submit" id="btn-phoneNum">Submit</button>
                        {{-- <button class="btn" type="submit" id="btn-phoneNum" data-toggle="modal" data-target="#passwordModal">Login</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- End FIRST MODAL phoneNumModal-->

<!-- BEGIN SECOND MODAL passwordModal-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <form class="row g-3 d-flex justify-content-center" action="{{route('front-end.client.login_credentials')}}" method="POST" id="passwordFrom"> --}}
            <form class="row g-3 d-flex justify-content-center" id="passwordFrom">
                <div class="col-8 mb-2">
                    <label for="password" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Password</h5>
                    </label>
                    {{-- @csrf --}}
                    <div style="border-top: none;">
                        <input type="hidden" class="form-control" id="phone_number_login" name="phone_number_login" maxlength="10" minlength="10" placeholder="Enter Your Mobile Number Here:" readonly>
                        <input type="hidden" class="form-control" id="cnic_no_login" name="cnic_no_login" maxlength="15" minlength="15" readonly>
                        <input value="" id="loginPassword" type="password" class="form-control" name="password" style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            placeholder="*******" required>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border-top: none;">
                        <button class="btn " type="submit" id="btn-password" data-toggle="modal" data-target="">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End SECOND MODAL passwordModal-->

<!-- Begin OTP Modal-->
    <div class="modal fade" id="OtpModal" tabindex="-1" role="dialog" aria-labelledby="OtpModalLabel" aria-hidden="true"
        style="height: auto;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-top: 3px solid #7367f0;">
                <div class="modal-header" style="border: none;">
                    <h1 class="modal-title fs-5" id=""></h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="row g-3 d-flex justify-content-center" id="otpForm">
                    <div class="col-8 mb-2">
                        <label for="otp" class="form-label text-dark">
                            <h5 style="color: #7367f0; font-family: inherit;">Enter OTP code</h5>
                        </label>
                        <div class="input-group w-100" id="div_verify_otp">
                            <input id="verify_otp" type="text" class="form-control"
                                style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                                placeholder="******" required>
                        </div>
                    </div>
                    <div class="col-8 mb-2">
                        <div class="modal-footer row" style="border-top: none;">
                            <button class="btn btn-success" id="btnOtpResend" data-toggle="modal" data-target="">Resend OTP</button>
                            <button class="btn " id="btn-Otp" data-toggle="modal" data-target="">Verify OTP</button>
                            {{-- <button class="btn " id="btn-Otp" data-toggle="modal" data-target="#RegisterModal">Verify OTP</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End OTP Modal-->

<!-- Begin Fourth Modal => Register New User-->
<div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalLabel"
    aria-hidden="true" style="height:auto; overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0; max-height: 90vh;">
            <!-- Add 'max-height' to limit the height of the modal -->

            <div class="modal-header" style="border-bottom: none;">
                {{-- <h1 class="modal-title fs-5" id="exampleModalToggleLabel3"></h1> --}}
                <h4 class="modal-title fs-5" id="exampleModalToggleLabel3">Register New User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="back">
                {{-- <h2 class="px-5 pb-2" style="color: #7367f0; font-family: inherit;">
                    Register New User</h2> --}}
                <div class="box text-dark">
                    <h4 class="px-5 pb-2" style="color: #7367f0; font-family: inherit;">
                        Enter Your Information</h4>
                        {{-- method="POST" action="{{ route('front-end.storeNewUser') }}" --}}
                    <form  id="m_form_register" class="px-5">
                        @csrf
                        
                        {{-- First Name --}}
                        <div class="form-group">
                            <input type="text" id="firstname" class="form-control error mt-2" name="firstname"
                                placeholder="Enter your first name" value="{{old('firstname')}}"
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Last Name --}}
                        <div class="form-group">
                            <input type="text" id="lastname" class="form-control error mt-2" name="lastname"
                                placeholder="Enter your last name" value="{{old('lastname')}}"
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Email --}}
                        <div class="form-group">
                            <input type="email" id="email" class="form-control error mt-2" name="email"
                                placeholder="Enter your email" value="{{old('email')}}"
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- CNIC Number --}}
                        <div class="form-group" style="display: none">
                            <input type="text" id="cnic_no" class="form-control error mt-2" name="cnic_no" minlength="15" maxlength="15"
                                placeholder="Enter your CNIC number" value="{{old('cnic_no')}}" readonly
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('cnic_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Mobile Number --}}
                        <div class="form-group" id="div_new_phone_number" style="display: none">
                            <div class="input-group w-100" style="border-top: none;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+923</span>
                                    </div>
                                    <input type="tel" class="form-control" id="new_phone_number" name="new_phone_number" maxlength="9" minlength="9" readonly
                                    value="{{old('new_phone_number')}}" placeholder="Enter Your Mobile Number Here:" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);" style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                                </div>
                            </div>
                        </div>
                        @error('new_phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Password --}}
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control error mt-2" minlength="8" maxlength="8"
                                placeholder="Enter your password" 
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Confirm Password --}}
                        <div class="form-group">
                            <input type="password" id="confirmPassword" name="confirmPassword" minlength="8" maxlength="8"
                                class="form-control error mt-2" placeholder="Confirm your password"
                                style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        </div>
                        @error('confirmPassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div style="margin-top: 3px !important; padding-top: 0px !important;">
                            <input type="checkbox" id="showPassword"> Show Password
                        </div>

                        <button type="submit" class="btn btnn w-100 p-2 my-4 loginbutton" id="regsterBtn" style="border: 1px solid #7367f0;">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End: Fourth Modal => Register New User-->


<!-- Include toastr CSS and JS from CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Your custom script using toastr -->
<script>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
</script>
<script>
    $(document).ready(function() {
        // $("#RegisterModal").modal('show');
        var generatedOtp = '';
        let newUser ="";
        // Begin:   Handle the btnLogin
            $("#btnLogin").click(function(e){
                // 
                $('.alert-danger').remove();
                e.preventDefault();
                let firstCnic_no = $("#firstCnic_no").val();
                if(firstCnic_no.length == 15){
                    // 
                    $('#MobModal').modal('show');
                    $('#cnicModal').modal('hide');
                    $.ajax({
                        type:'GET',
                        url:'/checkCNIC/'+firstCnic_no,
                        success:function(response){
                            $(".alert-info").remove();
                            if(response==1){
                                newUser="False";
                                return;
                            }
                            else{
                                newUser="True";
                                $("#divPhone_number").after('<div class="alert alert-info">You are new user. Kindly Enter your Number to register yourself.</div>');
                                return;
                            }
                            $('#MobModal').modal('show');
                            $('#cnicModal').modal('hide');
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                } else if(firstCnic_no.length==0){
                    return;
                }
                else{
                    $("#divFirstCnic_no").after('<div class="alert alert-danger">Valid CNIC No Should be provided.</div>');
                    $("#firstCnic_no").focus();
                    $("$firstCnic_no").val('');
                }
            });
        // End:   Handle the btnLogin
        // Handle the submit button in the Phone Number modal
        $('#btn-phoneNum').click(function(e) {
            // Perform phone number validation
            $('.alert-danger').remove();
            $('.alert-info').remove();
            e.preventDefault();
            let phone_number = $("#phone_number").val();
            let firstCnic_no = $("#firstCnic_no").val();
            if(phone_number.length==0){
                return;
            }
            else if(phone_number.length !== 10 || phone_number[0] !== '3' || !/^\d+$/.test(phone_number)){
                e.preventDefault();
                $("#divPhone_number").after('<div class="alert alert-danger">Mobile Number should be provided and should start with 3 and contain only ten digits.</div>');
                $("#phone_number").focus();
            }
            else{
                if(newUser=="True"){
                    $.ajax({
                        url:'/check-phone_number/'+phone_number,
                        type:'GET',
                        success:function(response){
                            if(response==1){
                                $("#divPhone_number").after('<div class="alert alert-danger">Unique Phone Number should be provided.</div>');
                                $('#MobModal').modal('show');
                                $("#phone_number").focus();
                            }
                            else{
                                $("#div_verify_otp").after('<div class="alert alert-info">You are new user at NHAPK. Kindly Verify your Number to Register yourself.</div>');
                                $('#OtpModal').modal('show');
                                $('#MobModal').modal('hide');
                                $('#passwordModal').modal('hide');
                                generatedOtp = Math.floor(100000 + Math.random() * 900000);
                                toastr.success('OTP Code: ' + generatedOtp);
                                return;
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
                else if(newUser=="False"){
                    // 
                    $.ajax({
                        url:'/check-phone_number/'+firstCnic_no+'/'+phone_number,
                        type:'GET',
                        success:function(response){
                            if(response==1){
                                $('#MobModal').modal('hide');
                                $("#phone_number_login").val(phone_number);
                                $("#cnic_no_login").val(firstCnic_no);
                                $('#passwordModal').modal('show');
                            }
                            else if(response==-1){
                                $("#div_verify_otp").after('<div class="alert alert-info">You are new user at NHAPK. Kindly Verify your Number to login yourself.</div>');
                                $('#OtpModal').modal('show');
                                $('#MobModal').modal('hide');
                                $('#passwordModal').modal('hide');
                                generatedOtp = Math.floor(100000 + Math.random() * 900000);
                                toastr.success('OTP Code: ' + generatedOtp);
                                return;
                            }
                            else{
                                $("#divPhone_number").after('<div class="alert alert-info">Your phone number not matched with provided CNIC. Please try again.</div>');
                                $('#OtpModal').modal('hide');
                                $('#MobModal').modal('show');
                                $('#passwordModal').modal('hide');
                                $("#phone_number").focus();
                                return;
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
                
            }

        });

        // phone number validation function
        function validatePhoneNumber(phoneNumber) {
            // Implement phone number validation logic here
            // Return true if the phone number is valid, otherwise return false
            return phoneNumber.length === 9 && /^[0-9]+$/.test(phoneNumber);
        }
   
        $('#btn-password').click(function(e) {
            // Get the value of the password input
            var loginPassword = $("#loginPassword").val();

            // Validate the password
            if(loginPassword.length!=8){
                e.preventDefault();
                $("#loginPassword").after('<div class="alert alert-danger">Password must be 8 characters.</div>');
                $("#loginPassword").val('');
                $("#loginPassword").focus();
                return;
            }
            else{
                // window.location.href = '/admin/faqs/editfaqs/' + dataId;
                e.preventDefault();
                $.ajax({
                type: 'POST',
                url: 'client/login',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#passwordFrom').serialize(),
                success: function (response) {
                    $('#m_form_register')[0].reset();
                    $('#fristCnicForm')[0].reset();
                    $('#mobNoForm')[0].reset();
                    $('#otpForm')[0].reset();
                    $('#passwordFrom')[0].reset();
                    $('#passwordModal').modal('hide');
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    } else if (response.status === 'error') {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function (err) {
                    // If there is an error adding the user
                    let error = err.responseJSON;
                    Swal.fire('Console Error', error.message, 'error');
                }
            });

                
            }

        });

        // Begin: To Verify the OTP
        $('#btn-Otp').click(function(e){
            let verify_otp = $("#verify_otp").val();
            let phone_number = $("#phone_number").val();
            let firstCnic_no = $("#firstCnic_no").val();
            $(".alert-danger").remove();
            if(verify_otp != generatedOtp){
                e.preventDefault();
                $("#div_verify_otp").after('<div class="alert alert-danger">OTP Password must be matched.</div>');
                $("#verify_otp").focus();
                $("#verify_otp").val('');
                return;
            }
            else{
                e.preventDefault();
                if(newUser=="True"){
                    $("#verify_otp").val('');
                    $("#OtpModal").modal('hide');
                    $("#RegisterModal").modal('show');
                    $("#cnic_no").val(firstCnic_no);
                    $("#new_phone_number").val(phone_number);
                    return;
                }
                else if(newUser=="False"){
                    $('#OtpModal').modal('hide');
                    $("#phone_number_login").val(phone_number);
                    $("#cnic_no_login").val(firstCnic_no);
                    $('#passwordModal').modal('show');
                    return;
                }
                return;
            }
        });
        // End: To Verify the OTP

        // Begin: To resend the OTP
            $("#btnOtpResend").click(function(e){
                e.preventDefault();
                generatedOtp = Math.floor(100000 + Math.random() * 900000);
                toastr.success('OTP Code: ' + generatedOtp);
                return;
            });
        // End: To resend the OTP

        // Begin: Script for the Register New User Form
            // Begin:   Toggle password visibility
                $("#showPassword").click(function() {
                    var passwordInput = $("#password");
                    var confirmPasswordInput = $("#confirmPassword");
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

                // Format CNIC on input
                $('#cnic_no').on('input', function() {
                    formatField($(this));
                });
                
                // Format firstCnic_no on input
                $('#firstCnic_no').on('input', function() {
                    formatField($(this));
                });
            // End:   Function to format CNIC dynamically (323226161887 => 32322-616188-7)

            // Begin: Function to verify the unique email
                // Function to verify the format of email
                function isValidEmail(email) {
                    // Regular expression for a simple email validation
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                $("#email").focusout(function(){
                    let email = $("#email").val();
                    $("#emailDangerAlert").remove();
                    if(email.length!=0 && isValidEmail(email)){
                        // 
                        $.ajax({
                            url: '/checkEmail/' + email,
                            type: 'GET',
                            success: function(response){
                                if (response == 1) {
                                    // alert(email+": Email already exists");
                                    $("#email").after('<div class="alert alert-danger" id="emailDangerAlert">'+email+': Email already exists. Kindly use the unique email.</div>');
                                    $("#email").val('');
                                    $("#email").focus();
                                    return;
                                }
                            }
                        });
                    }
                    else if(email.length==0){
                        return;
                    }
                    else{
                        $("#email").after('<div class="alert alert-danger" id="emailDangerAlert">Valid Email Shiuld be provided</div>');
                        $("#email").focus();
                        $("#email").val('');
                    }
                });
            // End: Function to verify the unique email

            // Begin: Script to verify the unqiue cnic
            $("#cnic_no").focusout(function(){
                let cnic_no = $("#cnic_no").val();
                $("#cnicNoDangerAlert").remove();
                if(cnic_no.length == 15){
                    // 
                    $.ajax({
                        type:'GET',
                        url:'/checkCNIC/'+cnic_no,
                        success:function(response){
                            if(response==1){
                                $("#cnic_no").after('<div class="alert alert-danger" id="cnicNoDangerAlert">CNIC should be unique. Kindly use the unique cnic.</div>');
                                $("#cnic_no").focus();
                                $("#cnic_no").val('');
                                return;
                            }
                            else{
                                return;
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                } else if(cnic_no.length==0){
                    return;
                }
                else{
                    $("#cnic_no").after('<div class="alert alert-danger" id="cnicNoDangerAlert">Valid CNIC No Should be provided.</div>');
                    $("#cnic_no").focus();
                    $("$cnic_no").val('');
                }
            });
            // End: Script to verify the unqiue cnic

            // Begin: To Verify the phone number should be unique
                $('#new_phone_number').focusout(function(e) {
                    // Perform phone number validation
                    $('#divAlertDangerNewPhoneNum').remove();
                    e.preventDefault();
                    let new_phone_number = $("#new_phone_number").val();
                    if(new_phone_number.length==0){
                        return;
                    }
                    else if(!validatePhoneNumber(new_phone_number)){
                        e.preventDefault();
                        $("#div_new_phone_number").after('<div class="alert alert-danger" id="divAlertDangerNewPhoneNum">Valid Phone Number should be provided.</div>');
                        $("#new_phone_number").focus();
                    }
                    else{
                        $.ajax({
                            url:'/check-phone_number/'+new_phone_number,
                            type:'GET',
                            success:function(response){
                                if(response==1){
                                    $("#div_new_phone_number").after('<div class="alert alert-danger" id="divAlertDangerNewPhoneNum">Phone Number should be unique. Kindly Provide unique mob no.</div>');
                                    $("#new_phone_number").focus();
                                    $("#new_phone_number").val('');
                                }
                                else{
                                    return;
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
            // End: To Verify the phone number should be unique

            // Begin:   function to validate form fields
                $("#regsterBtn").click(function(e){
                    $(".alert-danger").remove();

                    // To check the firstname is empty or not
                    let firstname = $("#firstname").val();
                    if(firstname.length ==0 || firstname.trim()==='' || firstname ==null){
                        e.preventDefault();
                        $("#firstname").after('<div class="alert alert-danger">First Name Should be Provided.</div>');
                    }
                    
                    // To check the lastname is empty or not
                    let lastname = $("#lastname").val();
                    if(lastname.length ==0 || lastname.trim()==='' || lastname ==null){
                        e.preventDefault();
                        $("#lastname").after('<div class="alert alert-danger">Last Name Should be Provided.</div>');
                    }
                    
                    // To check the email is valid or not
                    let email = $("#email").val();
                    if(!(isValidEmail(email))){
                        e.preventDefault();
                        $("#email").after('<div class="alert alert-danger">Valid Email Should be Provided.</div>');
                    }
                    
                    // To check the cnic_no is empty or not
                    let cnic_no = $("#cnic_no").val();
                    if(cnic_no.length!=15){
                        e.preventDefault();
                        $("#cnic_no").after('<div class="alert alert-danger">Valid CNIC No Should be Provided.</div>');
                    } 
                    
                    // To check the cnic_no is empty or not
                    
                    let new_phone_number = $("#new_phone_number").val();
                    if(new_phone_number.length !== 10 || new_phone_number[0] !== '3' || !/^\d+$/.test(new_phone_number)){
                    // if(!(validatePhoneNumber(new_phone_number))){
                        e.preventDefault();
                        $("#div_new_phone_number").after('<div class="alert alert-danger">Mobile Number should be provided and should start with 3 and contain only ten digits..</div>');
                    }

                    // To check the password is empty or not
                    let password = $("#password").val();
                    if(password.length ==0 || password.length !=8 || password.trim()==='' || password ==null){
                        e.preventDefault();
                        $("#password").after('<div class="alert alert-danger">Password Should be Provided. Password Length Should be 8 characters.</div>');
                    }
                    
                    // To check the lastname is empty or not
                    let confirmPassword = $("#confirmPassword").val();
                    if(confirmPassword.length ==0 || confirmPassword.length !=8 || confirmPassword.trim()==='' || confirmPassword ==null){
                        e.preventDefault();
                        $("#confirmPassword").after('<div class="alert alert-danger">Confirm Password Should be Provided. Confirm Password Length Should be 8 characters.</div>');
                    }
                    else{
                        if(!(confirmPassword==password)){
                            e.preventDefault();
                            $("#confirmPassword").after('<div class="alert alert-danger">Confirm Password & Password Should be Same.</div>');
                        }
                    }
                    
                });
            // End:   function to validate form fields

            // Submit the form using Ajax
    $('#m_form_register').submit(function (e) {
        e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'client/login/store',
                data: $('#m_form_register').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $(".alert-danger").remove();
                    if (response.status === 'success') {
                        // If the user is added successfully
                        $("#RegisterModal").modal('hide');
                        $('#m_form_register')[0].reset();
                        $('#fristCnicForm')[0].reset();
                        $('#mobNoForm')[0].reset();
                        $('#otpForm')[0].reset();
                        $('#passwordFrom')[0].reset();
                        Swal.fire('Success', response.message, 'success');
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function (err) {
                    // If there is an error adding the user
                    let error = err.responseJSON;
                    $(".alert-danger").remove();
                    if (error.hasOwnProperty('errors')) {
                        $.each(error.errors, function (index, value) {
                            if(index=='new_phone_number'){
                                $("#div_new_phone_number").after('<div class="alert alert-danger">'+value+'</div>');
                            } else {
                                $("#" + index).after('<div class="alert alert-danger">'+value+'</div>');
                            }
                        });
                    } else if (error.hasOwnProperty('message')) {
                        // Display a general error message
                        Swal.fire('Error', error.message, 'error');
                    }
                }
            });
        

    });

        // End: Script for the Register New User Form

        
    });
</script>
    <!-- Begin: Script to Validate Mobile Noumber-->
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
    <!-- End: Script to Validate Mobile Noumber-->