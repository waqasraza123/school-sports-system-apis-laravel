@extends('layouts.master', ['currentSchool', $currentSchool])

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

	<h1>Add Users</h1>
	<form class="form-horizontal" role="form" method="POST" action="/auth/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<input type="text" required class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
			<i class="fa fa-user"></i>
		</div>

		<div class="form-group">
			<input type="email" required class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
			<i class="fa fa-envelope-square"></i>
		</div>

		{{--<div class="form-group">
			<select  class="selectpicker form-control" name="school-id" required>
				<option selected disabled>Select School</option>
				@if($schools)
					@foreach($schools as $school)
						<option value="{{$school->id}}">{{$school->name}}, {{$school->city}}</option>
					@endforeach
				@else
					<option>No, school added yet.</option>
				@endif
			</select>
		</div>--}}

		<div class="form-group">
			<input type="password" class="form-control" name="password" required placeholder="Password">
		</div>

		<div class="form-group">
			<input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
		</div>

		<div class="form-group">
			<button type="submit" class="log-btn">
				Register
			</button>
		</div>
	</form>
</div>
@endsection
@section('footer')
	<script src="{{asset('auth-scripts-styles/js.js')}}"></script>
	@include('partials.error-messages.footer-script')

@endsection
