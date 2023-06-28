<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><a href="{{ route('us.QuesTion') }}"><i class="fa-solid fa-lock"></i></a></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fa-brands fa-square-github"></i></span>
				</div>
			</div>
			<div class="card-body">
						@if (session()->has("success"))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ session()->get('success') }}
                            </div>
						@elseif (session()->has("chuadangnhap"))
							<div class="alert alert-danger alert-dismissible fade show">
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								{{ session()->get('chuadangnhap') }}
							</div>
                        @endif
				<form method="POST" action="{{ route('us.userPrLogin') }}">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="name_customer">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="pass_word">
					</div>
					{{-- <div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div> --}}
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
					<div class="form-group">
						<a href="{{ route('us.index') }}" type="button" value="Back" class="btn float-right login_btn">Back</a>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="{{ route('us.userRegister') }}">Register</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="{{ route('us.forgotPassword') }}">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>