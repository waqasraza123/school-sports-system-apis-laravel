@extends('app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('auth-scripts-styles/css.css')}}">

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="login-form">

	<h1>Login</h1>

	<form class="form-horizontal" role="form" method="POST" action="/auth/login">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<input type="email" required id="UserName" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
			<i class="fa fa-user"></i>
		</div>

		<div class="form-group">
			<input type="password" required id="Passwod" class="form-control" name="password" placeholder="Password">
			<i class="fa fa-lock"></i>
		</div>

		<div class="form-group">
			<div class="">
				<div class="checkbox pull-right">
					<label>
						<input type="checkbox" name="remember"> Remember Me
					</label>
				</div>
				<a class="link pull-left" href="/password/email">Forgot Your Password?</a>
			</div>
		</div>
		<span class="alert"></span>
		<div class="form-group">
			<button type="submit" class="log-btn">
				Login
			</button>
		</div>
	</form>
</div>
@endsection
@section('footer')
<script src="{{asset('auth-scripts-styles/js.js')}}"></script>
@endsection
