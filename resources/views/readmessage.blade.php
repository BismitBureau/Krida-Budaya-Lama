@extends('layout.admin')

@section('content')
<div class="container-fluid">
	<div class="panel panel-default">
	 	<div class="panel-heading"> <h2> {{ $message['name'] }}  ({{ $message['email'] }}) | {{ $message['date'] }} </h2> </div>
	  	<div class="panel-body">
	  		<p> {!! preg_replace("/\n/", "<br />", $message['content']) !!} </p>
	  		<hr>
	  		<p> {{ $message['website'] }} </p>
	  	</div>
	</div>
</div>
@endsection
