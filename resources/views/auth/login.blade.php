@extends('layouts.auth')

@section('page-title', 'Login')

@section('content')
<style>
		
	html {
		background-image: url("{{ asset('img/cover1.jpg') }}");
		background-size: cover;
	}

</style>

<div class="col-lg-6 col-md-12">
<div class="card card-signup" style="margin-left: 50%;margin-top: 15%;">
	<div class="header header-primary text-center"> <h4>{{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</h4></div>
		<div class="card-body">
			@isset($url)
			
			<form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
			
			@endisset
				@csrf
		
		<p class="text-divider">Please provide your email and password</p>
		<div class="content">
			</br>
			@if (session('success'))
					<div class="alert alert-success text-justify" role="alert">
						{{session('success')}}
					</div>
			@elseif (session('error'))
				<div class="alert alert-danger text-justify" role="alert">
					{{session('error')}}
				</div>
			@endif
			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">email</i>
				</span>
				<input id="email" type="email" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			</br>
			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">lock_outline</i>
				</span>
				<input id="password" type="password" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			</br><!--
			<div class="checkbox">
				<label>
				<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
					{{ __('Remember Me') }}
				</label>
			</div> -->
		</div>
			<div class="footer text-center">
				<button type="submit" class="btn btn-primary btn-round">{{ __('Login') }}</button>
				<hr>
				<a href="{{ url('/') }}" class="btn btn-info btn-simple">Home</a>
				<a href="/register/{{$url}}" class="btn btn-info btn-simple">{{ __('Register') }}</a>
				@if (Route::has('password.request'))
					<a class="btn btn-info btn-simple" href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				@endif
			</div>
			</form>
			
		</div>
	</div>		
</div></div>

@endsection

