<!-- Begin: First CNIC Modal -->
<div class="modal fade" id="cnicModal" tabindex="-1" role="dialog" aria-labelledby="cnicModalModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" id="closeCnicModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="fristCnicForm">
                <div class="col-8 mb-2">
                    <label for="phone" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your CNIC Number</h5>
                    </label>
                    <div class="input-group w-100 mb-1" style="border-top: none;" id="divFirstCnic_no">
                        <input type="text" id="firstCnic_no" class="form-control error mt-2" name="firstCnic_no" minlength="15" maxlength="15"
                            placeholder="Enter your CNIC number"
                            >
                    </div>
                    <div class="form-group">
                        <a href="#" id="btnForgotPassowrd">Forgot Password</a>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border: none;">
                        <button class="btn btn-primary" type="submit" id="btnRegister" data-toggle="modal">Register</button>
                        <button class="btn btn-success" type="submit" id="btnCnicNext" data-toggle="modal">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Begin: First CNIC Modal -->

<!-- Begin 2nd Modal phoneNumberModal -->
<div class="modal fade" id="phoneNumberModal"  role="dialog" aria-labelledby="phoneNumModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" id="closephoneNumberModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="mobNoForm">
                <div class="col-8 mb-2">
                    <label for="phone" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Phone Number</h5>
                        <h5 style="color: #7367f0; font-family: inherit;">+923*****<span id="LastDigitMobNo"></span></h5>
                    </label>
                    <div class="input-group w-100" style="border-top: none;">
                        <div class="input-group" id="divPhone_number">
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" maxlength="6" minlength="6" 
                            pattern="[0-9]*" inputmode="numeric" placeholder="Enter Your Mobile Number Here:" 
                            oninput="validateInput()">
                            <br><small class="form-text text-muted">Please enter the missing number of your mobile number.</small>
                        </div>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border: none;">
                        <button class="btn" type="submit" id="btnMobNoLogin">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End 2nd Modal phoneNumberModal -->


<!-- Begin 3rd Modal passwordModal-->
<div class="modal fade" id="passwordModal" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="passwordForm" action="{{route('front-end.client.login_credentials')}}" method="POST">
                @csrf
                <div class="col-8 mb-2">
                    <label for="password" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Password</h5>
                    </label>
                    <div style="border-top: none;">
                        <input type="hidden" class="form-control" id="cnic_no_login" name="cnic_no_login" maxlength="15" minlength="15" readonly>
                        <input value="" id="loginPassword" type="password" class="form-control" name="password" style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            placeholder="*******" required>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border-top: none;">
                        <button class="btn " type="button" id="btn-password" data-toggle="modal" data-target="">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End 3rd Modal passwordModal-->

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
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- End OTP Modal-->


<!-- Begin New Mob No Modal phoneNumModal -->
<div class="modal fade" id="newMobNoModal" role="dialog" aria-labelledby="newMobNoModal" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" id="closeEnterNumber" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="newMobNoForm">
                <div class="col-8 mb-2">
                    <label for="phone" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Phone Number</h5>
                    </label>
                    <div class="input-group w-100" style="border-top: none;">
                        <div class="input-group" id="divNewPhone_number">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+92</span>
                            </div>
                            <input type="tel" class="form-control" id="new_phone_number" name="new_phone_number" maxlength="10" minlength="10" 
                            placeholder="Enter Your Mobile Number Here:" 
                            oninput="validateInput()" onkeyup="validateMobileNumber(this)">
                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                        </div>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border: none;">
                        <button class="btn" type="submit" id="btnNewPhoneNum">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End New Mob No Modal phoneNumModal -->


