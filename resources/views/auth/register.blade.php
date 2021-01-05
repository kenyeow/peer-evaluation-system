@extends('layouts.auth')

@section('page-title', 'Register a new account')

@section('content')

<style>
		
	html {
		background-image: url("{{ asset('img/cover1.jpg') }}");
		background-size: cover;
	}

</style>

<div class="col-lg-6 col-md-12">
<div class="card card-signup" style="margin-left: 50%;margin-top: 5%;">
	<div class="header header-primary text-center"> <h4>{{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</h4></div>

	<div class="card-body">
		@isset($url)
		<form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
		
		@endisset
			@csrf
		
		<p class="text-divider">Please fill the form bellow</p>
		<div class="content">

			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">face</i>
					</span>
					<input id="name" type="text" placeholder="Name..." class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">email</i>
					</span>
					<input id="email" type="email" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock_outline</i>
					</span>
					<input id="password" type="password" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock_outline</i>
					</span>
					<input id="password-confirm" type="password" placeholder="Repeat Password..." class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>
			</div>

		</div>
			<div class="footer text-center">
				<button type="submit" class="btn btn-primary btn-round">{{ __('Register') }}</button>
				<hr>
				<a href="{{ url('/') }}" class="btn btn-info btn-simple">Home</a>
				Already have an account? <a href="/login/{{$url}}" class="btn btn-info btn-simple">{{ __('Login') }}</a>
			</div>
		</form>
	</div>
</div>
</div>


@endsection('content')
