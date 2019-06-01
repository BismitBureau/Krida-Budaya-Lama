@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/article.css') }}">
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWxGTAHS6KP8qGOj_QQtr_JkFSXOOqenk"
  type="text/javascript"></script>
@endsection

@section('content')
		<div class="topBorder"></div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 wrapper">
					<table>
						<tr>
							<div class="articleTitle">
								{{  strcmp($lang,'en') == 0 ? $event['titleen'] : $event['titleid'] }}
							</div>
						</tr>
						<tr>
							<div class="articleInfo">
								{{ $event['date'] }}
							</div>
						</tr>
						<tr>
							@if(count($images) > 0)
							<div class="articleImage">
								<div id="postSlider" class="carousel slide carousel-fade" data-ride="carousel">
									<!-- Indicators -->
									<ol class="carousel-indicators">
										@for($i = 0; $i < count($images); $i++)
										    <li data-target="#postSlider" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
										@endfor
									</ol>

									<!-- Wrapper for slides -->
									<div class="carousel-inner" role="listbox">
										@for($i = 0; $i < count($images); $i++)
										<div class="item @if($i==0) active @endif">
											<img src="{{ url($images[$i]['imageURL']) }}" class="img-responsive">
										</div>
										@endfor
									</div>

									<!-- Left and right controls -->
									<a class="left carousel-control" href="#postSlider" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#postSlider" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
							@endif
						</tr>
						<tr>
							<div class="articleContent">
							{!! strcmp($lang,'en') == 0 ? $event['contenten'] : $event['contentid'] !!}
							</div>
						</tr>
						<tr>
						<?php
							$prev = -1;
							$next = 999;
							for($i = 0 ; $i < count($data['events']); $i++) {
								if($data['events'][$i]['id'] == $event['id']) {
									if($i-1 >= 0)
										$prev = $data['events'][$i-1]['id'];
									if($i+1 < count($data['events']))
										$next = $data['events'][$i+1]['id'];
								}
							}
							$url = '/'.$lang.'/events/';
							if(isset($mobilemode))
								$url = '/m/'.$lang.'/events/';	
						?>
							<div class="articleButton">
								@if($event['id'] != $data['events'][0]['id'])<button type="button" class="btn btn-default calendarBtn" id="prev" onclick = "location.href='{{ url($url.$prev) }}'"><span class="glyphicon glyphicon-chevron-left" ></span>previous post</button> @endif				
								@if($event['id'] != $data['events'][count($data['events'])-1]['id'])<button type="button" class="btn btn-default calendarBtn" id="next" onclick = "location.href='{{ url($url.$next) }}'">next post<span class="glyphicon glyphicon-chevron-right"></span></button> @endif
							</div>
						</tr>
					</table>
				</div>
				
				<div class="col-md-4 wrapper2">
					<table>
						<tr>
							<div class="topicBoxTitle">
								Location
							</div>
						</tr>
						
						<br>
						<tr>
							{{ $event['location'] }}
						</tr>
						<br>
						
						<tr>
							<td id="googlemap">
							</td>
						</tr>		
						<script type="text/javascript">
							var LAT = <?php echo $event['lat'] ?>;
							var LNG = <?php echo $event['lng'] ?>;
							//var marker;
							function initMap() {
							  var myLatLng = {lat: LAT , lng: LNG };
							
							  // Create a map object and specify the DOM element for display.
							  var map = new google.maps.Map(document.getElementById('googlemap'), {
							    center: myLatLng,
							    scrollwheel: false,
							    draggable: false,
							    mapTypeControl: false,
							    zoom: 16
							  });
							
							  // Create a marker and set its position.
							  var marker = new google.maps.Marker({
							    map: map,
							    position: myLatLng,
							    title: 'click here for more detail!'
							  });
							  
							  google.maps.event.addListener(marker, 'click', function() {
							    location.href = "https://www.google.co.id/maps/place/" + LAT + "," + LNG;
							});
							}
							
							$(document).ready(function() {
								initMap();
								$('#googlemap').css('width','400px');
								$('#googlemap').css('height','400px');
							});
						</script>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection