@extends('layout.admin')

@section('content')
	@if(isset($successMessage))
		<div class="alert alert-success">
		  <strong>Request Success!</strong> Password changed!
		</div>
	@endif
	@if(isset($failMessage))
		<div class="alert alert-danger">
		  <strong>Request Failed!</strong> {{ $failMessage }}
		</div>
	@endif
	<form method="post" action="update_password">
		Current Password : 
		<input type="password" name="curpass">
		New Password :
		<input type="password" name="newpass">
		Confirm New Password :
		<input type="password" name="confirmpass">
		<input type="submit" value="Save Password"> </input>
	</form>
@endsection