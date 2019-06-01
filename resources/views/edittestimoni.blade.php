@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        Testimonial Box
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{url('admin/testimonial')}}"> Testimonial Box</a></li>
        <li class="active"><a href="#">Edit</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
		<form role="form" method="post" action="{{ url('admin/update_testimoni/'.$testimoni['id']) }}">
        <div class="box-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter ..." value="{{ $testimoni['name'] }}" required>
                </div>
                <div class="form-group">
                    <label>Content English</label>
                    <input type="text" name="contenten" class="form-control" placeholder="Enter ..." value="{{ $testimoni['contenten'] }}" required>
                </div>
                <div class="form-group">
                    <label>Content Indonesia</label>
                    <input type="text" name="contentid" class="form-control" placeholder="Enter ..." value="{{ $testimoni['contentid'] }}" required>
                </div>
        </div>
        <div class="box-footer">
        	<button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

</section>
@endsection