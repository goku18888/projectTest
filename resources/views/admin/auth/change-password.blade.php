<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</head>

<body>
  <!-- Section: Design Block -->
  <section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
      <div class="card-body py-5 px-md-5">

        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Sign up now</h2>
            <form method="post" action="{{ route('reset-password') }}" autocomplete="off">
                @if (session()->has("success"))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ session()->get('success') }}
                            </div>
                        @elseif (session()->has("failed"))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ session()->get('failed') }}
                            </div>
                        @endif
              @csrf
              @method('PUT')
              <input type="hidden" name="email" value="{{ $email }}"/>
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form3Example5" class="form-control {{$errors->first('pass_word') ? 'is-invalid' : ''}}" name="pass_word" value="{{ old('pass_word') }}" placeholder="Your Password">
                {!! $errors->first('pass_word', '<div class="invalid-feedback">:message</div>') !!}
                <label class="form-label" for="form3Example5">Password</label>
              </div>
              <!-- Reset Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form3Example5" class="form-control {{$errors->first('confirm_password') ? 'is-invalid' : ''}}" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password">
                {!! $errors->first('confirm_password', '<div class="invalid-feedback">:message</div>') !!}
                <label class="form-label" for="form3Example5">Confirm password</label>
              </div>

              <!-- Avartar input -->
              <!-- Checkbox -->
              {{-- <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                <label class="form-check-label" for="form2Example33">
                  Subscribe to our newsletter
                </label>
              </div> --}}
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Change Password
              </button>
              <!-- Register buttons -->
              <button class="btn btn-primary btn-block mb-4"><a href={{ route('Register' ) }}>Register</a></button>

              {{-- <!-- Register buttons -->
              <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button> --}}
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
</body>

</html>