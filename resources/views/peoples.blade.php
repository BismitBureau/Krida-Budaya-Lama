@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>

@section('content')
<section class="content-header">
    <h1>
        People
        <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active"><a href="#">People</a></li>
    </ol>
</section>
<section class="content">
	<div class="box box-warning">
	    <div class="box-header">
	        <h3 class="box-title">Add person</h3>
	    </div>
	    <div class="box-body">
	    	<p> silahkan upload foto untuk menambahkan, setelah sudah ada tanda cek pada file upload, refresh terlebih dahulu untuk mengedit </p>
			<form action="{{ url('admin/upload_people')}}" class="dropzone" id="my-awesome-dropzone">
			</form>
			<a href="{{ url('admin/peoples') }}" class="btn btn-default"> Click here to refresh </a>
	    </div>    
	</div>
	<div class="box box-danger">
		<div class="box-header">
			<h3 class="box-title"> Delete/edit people </h3>
		</div>
		<form action="delete_people" method="post">
		<div class="box-body">
		    @for($i=0; $i < count($data["people"]);)
		    <div class="row">
		    @for($cnt=0; $cnt < 4 && $i < count($data["people"]); $cnt++, $i++)
		    <div class="col-md-3">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title">
						<i class="fa fa-user"></i>
						{{$data["people"][$i]['name']}} 
					</h3>
				</div>
				<div class="box-body">
					<img src="{{ url($data["people"][$i]['photoURL']) }}"  class="img-responsive" width="150px" style="height:200px;margin: 0 auto;">
				</div>
				<div class="box-footer" height="500px">		

                	<div class="row">
                		<div class="col-md-12">                	
							<div class="pull-left">
				        		<input type="checkbox" name="delete_list[]" value="{{ $data["people"][$i]['id'] }}"> <label> tandai untuk delete</label> <br/>
		                	</div>
		                	<div class="pull-right">
		                		<a class="btn btn-primary btn-sm" href="{{ url('admin/peoples/edit/'.$data["people"][$i]['id']) }}"> edit </a>
		                	</div>
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
				<input type="submit" class="btn btn-danger btn-lg" name="delete achievement(s)" value="Click here to delete selected person(s)" style="width: 100%;"/>
        </div>           
        </form>   
	</div>
</section>
</div>

@endsection