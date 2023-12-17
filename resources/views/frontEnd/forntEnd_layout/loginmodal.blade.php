<button class="btn btnn" data-toggle="modal" data-target="#phoneNumModal">login</button>

<!-- BEGIN FIRST MODAL -->
<div class="modal fade" id="phoneNumModal" tabindex="-1" role="dialog" aria-labelledby="phoneNumModalLabel"
    aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id="phoneNumModal"></h1>
                <button type="button" class="close" id="closeEnterNumber" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{-- <button type="button" class="btn btn-danger" data-dismiss="fmodal">
<i class="fas fa-times"></i> Close
</button> --}}
            </div>
            <form class="row g-3 d-flex justify-content-center">
                <div class="col-8">
                    <label for="phone" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your Phone
                            Number</h5>
                    </label>
                    <div class="input-group w-100" style="border-top: none;">
                        <span class="input-group-text bg-light" id="phone"
                            style="height: 55px !important;">+92</span>
                        <input id="phone_number" type="phone" class="form-control"
                            aria-describedby="inputGroupPrepend2"
                            style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            placeholder="3068142339" required>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="border: none;">
                <button class="btn " id="btn-phoneNum" data-toggle="modal" data-target="#passwordModal">Login</button>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN FIRST MODAL-->
<!-- BEGIN SECOND MODAL-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
    aria-hidden="true" style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id="FirstModal1"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center">
                <div class="col-8">
                    <label for="password" class="form-label">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter Your
                            Password</h5>
                    </label>
                    <div style="border-top: none;">
                        <input value="" id="password" type="password" class="form-control" name="password"
                            style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            placeholder="*******" required>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="border-top: none;">
                <button class="btn " id="btn-password" data-toggle="modal" data-target="#">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN SECOND MODAL-->
<!-- BEGIN THIRD MODAL-->
<div class="modal fade" id="OtpModal" tabindex="-1" role="dialog" aria-labelledby="OtpModalLabel" aria-hidden="true"
    style="height: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border: none;">
                <h1 class="modal-title fs-5" id="OtpModal"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="row g-3 d-flex justify-content-center">
                <div class="col-8">
                    <label for="otp" class="form-label text-dark">
                        <h5 style="color: #7367f0; font-family: inherit;">Enter OTP code
                        </h5>
                    </label>
                    <div class="input-group w-100">
                        <input id="verify-otp" type="text" class="form-control"
                            style="border: none !important; border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            placeholder="******" required>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="border-top: none;">
                <button class="btn " id="btn-Otp" data-toggle="modal" data-target="#RegisterModal">Verify
                    OTP</button>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN THIRD MODAL-->
<!-- BEGIN FOURTH MODAL-->
<div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalLabel"
    aria-hidden="true" style="height:auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #7367f0;">
            <div class="modal-header" style="border-bottom: none;">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel3"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="back">
                <div class="box text-dark">
                    <h4 class="px-5 pb-2" style="color: #7367f0; font-family: inherit;">
                        Enter Your Information</h4>
                    <form method="POST" id="m_form_register" class="px-5">
                        <input type="email" id="email" class="form-control error mt-4"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            name="email" placeholder="Email">
                        <input type="text" id="firstname" class="form-control error mt-4"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            name="firstname" placeholder="First Name" required>
                        <input type="text" id="lastname" class="form-control error mt-4"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            name="lastname" placeholder="Last Name" required>
                        <input type="text" id="cnic_no" class="form-control error mt-4"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;"
                            name="cnic_no" placeholder="Cnic" required>
                        <input type="password" name="password" id="password" class="form-control error mt-4" id="myInput"
                            placeholder="Password"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                            <input type="password" id="confirm-password" name="confirm-password" class="form-control error mt-4" id="myInput"
                            placeholder="confirm-Password"
                            style="border-radius: 0px !important; height: 55px !important; background-color: #eeeeee !important;">
                        <div style="margin-top: 3px !important; padding-top: 0px !important;">
                            <input type="checkbox" onclick="myFunction()"> Show Password
                        </div>
                       
                        <button type="submit" class="btn btnn w-100 p-2 my-4 loginbutton"
                            style="border: 1px solid #7367f0;">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN FOURTH MODAL-->