<!-- Begin Modal => Register New User-->
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
                <div class="box text-dark">
                    <h4 class="px-5 pb-2" style="color: #7367f0; font-family: inherit;">
                        Enter Your Information</h4>
                    <form  id="m_form_register" class="px-5" method="POST" action="{{route('front-end.storeNewUser')}}">
                        @csrf
                        
                        <!-- First Name -->
                        <div class="form-group">
                            <input type="text" id="firstname" class="form-control error mt-2" name="firstname"
                                placeholder="Enter Your Full Name">
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <input type="text" id="lastname" class="form-control error mt-2" name="lastname"
                                placeholder="Enter Your Father Name" >
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <input type="email" id="email" class="form-control error mt-2" name="email"
                                placeholder="Enter your email" autofocus >
                        </div>

                        <!-- CNIC Number -->
                        <div class="form-group" style="display: none">
                            <input type="text" id="cnic_no_register" class="form-control error mt-2" name="cnic_no_register" minlength="15" maxlength="15"
                                placeholder="Enter your CNIC number" readonly >
                        </div>

                        <!-- Mobile Number -->
                        <div class="form-group" id="div_new_phone_number_register" style="display: none">
                            <div class="input-group w-100" style="border-top: none;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+923</span>
                                    </div>
                                    <input type="tel" class="form-control" id="new_phone_number_register" name="new_phone_number_register" maxlength="9" minlength="9" readonly
                                    placeholder="Enter Your Mobile Number Here:" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                </div>
                            </div>
                        </div>

                        <!-- Membership Roles -->
                        <div class="form-group">
                            <select id="roleId" name="roleId" class="form-control">
                                <option selected disabled>Please Identify Your Self</option>
                                @if (isset($roles) && count($roles) > 0)
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @else
                                    <option disabled>No Role Found.</option>
                                @endif
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control error mt-2" minlength="8" maxlength="8"
                                placeholder="Enter your password" >
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <input type="password" id="confirmPassword" name="confirmPassword" minlength="8" maxlength="8"
                                class="form-control error mt-2" placeholder="Confirm your password">
                        </div>

                        <div>
                            <input type="checkbox" id="showPassword"> Show Password
                        </div>

                        <button type="submit" class="btn btnn w-100 p-2 my-4 loginbutton" id="regsterBtn" style="border: 1px solid #7367f0;">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Begin Modal => Register New User-->

