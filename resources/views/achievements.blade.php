@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>

@section('content')
<section class="content-header">
    <h1>
        Achievements
        <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active"><a href="#">Achievements</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
	    <div class="box-header">
	        <h3 class="box-title">Add achievement</h3>
	    </div>
	    <form role="form" action="upload_achievement" method="post">
	    <div class="box-body">
	            <div class="form-group">
	                <label>Year</label>
	                <input type="text" name="year[]" class="form-control" placeholder="Enter ...">
	            </div>  
	            <div class="form-group">
	                <label>Content Indonesia</label>
	                <input type="text" name="stringid[]" class="form-control" placeholder="Enter ...">
	            </div>    
	            <div class="form-group">
	                <label>Content English</label>
	                <input type="text" name="stringen[]" class="form-control" placeholder="Enter ...">
	            </div>  
	    </div>
	    <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>                      
	    </form>
	</div>
<div class="box box-danger">
	    <div class="box-header">
	        <h3 class="box-title">Delete achievement</h3>
	    </div>
		<form action="delete_achievement" method="post">
	    <div class="box-body"> 
	    	@foreach($data["achievements"] as $achievement)
	    	<div class="box box-solid">
                <div class="box-header">
                    <i class="fa fa-star"></i>
                    <h3 class="box-title">{{ $achievement['year'] }}</h3>
                </div>
                <div class="box-body">
                    <dl>
                        <dt>Content English</dt>
                        <dd>{{ $achievement['stringen'] }}</dd>
                        <dt>Content Indonesia</dt>
                        <dd>{{ $achievement['stringid'] }}</dd>
                    </dl>
                </div>
                <div class="box-footer" height="500px">
                	<div class="row">
                		<div class="col-md-12">
		                	<div class="pull-left">
				        		<input type="checkbox" name="delete_list[]" value="{{ $achievement['id'] }}"> <label> tandai untuk delete achievement </label> <br/>
		                	</div>
		                	<div class="pull-right">
		                		<a class="btn btn-primary btn-sm" href="{{ url('admin/achievements/edit/'.$achievement['id']) }}"> edit </a>
		                	</div>
	                	</div>
               	 	</div>
                </div>            
            </div>
	    	@endforeach
	    </div>
	    <div class="box-footer">
				<input type="submit" class="btn btn-danger btn-lg" name="delete achievement(s)" value="Click here to delete selected achievement(s)" style="width: 100%;"/>
        </div>           
        </form>           
	</div>
</section>

@endsection
