@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        About Us
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active"><a href="#"> About Us</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
		<form role="form" method="post" action="{{ url('admin/update_about') }}">
        <div class="box-body">
			<div class="form-group">
	            <label>About (Indonesia) </label>
	            <textarea class="form-control" name="id" rows="10" placeholder="Enter ...">{{$about['aboutid']}}</textarea>
	        </div>      
			<div class="form-group">
	            <label>About (English) </label>
	            <textarea class="form-control" name="en" rows="10" placeholder="Enter ...">{{$about['abouten']}}</textarea>
	        </div>    	
        </div>
        <div class="box-footer">
        	<button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

</section>
@endsection