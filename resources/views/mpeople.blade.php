@extends('layout.master')

@section('styling')
  <script src="{{ url('javascript/people.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/mindex.css') }}">
  <link rel="stylesheet" href="{{ url('style/mpeople.css') }}">
@endsection

@section('content')

<div class="topBorder"></div>

<div id="peopleWrapper">
	@foreach($data["people"] as $people)
	  <div class="peopleBox">
		<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
		  <div class="flipper">
			<div class="front">
			  <img src="{{ url($people['photoURL']) }}" class="img-circle peoplePhoto" width="420px" height="420px">
			</div>
			<div class="back img-circle">
			  <button class="peopleBtn" onclick="location.href='<?php echo $people["twitterURL"] ?>'"> <img src="{{ url('images/twitter.png') }}" width="52px"> </button>
			  <button class="peopleBtn" onclick="location.href='<?php echo $people["facebookURL"] ?>'"> <img src="{{ url('images/fb.png') }}" width="54px"> </button>
			  <button class="peopleBtn" onclick="location.href='<?php echo $people["instagramURL"] ?>'"> <img src="{{ url('images/ig.png') }}" width="54px"> </button>
			</div>
		  </div>
		</div>
		<div class="peopleName">
		  <p>{{ $people['name'] }}</p>
		</div>
		<div class="peoplePosition">
		  <p>{{ $people['subname'] }}</p>
		</div>
		<div class="peopleDesc">

		  <p> @if(strcmp($lang,'en')==0) {!! preg_replace("/\n/", "<br />", $people['contenten']) !!} @else {!! preg_replace("/\n/", "<br />", $people['contentid']) !!} @endif  </p>
		</div>
	  </div>
	  
	  <div class="peopleSpace"></div>
	@endforeach
	
</div>
@endsection