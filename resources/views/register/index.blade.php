<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="/img/logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/img/img.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="/register" method="post">
					<span class="login100-form-logo">
            		<img src="/img/logo.png" style="width: 100px; height: 100px; padding: 15px;">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
            Register
					</span>
            @csrf
            <!-- Nama -->
            <div class="wrap-input100 validate-input" data-validate = "Enter Email">
              <input type="text" class="input100 @error('name') is-invalid @enderror" name="name" required value="{{ old('name') }}" placeholder="Name">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Username -->
            <div class="wrap-input100 validate-input" data-validate = "Enter Email">
              <input class="input100 @error('username') is-invalid @enderror" name="username" id="username" autofocus required value="{{ old('username') }}" placeholder="Username">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
              @error('username') <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- Email -->
            <div class="wrap-input100 validate-input" data-validate = "Enter Email">
              <input type="text" class="input100 @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email') }}" placeholder="Email">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
              @error('email') <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- password -->
            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" required placeholder="Password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
              @error('password')<div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- btn Register -->
            <div class="container-login100-form-btn">
              <button type="submit" class="btn login100-form-btn" name="register">Register</button>
            </div>

					<div class="text-center p-t-30">
            <p class="text-center text-white" style="font-size: 12px;">Belum memiliki akun? 
              <a href="/login" style="text-decoration: none; font-weight: bold;">Login</a>
            </p>
            
            <div class="card-footer text-center text-white">
              <small>&copy; MovTix</small>
            </div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

  <script>
    $(document).ready(function() {
      $(document).on('click', '.btn-close', function() {
        $('.alert').remove()
      });
    });
  </script>
	
<!--===============================================================================================-->
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/daterangepicker/moment.min.js"></script>
	<script src="/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>

</body>
</html>