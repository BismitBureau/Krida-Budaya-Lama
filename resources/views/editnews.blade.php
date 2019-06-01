@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="{{url('javascript/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

@section('content')
<section class="content-header">
    <h1>
        News
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li><a href="{{ url('admin/newsmanager') }} ">News</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">

	<div class="box box-solid">
		<div class="box-header">
			<h4 class="box-title"> Upload image(s) </h4>
		</div>
		<div class="box-body">
			<form action="{{ url('admin/upload_image/news/'.$news['id']) }}" class="dropzone" id="my-awesome-dropzone">
			</form>
		</div>
		<div class="box-footer">
			<label> dimohon melakukan refresh setiap kali selesai meng-upload image </label><br>
			<a href="{{url('admin/newsmanager/edit/'.$news['id'])}}"class="btn btn-primary"> Refresh </a>
		</div>
	</div>
	<script type="text/javascript">
		function copyLink(imageurl) {
			alert(imageurl);
			var dummy = document.createElement('input');
			document.body.appendChild(dummy);
			dummy.setAttribute('id', 'dummy_id');
			document.getElementById('dummy_id').value = imageurl;
			dummy.select();
			document.execCommand('copy');
			document.body.removeChild(dummy);
		}
		$(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('contentid');
                CKEDITOR.replace('contenten');
        });
	</script>
	<div class="box box-solid">
		<div class="box-header">
			<h3 class="box-title"> Images </h3>
		</div>
		<form action="{{ url('admin/newsmanager/delete_image/'.$news['id'])}}" method="post">
		<div class="box-body">

			@for($i = 0; $i < count($images);)
			<div class="row">
				@for($cnt = 0; $cnt < 3 && $i < count($images); $cnt++, $i++)
				<?php $url = url('admin/setprimaryimage/news/'.$news['id'].'/'.$images[$i]['id']); ?>
				<div class="col-md-4">
					<div class="box box-{{ strcmp($news['imageURL'],$images[$i]['imageURL']) == 0 ? 'success' : 'primary'}}">
						<div class="box-header">
							<h4 class="box-title"> <i class="fa fa-picture-o" aria-hidden="true"></i> {{$i+1}} {{ strcmp($news['imageURL'],$images[$i]['imageURL']) == 0 ? '(Primary Image)' : ''}} </h4>
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
				            		<?php $hehe = url($images[$i]['imageURL']); ?>
				            		<a class="btn btn-success btn-sm" onclick="copyLink('{{$hehe}}')"> copy link </a>
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
			<h3 class="box-title"> Text editor </h3>
		</div>
		<form method="post" action="{{url('admin/update_news/'.$news['id'])}}">
			<div class="box-body">
				<div class="form-group">
	                <label>Title (Indonesia)</label>
	                <input type="text" name="titleid" class="form-control" placeholder="Enter ..." value="{{ $news['titleid'] }}" required>
	            </div>
				<div class="form-group">
	                <label>Title (English)</label>
	                <input type="text" name="titleen" class="form-control" placeholder="Enter ..." value="{{ $news['titleen'] }}" required>
	            </div>

	            <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" name="date" class="form-control" value="{{ $news['date'] }}" required>
                </div>

	            <div class="form-group">
	            	<label> Editor (Indonesia) </label>
	            	<textarea id="contentid" name="contentid" rows="10" cols="80">
	                    {!! $news['contentid'] !!}
	                </textarea> 
	            </div>

	            <div class="form-group">
	            	<label> Editor (English) </label>
	            	<textarea id="contenten" name="contenten" rows="10" cols="80">
	                    {!! preg_replace("/\n/", "<br />", $news['contenten']) !!}
	                </textarea> 
	            </div>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-info" value="save">
			</div>
		</form>
	</div>

</section>
@endsection
