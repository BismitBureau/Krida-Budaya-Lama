@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<link href="{{ url('style/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ url('javascript/dropzone.js') }}"></script>

@section('content')
<section class="content-header">
    <h1>
        Slider
        <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active"><a href="#">Slider</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Add slide</h3>
        </div>
        <div class="box-body">
            <p> silahkan drag dan drop gambar slider yang ingin dimasukkan </p>
			<form action="{{ url('admin/upload_slide')}}" class="dropzone" id="my-awesome-dropzone"></form>
			<a href="{{ url('admin/slider') }}" class="btn btn-default"> Click here to refresh </a>
        </div>
    </div>
	<div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Delete slide</h3>
        </div>
        <div class="box-body">
		<form action="delete_slide" method="post">
		  	@for($j=0; $j < count($data["slides"]);)
		  	<div class="row">
		  		@for($cnt = 0; $cnt < 3 && $j < count($data["slides"]); $cnt++, $j++)
		  		<div class="col-md-4">
			  		<div class="box box-info" style="height: 300px;">
				        <div class="box-header">
				            <i class="fa fa-picture-o"></i>
				            <h3 class="box-title"> Slide {{ $j+1 }}</h3>
				        </div>
				        <div class="box-body">
				        	<img src="{{ url($data['slides'][$j]['imageURL']) }}" class="img-responsive" style="height: 200px;width: 100%;";>
				        </div>
				        <div class="box-footer">
				        	<input type="checkbox" name="delete_list[]" value="{{ $data['slides'][$j]['id'] }}">
				             Tandai untuk delete slide
				        </div>
				    </div>
				</div>
				@endfor
			</div>
			@endfor
			<div class="row">
				<div class="col-md-12">
					<input type="submit" class="btn btn-danger btn-lg" name="delete slide(s)" value="Click here to delete selected slide(s)" style="width: 100%;"/>
				</div>
			</div>
		</form>
		</div>
    </div>

</section>

@endsection
