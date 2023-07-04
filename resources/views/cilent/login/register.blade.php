<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
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
				<h3>Register</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				@if (session()->has("qq"))
					<div class="alert alert-danger">
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						{{ session()->get('qq') }}
					</div>
   				@endif
				<form method="POST" action="{{ route('us.ProRegister') }}" enctype="multipart/form-data">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="name_customer">
                            @error('name_customer')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="pass_word">
						@error('pass_word')
						<span style="color:red;">{{$message}}</span>
						@enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa-solid fa-at"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="email" name="email">
						@error('email')
						<span style="color:red;">{{$message}}</span>
						@enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
						</div>
						<input type="number" class="form-control" placeholder="phone" name="phone">
						@error('phone')
						<span style="color:red;">{{$message}}</span>
						@enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa-solid fa-address-book"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="address" name="address">
						@error('address')
						<span style="color:red;">{{$message}}</span>
						@enderror
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa-solid fa-image"></i></span>
						</div>
						<input type="file" class="form-control" placeholder="avatar" name="img_customer">
						@error('img_customer')
						<span style="color:red;">{{$message}}</span>
						@enderror
					</div>
					{{-- <div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div> --}}
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
					<div class="form-group">
						<a href="{{ route('us.index') }}" type="button" value="Back" class="btn float-right login_btn">Back</a>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					You already have an account?<a href="{{ route('us.userLogin') }}">Sign In</a>
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