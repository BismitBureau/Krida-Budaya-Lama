@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        Image
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active">Edit Image</li>
    </ol>
</section>
<section class="content">

	<div class="box box-solid">
		<div class="box-header">
			<h4 class="box-title"> Images </h4>
		</div>
		<div class="box-body">
			<img src="{{ url($image['imageURL']) }}" class="img-responsive">
		</div>
	</div>
	<div class="box box-solid">
		<div class="box-header">
			<h3 class="box-title"> Description editor </h3>
		</div>
		<form method="post" action="{{ url('admin/update_image/'.$image['id']) }}">
			<div class="box-body">
	            <div class="form-group">
                    <label> Description (Indonesia) </label>
                    <textarea class="form-control" name="descriptionid" rows="5" placeholder="Enter ...">{{$image['descriptionid']}}</textarea>
                </div>

	            <div class="form-group">
                    <label> Description (English) </label>
                    <textarea class="form-control" name="descriptionen" rows="5" placeholder="Enter ...">{{$image['descriptionen']}}</textarea>
                </div>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-info" value="save">
			</div>
		</form>
	</div>

</section>

@endsection