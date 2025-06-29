
<!DOCTYPE html>
<html lang="en">
<head>
    @include('BackEnd.includes.links')
    <style>
        .login-page{
            background-color: #d0d2e7;
        }
        .card-design{
          margin-left: 37%;
          margin-top: 5rem;
          margin-bottom: 15rem;
        }
    </style>
</head>
<body>
	<div class="main-wrapper ">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center login-page">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-5 col-xl-5 card-design">
						<div class="card">
							<div class="row">
                {{-- <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper" style="background-image:url({{ asset('backend/images/others/login-bg.jpg') }})">

                  </div>
                </div> --}}
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error')}}
                </div>
                @endif
                <div class="col-md-2"></div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper pl-3 py-4">
                    <a href="#" class="noble-ui-logo d-block mb-2 text-center">Bridal<span><b>Harmony</b></span></a>
                    <h5 class="text-muted fw-normal mb-4 text-center">Admin Login</h5>
                    <h5 style="text-align: center; color:red;">{{ Session::get('login_error') }}</h5>
                    <h5 style="text-align: center; color:red;">{{ Session::get('status') }}</h5>
                    <form  action="{{route('admin.login.submit')}}" class="forms-sample" method="POST" id="authentication">
                      @csrf
                      <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Email">
                          @error('email')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror "  placeholder="Password">
                          @error('password')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>

                        {{-- <a href="" class="col-md-3 btn btn-primary ">Login</a> --}}
                        <button type="submit" class="btn btn-primary w-100  text-white">
                          Login 
                        </button>

                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>