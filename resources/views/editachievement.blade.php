@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        Achievement
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{url('admin/achievements')}}"> Achievements</a></li>
        <li class="active"><a href="#">Edit</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
		<form role="form" method="post" action="{{ url('admin/update_achievement/'.$achievement['id']) }}">
        <div class="box-body">
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" name="year" class="form-control" placeholder="Enter ..." value="{{$achievement['year']}}" required>
                </div>
                <div class="form-group">
                    <label>Content English</label>
                    <input type="text" name="stringen" class="form-control" placeholder="Enter ..." value="{{$achievement['stringen']}}" required>
                </div>
                <div class="form-group">
                    <label>Content Indonesia</label>
                    <input type="text" name="stringid" class="form-control" placeholder="Enter ..." value="{{$achievement['stringid']}}" required>
                </div>
        </div>
        <div class="box-footer">
        	<button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

</section>
@endsection