<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    {{-- <title>Contact Us Form</title> --}}
    <!-- Title  -->
    <title>NHA Pakistan | National Hostel Association of Pakistan</title>

    <!-- Favicon  -->
    <link rel="icon" href="/assets/img/NHAPK.JPEG">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contact-form {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
</body>

</html>
