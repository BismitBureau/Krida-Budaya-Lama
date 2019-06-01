@extends('layout.admin')

@section('content')
<div class="container-fluid">
	<div class="panel panel-default">
	 	<div class="panel-heading">Comments</div>
	  	<div class="panel-body">
	  			<form method="post" action="{{ url('admin/delete_comment') }}">
				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Name</th>
				        <th>Email</th>
				        <th>Website</th>
				        <th>Date </th>
				        <th> </th>
				        <th>Delete</th>
				      </tr>
				    </thead>
				    <tbody>
				      @foreach($data['comments'] as $comment)
				     	 <tr @if($comment['read'] == false) class="info" @endif>
				        	<td> {{$comment['name']}} </td>
				        	<td> {{$comment['email']}} </td>
				        	<td> {{$comment['website']}} </td>
				        	<td> {{$comment['date']}} </td>
				        	<td> <a href="{{ url('/admin/read/'.$comment['id'])}}"> read </a> @if(!$comment['read']) <span class="label label-warning"> new/unread </span> @endif </td>
				       		<td> <input type="checkbox" name="delete_list[]" value="{{ $comment['id'] }}"> <label> delete </label> <br/> </td>
				      	 </tr>
				      @endforeach
				    </tbody>
				  </table>
			
				<input type="submit" name="delete slide(s)" value="delete comment(s)"/>
			</form>
	  	</div>
	</div>
</div>
@endsection
