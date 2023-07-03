<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
	<!--  All snippets are MIT license http://bootdey.com/license -->
	<title>update my profile - Bootdey.com</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
		integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Page title -->
				<div class="my-5">
					<h3>My Profile</h3>
					<hr>
				</div>
				<!-- Form START -->
				<form class="file-upload">
					<div class="row mb-5 gx-5">
						<!-- Contact detail -->
						@foreach($admins as $key=>$admin)
						<div class="col-xxl-8 mb-5 mb-xxl-0">
							<div class="bg-secondary-soft px-4 py-5 rounded">
								<div class="row g-3">
									<h4 class="mb-4 mt-0">Contact detail</h4>
									<!-- First Name -->
									<div class="col-md-6">
										<label class="form-label">Name:</label>
										<p>{{ $admin->name_admin }}</p>
									</div>
									<!-- Last name -->
									<div class="col-md-6">
										<label class="form-label">Phone number *</label>
										<p>{{ $admin->phone }}</p>
									</div>
									<!-- Email -->
									<div class="col-md-6">
										<label for="inputEmail4" class="form-label">Email *</label>
										<p>{{ $admin->email }}</p>
									</div>
									<!-- Address -->
									<div class="col-md-6">
										<label class="form-label">Address *</label>
										<p>{{ $admin->address }}</p>
									</div>
								</div> <!-- Row END -->
							</div>
						</div>
						<!-- Upload profile -->
						<div class="col-xxl-4">
							<div class="bg-secondary-soft px-4 py-5 rounded">
								<div class="row g-3">
									<h4 class="mb-4 mt-0">Your profile photo</h4>
									<div class="text-center">
										<!-- Image upload -->
										<div class="square position-relative display-2 mb-3" style="width: 300px">
											<img src="{{ asset('/storage/'.$admin->avatar) }}"
												style="width: 297px;height: 246px;">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Row END -->

					<!-- Social media detail -->
					<div class="row mb-5 gx-5">
						{{-- <div class="col-xxl-6 mb-5 mb-xxl-0">
							<div class="bg-secondary-soft px-4 py-5 rounded">
								<div class="row g-3">
									<h4 class="mb-4 mt-0">Social media detail</h4>
									<!-- Facebook -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fab fa-fw fa-facebook me-2 text-facebook"></i>Facebook *</label>
										<input type="text" class="form-control" placeholder="" aria-label="Facebook"
											value="http://www.facebook.com">
									</div>
									<!-- Twitter -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fab fa-fw fa-twitter text-twitter me-2"></i>Twitter *</label>
										<input type="text" class="form-control" placeholder="" aria-label="Twitter"
											value="http://www.twitter.com">
									</div>
									<!-- Linkedin -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fab fa-fw fa-linkedin-in text-linkedin me-2"></i>Linkedin
											*</label>
										<input type="text" class="form-control" placeholder="" aria-label="Linkedin"
											value="http://www.linkedin.com">
									</div>
									<!-- Instragram -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fab fa-fw fa-instagram text-instagram me-2"></i>Instagram
											*</label>
										<input type="text" class="form-control" placeholder="" aria-label="Instragram"
											value="http://www.instragram.com">
									</div>
									<!-- Dribble -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fas fa-fw fa-basketball-ball text-dribbble me-2"></i>Dribble
											*</label>
										<input type="text" class="form-control" placeholder="" aria-label="Dribble"
											value="http://www.dribble.com">
									</div>
									<!-- Pinterest -->
									<div class="col-md-6">
										<label class="form-label"><i
												class="fab fa-fw fa-pinterest text-pinterest"></i>Pinterest *</label>
										<input type="text" class="form-control" placeholder="" aria-label="Pinterest"
											value="http://www.pinterest.com">
									</div>
								</div> <!-- Row END -->
							</div>
						</div> --}}
						<!-- button -->
						<div class="gap-3 d-md-flex justify-content-md-end text-center">
							<form action="{{ route('ad.destroyp',['id'=>$admin->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger btn-lg">Delete profile</button>
							</form>
							<a href="{{ route('ad.profiledit',['id'=>$admin->id]) }}"
								class="btn btn-primary btn-lg">Update profile</a>
							<a href="{{ route('ad.detail') }}" class="btn btn-primary btn-lg">Return</a>
							<a href="{{ route('ad.changePassword') }}" class="btn btn-primary btn-lg">Change
								Password</a>
							@endforeach
				</form> <!-- Form END -->
			</div>
		</div>
	</div>

	<style type="text/css">
		body {
			margin-top: 20px;
			color: #9b9ca1;
		}

		.bg-secondary-soft {
			background-color: rgba(208, 212, 217, 0.1) !important;
		}

		.rounded {
			border-radius: 5px !important;
		}

		.py-5 {
			padding-top: 3rem !important;
			padding-bottom: 3rem !important;
		}

		.px-4 {
			padding-right: 1.5rem !important;
			padding-left: 1.5rem !important;
		}

		.file-upload .square {
			height: 250px;
			width: 250px;
			margin: auto;
			vertical-align: middle;
			border: 1px solid #e5dfe4;
			background-color: #fff;
			border-radius: 5px;
		}

		.text-secondary {
			--bs-text-opacity: 1;
			color: rgba(208, 212, 217, 0.5) !important;
		}

		.btn-success-soft {
			color: #28a745;
			background-color: rgba(40, 167, 69, 0.1);
		}

		.btn-danger-soft {
			color: #dc3545;
			background-color: rgba(220, 53, 69, 0.1);
		}

		.form-control {
			display: block;
			width: 100%;
			padding: 0.5rem 1rem;
			font-size: 0.9375rem;
			font-weight: 400;
			line-height: 1.6;
			color: #29292e;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #e5dfe4;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			border-radius: 5px;
			-webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		}
	</style>

	<script type="text/javascript">

	</script>
</body>

</html>