@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>

@section('content')
<section class="content-header">
    <h1>
        Testimonial Box
        <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active"><a href="#">Testimonial Box</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
	    <div class="box-header">
	        <h3 class="box-title">Add testimoni</h3>
	    </div>
	    <form role="form" action="upload_testimoni" method="post">
	    <div class="box-body">
	            <div class="form-group">
	                <label>Name</label>
	                <input type="text" name="name[]" class="form-control" placeholder="Enter ...">
	            </div>  
	            <div class="form-group">
	                <label>Content Indonesia</label>
	                <input type="text" name="contentid[]" class="form-control" placeholder="Enter ...">
	            </div>    
	            <div class="form-group">
	                <label>Content English</label>
	                <input type="text" name="contenten[]" class="form-control" placeholder="Enter ...">
	            </div>  
	    </div>
	    <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>                      
	    </form>
	</div>

	<div class="box box-danger">
	    <div class="box-header">
	        <h3 class="box-title">Delete testimoni</h3>
	    </div>
		<form action="delete_testimoni" method="post">
	    <div class="box-body"> 
	    	@foreach($data["testimonis"] as $testimoni)
	    	<div class="box box-solid">
                <div class="box-header">
                    <i class="fa fa-text-width"></i>
                    <h3 class="box-title">{{ $testimoni['name'] }}</h3>
                </div>
                <div class="box-body">
                    <dl>
                        <dt>Content English</dt>
                        <dd>{{ $testimoni['contenten'] }}</dd>
                        <dt>Content Indonesia</dt>
                        <dd>{{ $testimoni['contentid'] }}</dd>
                    </dl>
                </div>
                <div class="box-footer" height="500px">
                	<div class="row">
                		<div class="col-md-12">
		                	<div class="pull-left">
				        		<input type="checkbox" name="delete_list[]" value="{{ $testimoni['id'] }}"> <label> tandai untuk delete testimoni </label> <br/>
		                	</div>
		                	<div class="pull-right">
		                		<a class="btn btn-primary btn-sm" href="{{ url('admin/testimonial/edit/'.$testimoni['id']) }}"> edit </a>
		                	</div>
	                	</div>
               	 	</div>
                </div>            
            </div>
	    	@endforeach
	    </div>
	    <div class="box-footer">
				<input type="submit" class="btn btn-danger btn-lg" name="delete testimoni(s)" value="Click here to delete selected testimoni(s)" style="width: 100%;"/>
        </div>           
        </form>           
	</div>

</section>

@endsection
