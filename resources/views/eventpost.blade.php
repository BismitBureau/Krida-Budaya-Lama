@extends('layout.master')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/news-details.css') }}">
@endsection

@section('extrajs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWxGTAHS6KP8qGOj_QQtr_JkFSXOOqenk" type="text/javascript"></script>
@endsection

@section('content')
<section class="mt-6 py-4">
<div class="row">
    <div class="card container mx-auto my-auto shadow col-md-7 col-sm-10" style="border-radius: 48px">
        <div class="firstSection pt-5">
            <div class="py-4 px-3">
                <div class="text-center mb-50">
                    <p class="post-date">{{ $event['date'] }}</p>
                    <h2 class="post-title">{{  strcmp($lang,'en') == 0 ? $event['titleen'] : $event['titleid'] }}</h2>
                    <div>
                        <a href="#" style="color: #20d0ff;"><span>by</span> admin</a>
                    </div>
                </div>
				@if(count($images) > 0)
                <div class="post-thumbnail mb-50">
                    <div id="carousel-1" class="carousel slide carousel-fade" data-ride="carousel">

                        <ol class="carousel-indicators">
                            @for($i = 0; $i < count($images); $i++)
                                <li data-target="carousel-1" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
                            @endfor
                        </ol>

                        <div class="carousel-inner" role="listbox">

                            @for($i = 0; $i < count($images); $i++)
                            <div class="firstcarousel carousel-item @if($i==0) active @endif">
                                <img  class="d-block w-100" src="{{ url($images[$i]['imageURL']) }}">
                            </div>
                            @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
				@endif
                <!-- Post Text -->
                    <div class="post-text justify-content-center">
                        <p>
							{!! strcmp($lang,'en') == 0 ? $event['contenten'] : $event['contentid'] !!}
						</p>
                    </div>
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
					?>
						<div class="articleButton">
							@if($event['id'] != $data['events'][0]['id'])<button type="button" class="btn btn-outline-info calendarBtn" id="prev" onclick = "location.href='{{ url($url.$prev) }}'"><span class="glyphicon glyphicon-chevron-left" ></span>previous post</button> @endif
							@if($event['id'] != $data['events'][count($data['events'])-1]['id'])<button type="button" class="btn btn-outline-info calendarBtn" id="next" onclick = "location.href='{{ url($url.$next) }}'">next post<span class="glyphicon glyphicon-chevron-right"></span></button> @endif
						</div>
					</div>
				</div>
			</div>
            <div class="card container mx-auto my-4 py-2 shadow col-md-4 col-sm-10" style="border-radius: 48px; z-index:-100; height: 600px;">
                <h3 style="text-align: center; margin:0;">Location </h3>

                <div id="assetline" style="z-index:-99">
                    <div class="mjs-object-content"></div>
                </div>
                <p style="text-align: center; margin:0;"> {{ $event['location'] }} </p>
                <div class="row">
                    <div id="googlemap">
                    </div>
                </div>
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
                        $('#googlemap').css('width','100%');
                        $('#googlemap').css('height','400px');
                    });
                </script>
            </div>
		</div>
    </div>
</section>
@endsection
