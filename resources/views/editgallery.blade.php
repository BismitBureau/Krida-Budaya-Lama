@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>

@section('content')
<section class="content-header">
    <h1>
        Album
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li><a href="{{ url('admin/galleries') }} ">Gallery</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">

	<div class="box box-solid">
		<div class="box-header">
			<h4 class="box-title"> Upload image(s) </h4>
		</div>
		<div class="box-body">
			<form action="{{ url('admin/upload_image/gallery/'.$gallery['id']) }}" class="dropzone" id="my-awesome-dropzone">
			</form>
		</div>
		<div class="box-footer">
			<label> dimohon melakukan refresh setiap kali selesai meng-upload image </label><br>
			<a href="{{url('admin/galleries/edit/'.$gallery['id'])}}"class="btn btn-primary"> Refresh </a>
		</div>
	</div>
	<div class="box box-solid">
		<div class="box-header">
			<h3 class="box-title"> Images </h3>
		</div>
		<form action="{{ url('admin/galleries/delete_image/'.$gallery['id'])}}" method="post">
		<div class="box-body">

			@for($i = 0; $i < count($images);)
			<div class="row">
				@for($cnt = 0; $cnt < 3 && $i < count($images); $cnt++, $i++)
				<?php $url = url('admin/setprimaryimage/gallery/'.$gallery['id'].'/'.$images[$i]['id']); ?>
				<div class="col-md-4">
					<div class="box box-{{ strcmp($gallery['imageURL'],$images[$i]['imageURL']) == 0 ? 'success' : 'primary'}}">
						<div class="box-header">
							<h4 class="box-title"> <i class="fa fa-picture-o" aria-hidden="true"></i> {{$i+1}} {{ strcmp($gallery['imageURL'],$images[$i]['imageURL']) == 0 ? '(Primary Image)' : ''}} </h4>
						</div>
						<div class="box-body">
							<img src="{{ url($images[$i]['imageURL']) }}" class="img-responsive" style="height:300px;">
						</div>
						<div class="box-footer">
							<div class="row">
				        		<div class="col-md-4">
					        		<input type="checkbox" name="delete_list[]" value="{{ $images[$i]['id'] }}"> <label> delete? </label> <br/>
						        </div>
						        <div class="col-md-4">
				                	<a class="btn btn-primary btn-sm" href="{{$url}}"> set as primary </a>
				            	</div>
				            	<div class="col-md-4">
				            		<a class="btn btn-success btn-sm" href="{{ url('admin/image/edit/'.$images[$i]['id']) }}"> edit </a>
				            	</div>
				       	 	</div>
						</div>
					</div>
				</div>
				@endfor
			</div>
			@endfor
		</div>	    
		<div class="box-footer">
			<input type="submit" class="btn btn-danger btn-lg" name="delete image(s)" value="Click here to delete selected image(s)" style="width: 100%;"/>
        </div>  
		</form>
	</div>
	<div class="box box-solid">
		<div class="box-header">
			<h3 class="box-title"> Album editor </h3>
		</div>
		<form method="post" action="{{url('admin/update_gallery/'.$gallery['id'])}}">
			<div class="box-body">
				<div class="form-group">
	                <label>Title (Indonesia)</label>
	                <input type="text" name="titleid" class="form-control" placeholder="Enter ..." value="{{ $gallery['titleid'] }}" required>
	            </div>
				<div class="form-group">
	                <label>Title (English)</label>
	                <input type="text" name="titleen" class="form-control" placeholder="Enter ..." value="{{ $gallery['titleen'] }}" required>
	            </div>

	            <div class="form-group">
                    <label> Description (Indonesia) </label>
                    <textarea class="form-control" name="contentid" rows="5" placeholder="Enter ...">{{ $gallery['descriptionid'] }}</textarea>
                </div>

	            <div class="form-group">
                    <label> Description (English) </label>
                    <textarea class="form-control" name="contenten" rows="5" placeholder="Enter ...">{{ $gallery['descriptionen'] }}</textarea>
                </div>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-info" value="save">
			</div>
		</form>
	</div>

</section>

@endsection
