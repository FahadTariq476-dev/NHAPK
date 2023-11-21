<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .eye-icon {
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>Login Form</h2>
        <form action="{{route('admin.login.post')}}" method="POST" onsubmit="return confirmSubmit()">
            @csrf
          <div class="form-group">
            <label for="username">Username</label>
            <input type="eamil" class="form-control" id="username" name="username" placeholder="Enter username" required/>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required/>
              {{-- <small class="form-text text-muted">Password should be of 8 characters</small> --}}
              <div class="input-group-append">
                <span class="input-group-text eye-icon" id="showPassword">
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
          </div>
          <div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        </div>
  </div>
  </div>
  <script>
    function confirmSubmit(){
        function validateAndFoucs(element, errorMessage){
            var value = element.value.trim();
            if(value ===""){
                alert(errorMessage);
                element.focus();
                return false;
            }
            else{
                return true;
            }
        }
        if(!validateAndFoucs(document.getElementById("username"), "User Name must be provided") ||
        !validateAndFoucs(document.getElementById("password"), "Password must be provided")){
            return false;
        }
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Toggle password visibility
      $("#showPassword").click(function() {
        var passwordInput = $("#password");
        var icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
          passwordInput.attr("type", "text");
          icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
          passwordInput.attr("type", "password");
          icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
      });
    });
  </script>
</body>
</html>