<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
      @if (session()->has('success'))
      <div style="left: 50%;
          transform: translateX(-50%); z-index: 100 !important; position: absolute;" class="w-50 top-0 z-30 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if (session()->has('loginError'))

      <div style="left: 50%;
        transform: translateX(-50%); z-index: 100 !important; position: absolute;" class="w-50 top-0 z-30 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

		<div class="container-login100" style="background-image: url('/img/img.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="/login" method="post">
					<span class="login100-form-logo">
            		<img src="/img/logo.png" style="width: 100px; height: 100px; padding: 15px;">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
            @csrf
            <!-- Email -->
            <div class="wrap-input100 validate-input" data-validate = "Enter Email">
              <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" id="email" autofocus required value="{{ old('email') }}" placeholder="Email">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <!-- password -->
            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100" type="password" required placeholder="Password" required name="password" id="password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <!-- cb remember me -->
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="remember" type="checkbox" name="remember">
              <label class="label-checkbox100" for="remember">
                Remember me
              </label>
            </div>

            <!-- btn login -->
            <div class="container-login100-form-btn">
              <button class="btn login100-form-btn" type="submit" name="submit">
                Login
              </button>
            </div>

					<div class="text-center p-t-90">
            <p class="text-center text-white" style="font-size: 12px;">Belum memiliki akun? 
              <a href="/register" style="text-decoration: none; font-weight: bold;">REGISTER</a>
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