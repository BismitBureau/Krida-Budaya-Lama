@extends('layout.admin')

@section('content')
<section class="content-header">
    <h1>
        News
        <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active"><a href="#">News</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
	    <div class="box-header">
	        <h3 class="box-title">Add post as news</h3>
	    </div>
	    <form role="form" action="upload_news" method="post">
	    <div class="box-body">
	            <div class="form-group">
	                <label>Title Indonesia</label>
	                <input type="text" name="titleid[]" class="form-control" placeholder="Enter ...">
	            </div>  
	            <div class="form-group">
	                <label>Title English</label>
	                <input type="text" name="titleen[]" class="form-control" placeholder="Enter ...">
	            </div>
	    </div>
	    <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>                      
	    </form>
	</div>
	<div class="box box-danger">
		<div class="box-header">
			<h3 class="box-title">Delete/edit post</h3>
		</div>
		<form action="delete_news" method="post">
		<div class="box-body">
			@foreach($data["news"] as $post)
			<div class="box box-solid">
				<div class="box-header">
					<h4 class="box-title"> <i class="fa fa-file-text"></i> {{$post['titleid']}} | {{ $post['titleen']}}</h4>
				</div>
				<div class="box-body">
					<label> content (English) </label>
					<p> {{ strip_tags($post['snippeten']) }}... </p>
					<label> content (Indonesia) </label>
					<p> {{ strip_tags($post['snippetid']) }}... </p>
				</div>
				<div class="box-footer">
                	<div class="row">
                		<div class="col-md-12">
		                	<div class="pull-left">
				        		<input type="checkbox" name="delete_list[]" value="{{ $post['id'] }}"> <label> tandai untuk delete post </label> <br/>
		                	</div>
		                	<div class="pull-right">
		                		<a class="btn btn-primary btn-sm" href="{{ url('admin/newsmanager/edit/'.$post['id']) }}"> edit </a>
		                	</div>
	                	</div>
               	 	</div>
				</div>
			</div>
			@endforeach
		</div>
	    <div class="box-footer">
				<input type="submit" class="btn btn-danger btn-lg" name="delete achievement(s)" value="Click here to delete selected post(s)" style="width: 100%;"/>
        </div>       
    	</form>
	</div>
</section>
@endsection