<!-- Begin: Password Rest Modal -->
<div class="modal fade" id="restePasswordModal" tabindex="-1" role="dialog" aria-labelledby="restePasswordModalLabel" aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id=""></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center" id="ResetPasswordForm" action="{{route('front-end.changePassword')}}" method="POST">
                @csrf
                <div class="col-8 mb-2">
                    <label for="restePassword" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your New Password</h5>
                    </label>
                    <div style="border-top: none;">
                        <input type="hidden" class="form-control" id="cnic_no_restePassword" name="cnic_no_restePassword" maxlength="15" minlength="15" readonly>
                        <input value="" id="restePassword" type="password" class="form-control" name="restePassword" autofocus placeholder="*******" required>
                    </div>
                </div>
                <div class="col-8 mb-2">
                    <div class="modal-footer" style="border-top: none;">
                        <button class="btn " type="submit" id="btnResetPassword" data-toggle="modal" data-target="">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End: Password Reset Modal -->







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
    function validateInput() {
        // Get the input element
        var inputElement = document.getElementById('phone_number');

        // Remove non-digit characters using a regular expression
        var sanitizedValue = inputElement.value.replace(/\D/g, '');

        // Update the input value with only digits
        inputElement.value = sanitizedValue;
    }
    $(document).ready(function () {
        var generatedOtp = '';
        var newUser = '';
        var forgotPassword = '';
        // Begin: To resend the OTP
        $("#btnOtpResend").click(function(e){
                e.preventDefault();
                generatedOtp = Math.floor(100000 + Math.random() * 900000);
                toastr.success('OTP Code: ' + generatedOtp);
                return;
            });
        // End: To resend the OTP

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
        
        // Format firstCnic_no on input
        $('#firstCnic_no').on('input', function() {
            formatField($(this));
        });
        // End:   Function to format CNIC dynamically (323226161887 => 32322-616188-7)


        // Click on btnCnicNext Modal 
        $("#btnCnicNext").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertCnicModal").remove();
            let firstCnic_no = $("#firstCnic_no").val();
            if(firstCnic_no.trim() === '' || firstCnic_no == null || firstCnic_no.length == 0){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else if(firstCnic_no.length>0 && firstCnic_no.length != 15){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">Valid CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/users/cnic-details/"+firstCnic_no,
                    success: function (response) {
                        if(response.status == 'error'){
                            $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">This Cnic Doesn\'t exist in our record. Kindly Register Your Account Using Sign Up Button.</div>');
                            $("#firstCnic_no").focus();
                        }
                        else if(response.status == 'success'){
                            $("#cnicModal").modal('hide');
                            $("#phoneNumberModal").modal('show');
                            let userMobNo = response.user.phone_number;
                            let lastThreeDigits = userMobNo.slice(-3);
                            $("#LastDigitMobNo").text(lastThreeDigits);
                            newUser = "False"
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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


        // Click on btnForgotPassowrd  
        $("#btnForgotPassowrd").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertCnicModal").remove();
            let firstCnic_no = $("#firstCnic_no").val();
            if(firstCnic_no.trim() === '' || firstCnic_no == null || firstCnic_no.length == 0){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else if(firstCnic_no.length>0 && firstCnic_no.length != 15){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">Valid CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/users/cnic-details/"+firstCnic_no,
                    success: function (response) {
                        if(response.status == 'error'){
                            $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">This Cnic Doesn\'t exist in our record. Kindly Register Your Account Using Sign Up Button.</div>');
                            $("#firstCnic_no").focus();
                        }
                        else if(response.status == 'success'){
                            $("#cnicModal").modal('hide');
                            $("#phoneNumberModal").modal('show');
                            let userMobNo = response.user.phone_number;
                            let lastThreeDigits = userMobNo.slice(-3);
                            $("#LastDigitMobNo").text(lastThreeDigits);
                            forgotPassword = "True"
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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



        // click on btnMobNoLogin
        $("#btnMobNoLogin").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertphoneNumberModal").remove();
            let phone_number = $("#phone_number").val();
            if(phone_number.trim() === '' || phone_number == null || phone_number.length == 0){
                $("#divPhone_number").after('<div class="alert alert-danger" id="dangerAlertphoneNumberModal">Mobile No Should be provided.</div>');
                $("#phone_number").focus();
                return false;
            }
            else if(phone_number.length>0 && phone_number.length != 6){
                $("#divPhone_number").after('<div class="alert alert-danger" id="dangerAlertphoneNumberModal">Valid Mobile No Should be provided. Total 6 digits will be provided.</div>');
                $("#phone_number").focus();
                return false;
            }
            else{
                let LastDigitMobNo = $("#LastDigitMobNo").text();
                let firstCnic_no = $("#firstCnic_no").val();
                $.ajax({
                    type: "GET",
                    url: "/check-phone_number/"+firstCnic_no+"/+923"+phone_number+LastDigitMobNo,
                    success: function (response) {
                        if(response.status == '0'){
                            $("#divPhone_number").after('<div class="alert alert-danger" id="dangerAlertphoneNumberModal">'+response.message+'</div>');
                            $("#phone_number").focus();
                        }
                        else if(response.status == '-1'){
                            $("#cnicModal").modal('hide');
                            $("#phoneNumberModal").modal('hide');
                            $("#OtpModal").modal('show');
                            if(forgotPassword == "True"){
                                $("#cnic_no_restePassword").val(firstCnic_no)
                                $("#verify_otp").after('<div class="alert alert-info" id="dangerAlertOtpModal">Enter You Missng Digit of Mobile Number</div>');
                            }else{
                                $("#verify_otp").after('<div class="alert alert-info" id="dangerAlertOtpModal">'+response.message+'</div>');
                            }
                            generatedOtp = Math.floor(100000 + Math.random() * 900000);
                            toastr.success('OTP Code: ' + generatedOtp);
                        }
                        else if(response.status == '1'){
                            $("#cnicModal").modal('hide');
                            $("#phoneNumberModal").modal('hide');
                            if(forgotPassword == "True"){
                                $("#cnic_no_restePassword").val(firstCnic_no)
                                $("#verify_otp").after('<div class="alert alert-info" id="dangerAlertOtpModal">Enter You Missng Digit of Mobile Number</div>');
                                $("#OtpModal").modal('show');
                                generatedOtp = Math.floor(100000 + Math.random() * 900000);
                                toastr.success('OTP Code: ' + generatedOtp);
                            }
                            else{
                                $("#passwordModal").modal('show');
                                $("#cnic_no_login").val(firstCnic_no);
                            }
                        }
                        else if(response.status == 'invalid'){
                            Swal.fire({
                                icon: "Warning",
                                title: 'Invalid',
                                text: response.message,
                            });  
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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


        // Begin: To Verify the OTP
        $('#btn-Otp').click(function(e){
            let verify_otp = $("#verify_otp").val();
            $("#dangerAlertOtpModal").remove();
            if(verify_otp != generatedOtp){
                e.preventDefault();
                $("#div_verify_otp").after('<div class="alert alert-danger" id="dangerAlertOtpModal">OTP Password must be matched.</div>');
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
                    let firstCnic_no = $("#firstCnic_no").val();
                    let new_phone_number = $("#new_phone_number").val();
                    $("#cnic_no_register").val(firstCnic_no);
                    $("#new_phone_number_register").val(new_phone_number);
                }
                else if(newUser=="False"){
                    $('#OtpModal').modal('hide');
                    $("#cnicModal").modal('hide');
                    $("#phoneNumberModal").modal('hide');
                    $("#passwordModal").modal('show');
                    let firstCnic_no = $("#firstCnic_no").val();
                    $("#cnic_no_login").val(firstCnic_no);
                }
                else if(forgotPassword == "True"){
                    $('#OtpModal').modal('hide');
                    $("#cnicModal").modal('hide');
                    $("#phoneNumberModal").modal('hide');
                    $("#restePasswordModal").modal('show');
                    let firstCnic_no = $("#firstCnic_no").val();
                    $("#cnic_no_login").val(firstCnic_no);
                }
            }
        });
        // End: To Verify the OTP
        
        
        // click on btn-password
        $("#btn-password").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertPasswordModal").remove();
            let loginPassword = $("#loginPassword").val();
            if(loginPassword.trim() === '' || loginPassword == null || loginPassword.length == 0){
                $("#loginPassword").after('<div class="alert alert-danger" id="dangerAlertPasswordModal">Password Should be provided.</div>');
                $("#loginPassword").focus();
                return false;
            }
            else if(loginPassword.length>0 && loginPassword.length != 8){
                $("#loginPassword").after('<div class="alert alert-danger" id="dangerAlertPasswordModal">Password Length should be of 8 characters.</div>');
                $("#loginPassword").focus();
                return false;
            }
            else{
                // Assuming the form has the ID "passwordForm"
                var passwordForm = $('#passwordForm');

                // Get the form's action (URL) and CSRF token
                var formAction = passwordForm.attr('action');
                var formMethod = passwordForm.attr('method');
                var csrfToken = passwordForm.find('input[name="_token"]').val();

                // Serialize the form data
                var formData = passwordForm.serialize();

                // Append the CSRF token to the serialized form data
                formData += "&_token=" + csrfToken;

                $.ajax({
                    type: formMethod,
                    url: formAction,
                    data: formData,
                    success: function (response) {
                        if(response.status == 'invalidCredentials'){
                            $("#loginPassword").after('<div class="alert alert-danger" id="dangerAlertPasswordModal">'+response.message+'</div>');
                            $("#loginPassword").focus();
                        }
                        else if(response.status == 'invalid'){
                            Swal.fire({
                                icon: "Warning",
                                title: 'Invalid',
                                text: response.message,
                            });  
                        }
                        else if(response.status == 'error'){
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
                        }else if(response.status == 'success'){
                            $('#fristCnicForm')[0].reset();
                            $('#passwordForm')[0].reset();
                            $('#mobNoForm')[0].reset();
                            $("#cnicModal").modal('hide');
                            $("#phoneNumberModal").modal('hide');
                            $("#passwordModal").modal('hide');
                            Swal.fire({
                                icon: response.status,
                                title: 'Success',
                                text: response.message,
                            });
                            window.location.href = response.redirect;
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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



        // 
        // Click on btnRegister 
        $("#btnRegister").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertCnicModal").remove();
            let firstCnic_no = $("#firstCnic_no").val();
            if(firstCnic_no.trim() === '' || firstCnic_no == null || firstCnic_no.length == 0){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else if(firstCnic_no.length>0 && firstCnic_no.length != 15){
                $("#divFirstCnic_no").after('<div class="alert alert-danger" id="dangerAlertCnicModal">Valid CNIC No Should be provided.</div>');
                $("#firstCnic_no").focus();
                return false;
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/users/cnic-unique/"+firstCnic_no,
                    success: function (response) {
                        if(response.status == 1){
                            $("#cnicModal").modal('hide');
                            $("#newMobNoModal").modal('show');
                            newUser = "True"
                        }
                        else if(response.status == 0){
                            $("#divFirstCnic_no").after('<div class="alert alert-info" id="dangerAlertCnicModal">This Cnic exist in our record. Kindly Use the Next Button to Login.</div>');
                            $("#firstCnic_no").focus();
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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
        
        
        
        // btnNewPhoneNum
        $("#btnNewPhoneNum").click(function (e) { 
            e.preventDefault();
            $("#dangerAlertNewMobNoModal").remove();
            let new_phone_number = $("#new_phone_number").val();
            if(new_phone_number.trim() === '' || new_phone_number == null || new_phone_number.length == 0){
                $("#new_phone_number").after('<div class="alert alert-danger" id="dangerAlertNewMobNoModal">Mob No Should be provided.</div>');
                $("#new_phone_number").focus();
                return false;
            }
            else if(new_phone_number.length>0 && new_phone_number.length != 10){
                $("#new_phone_number").after('<div class="alert alert-danger" id="dangerAlertNewMobNoModal">Valid Mob No Should be provided.</div>');
                $("#new_phone_number").focus();
                return false;
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/users/mob-no-unique/+92"+new_phone_number,
                    success: function (response) {
                        if(response.status == 1){
                            $("#cnicModal").modal('hide');
                            $("#newMobNoModal").modal('hide');
                            $("#OtpModal").modal('show');
                            generatedOtp = Math.floor(100000 + Math.random() * 900000);
                            toastr.success('OTP Code: ' + generatedOtp);
                        }
                        else if(response.status == 0){
                            $("#new_phone_number").after('<div class="alert alert-info" id="dangerAlertNewMobNoModal">This Cnic exist in our record. Kindly Use the Next Button to Login.</div>');
                            $("#new_phone_number").focus();
                        }
                        else{
                            Swal.fire({
                                icon: response.status,
                                title: 'Error',
                                text: response.message,
                            });  
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
                        url: '/users/email-unique/' + email,
                        type: 'GET',
                        success: function(response){
                            if (response.status == 0) {
                                $("#email").after('<div class="alert alert-danger" id="emailDangerAlert">'+email+': Email already exists. Kindly use the unique email.</div>');
                                $("#email").val('');
                                $("#email").focus();
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
                else if(email.length == 0){
                    return;
                }
                else{
                    $("#email").after('<div class="alert alert-danger" id="emailDangerAlert">Valid Email Shiuld be provided</div>');
                    $("#email").focus();
                    $("#email").val('');
                }
            });
        // End: Function to verify the unique email


        // Begin:   function to validate form fields
        $("#regsterBtn").click(function(e){
            $(".alert-danger").remove();

            // To check the firstname is empty or not
            let firstname = $("#firstname").val();
            if(firstname.length ==0 || firstname.trim()==='' || firstname ==null){
                e.preventDefault();
                $("#firstname").after('<div class="alert alert-danger">Full Name Should be Provided.</div>');
            }
            
            // To check the lastname is empty or not
            let lastname = $("#lastname").val();
            if(lastname.length ==0 || lastname.trim()==='' || lastname ==null){
                e.preventDefault();
                $("#lastname").after('<div class="alert alert-danger">Father Name Should be Provided.</div>');
            }
            
            // To check the roleId is empty or not
            let roleId = $("#roleId").val();
            if(roleId ==null || roleId.trim()===''){
                e.preventDefault();
                $("#roleId").after('<div class="alert alert-danger">Please Identify Yourself.</div>');
            }
            
            // To check the email is valid or not
            let email = $("#email").val();
            if(!(isValidEmail(email))){
                e.preventDefault();
                $("#email").after('<div class="alert alert-danger">Valid Email Should be Provided.</div>');
            }
            
            // // To check the cnic_no_register is empty or not
            // let cnic_no_register = $("#cnic_no_register").val();
            // console.log(cnic_no);
            // if(cnic_no_register.length!=15){
            //     e.preventDefault();
            //     $("#cnic_no_register").after('<div class="alert alert-danger">Valid CNIC No Should be Provided.</div>');
            // } 
            
            // // To check the new_phone_number_register is empty or not
            // let new_phone_number_register = $("#new_phone_number_register").val();
            // if(new_phone_number_register.length !== 10 || new_phone_number_register[0] !== '3' || !/^\d+$/.test(new_phone_number)){
            // // if(!(validatePhoneNumber(new_phone_number))){
            //     e.preventDefault();
            //     $("#div_new_phone_number_register").after('<div class="alert alert-danger">Mobile Number should be provided and should start with 3 and contain only ten digits..</div>');
            // }

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
            // Assuming the form has the ID "passwordForm"
            var registerForm = $('#m_form_register');

            // Get the form's action (URL) and CSRF token
            var formAction = registerForm.attr('action');
            var formMethod = registerForm.attr('method');
            var csrfToken = registerForm.find('input[name="_token"]').val();

            // Serialize the form data
            var formData = registerForm.serialize();

            // Append the CSRF token to the serialized form data
            formData += "&_token=" + csrfToken;

            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                success: function (response) {
                    $(".alert-danger").remove();
                    if (response.status == 'success') {
                        // If the user is added successfully
                        $("#RegisterModal").modal('hide');
                        $('#m_form_register')[0].reset();
                        $("#OtpModal").modal('hide');
                        $('#otpForm')[0].reset();
                        $("#newMobNoModal").modal('hide');
                        $('#newMobNoForm')[0].reset();
                        $("#cnicModal").modal('hide');
                        $('#fristCnicForm')[0].reset();
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
                            }
                            else if(index=='firstname'){
                                $("#firstname").after('<div class="alert alert-danger">Full Name Field is Required.</div>');
                            } 
                            else if(index=='lastname'){
                                $("#lastname").after('<div class="alert alert-danger">Father Name Field is Required.</div>');
                            }
                            else {
                                $("#" + index).after('<div class="alert alert-danger">'+value+'</div>');
                            }
                        });
                    } 
                    else if (error.hasOwnProperty('message')) {
                        // Display a general error message
                        Swal.fire('Error', error.message, 'error');
                    }
                }
            });
            

        });

        // End: Script for the Register New User Form



        // Begin:   function to validate form ResetPasswordForm
        $("#btnResetPassword").click(function(e){
            $(".alert-danger").remove();

            // To check the restePassword is empty or not
            let restePassword = $("#restePassword").val();
            if(restePassword.length ==0 || restePassword.trim()==='' || restePassword ==null){
                e.preventDefault();
                $("#restePassword").after('<div class="alert alert-danger">New Password Should be Provided.</div>');
            }
            else if(restePassword.length >0 && restePassword.length !=8){
                e.preventDefault();
                $("#restePassword").after('<div class="alert alert-danger">New Password Length Should be of 8 characters.</div>');
            }
            
            
        });
        // End:   function to validate form ResetPasswordForm


         // Submit the form  ResetPasswordForm using Ajax
         $('#ResetPasswordForm').submit(function (e) {
            e.preventDefault();
            // Assuming the form has the ID "passwordForm"
            var newPasswordForm = $('#ResetPasswordForm');

            // Get the form's action (URL) and CSRF token
            var formAction = newPasswordForm.attr('action');
            var formMethod = newPasswordForm.attr('method');

            // Serialize the form data
            var formData = newPasswordForm.serialize();




            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                success: function (response) {
                    $(".alert-danger").remove();
                    if (response.status == 'success') {
                        // If the user is added successfully
                        $("#RegisterModal").modal('hide');
                        $('#m_form_register')[0].reset();
                        $("#OtpModal").modal('hide');
                        $('#otpForm')[0].reset();
                        $("#newMobNoModal").modal('hide');
                        $('#newMobNoForm')[0].reset();
                        $("#cnicModal").modal('hide');
                        $('#fristCnicForm')[0].reset();
                        $("#restePasswordModal").modal('hide');
                        $('#ResetPasswordForm')[0].reset();
                        $("#phoneNumberModal").modal('hide');
                        $('#mobNoForm')[0].reset();
                        Swal.fire('Success', response.message, 'success');
                        forgotPassword = '';
                    }
                    else if( response.status == 'invalid'){
                        Swal.fire('Invalid', response.message, 'warning');
                    }
                    else if( response.status == 'validationError'){
                        $("#restePassword").after('<div class="alert alert-danger">New Password Length Should be of 8 characters.</div>');
                        $("#restePassword").focus();
                    }
                    else {
                        Swal.fire('Error', response.message, 'error');
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
            

        });
        // End: Script for the ResetPasswordForm New User Form





    });

</script>