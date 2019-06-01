@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        People
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{url('admin/peoples')}}"> People</a></li>
        <li class="active"><a href="#">Edit</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
		<form role="form" method="post" action="{{ url('admin/update_people/'.$people['id']) }}" >
        <div class="box-body">
				<img src="{{ url($people['photoURL']) }}" width="25%">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter ..." value="{{$people['name']}}" required>
                </div>
                <div class="form-group">
                    <label>Subname</label>
                    <input type="text" name="subname" class="form-control" placeholder="Enter ..." value="{{$people['subname']}}" required>
                </div>
                <div class="form-group">
                    <label>Description (Indonesia)</label>
                    <textarea class="form-control" name="contentid" rows="5" placeholder="Enter ...">{{ $people['contentid'] }}</textarea>
                </div>
                <div class="form-group">
                    <label>Description (English)</label>
                    <textarea class="form-control" name="contenten" rows="5" placeholder="Enter ...">{{ $people['contenten'] }}</textarea>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-twitter-square"></i></span>
                    <input type="text" name="twitterURL" class="form-control" placeholder="Twitter" value="{{ $people['twitterURL'] }}">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-facebook-square"></i></span>
                    <input type="text" name="facebookURL" class="form-control" placeholder="Facebook" value="{{ $people['facebookURL'] }}">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                    <input type="text" name="instagramURL" class="form-control" placeholder="Instagram" value="{{ $people['instagramURL'] }}">
                </div>
        </div>
        <div class="box-footer">
        	<button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

</section>
@endsection