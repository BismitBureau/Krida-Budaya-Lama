@extends('layout.admin')
<link rel="stylesheet" href="{{ url('style/basic.css') }}">
<script src="{{ url('javascript/dropzone.js') }}"></script>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWxGTAHS6KP8qGOj_QQtr_JkFSXOOqenk&libraries=places" type="text/javascript"></script>
<script src="{{url('javascript/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

@section('content')
<style>
	#searchbox {
	  background-color: #fff;
	  font-family: Roboto;
	  font-size: 15px;
	  font-weight: 300;
	  margin-left: 12px;
	  padding: 0 11px 0 13px;
	  text-overflow: ellipsis;
	  width: 300px;
	}
	
	#searchbox:focus {
	  border-color: #4d90fe;
	}


</style>
<input type="text" id="searchbox" class="form-control" placeholder="search location">
<script type="text/javascript">
	var LAT = <?php echo $event['lat'] ?>;
	var LNG = <?php echo $event['lng'] ?>;
	var marker;
	//var marker;
	function initMap() {
	
	  var myLatLng = {lat: LAT , lng: LNG };
	
	  // Create a map object and specify the DOM element for display.
	  var map = new google.maps.Map(document.getElementById('googlemap'), {
	    center: myLatLng,
	    scrollwheel: true,
	    draggable: true,
	    mapTypeControl: true,
	    zoom: 10
	  });
	  
	  var input = document.getElementById('searchbox');
	  var searchBox = new google.maps.places.SearchBox(input);
	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	
	  // Create a marker and set its position.
	  marker = new google.maps.Marker({
	    map: map,
	    position: myLatLng
	  });
	  
	  google.maps.event.addListener(map, 'click', function(event) {
	     placeMarker(event.latLng);
	  });
	
	  function placeMarker(location) {
	      //clearMarkers();
	      marker.setMap(null);
	      marker = new google.maps.Marker({
	          position: location, 
	          map: map
	      });
	      
	      document.getElementById('LAT').value = location.lat();
	      document.getElementById('LNG').value = location.lng();
	      marker.setMap(map);
	  }
	  
	  map.addListener('bounds_changed', function() {
	    searchBox.setBounds(map.getBounds());
	  });
	  
	  var markers = [];
	  // Listen for the event fired when the user selects a prediction and retrieve
	  // more details for that place.
	  searchBox.addListener('places_changed', function() {
	    var places = searchBox.getPlaces();
	
	    if (places.length == 0) {
	      return;
	    }
	
	    // Clear out the old markers.
	    markers.forEach(function(marker) {
	      marker.setMap(null);
	    });
	    markers = [];
	
	    // For each place, get the icon, name and location.
	    var bounds = new google.maps.LatLngBounds();
	    places.forEach(function(place) {
	      var icon = {
	        url: place.icon,
	        size: new google.maps.Size(71, 71),
	        origin: new google.maps.Point(0, 0),
	        anchor: new google.maps.Point(17, 34),
	        scaledSize: new google.maps.Size(25, 25)
	      };
	
	      // Create a marker for each place.
	      placeMarker(place.geometry.location);
	      // markers.push(new google.maps.Marker({
	      //   map: map,
	      //   icon: icon,
	      //   title: place.name,
	      //   position: place.geometry.location
	      // }));
	
	      if (place.geometry.viewport) {
	        // Only geocodes have viewport.
	        bounds.union(place.geometry.viewport);
	      } else {
	        bounds.extend(place.geometry.location);
	      }
	    });
	    map.fitBounds(bounds);
	  });
	}
	
	$(document).ready(function() {
		$('#googlemap').css('width','600');
		$('#googlemap').css('height','600');
		initMap();
	});
</script>
<section class="content-header">
    <h1>
        Event
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li><a href="{{ url('admin/eventmanager') }} ">Event</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">

	<div class="box box-solid">
		<div class="box-header">
			<h4 class="box-title"> Upload image(s) </h4>
		</div>
		<div class="box-body">
			<form action="{{ url('admin/upload_image/event/'.$event['id']) }}" class="dropzone" id="my-awesome-dropzone">
			</form>
		</div>
		<div class="box-footer">
			<label> dimohon melakukan refresh setiap kali selesai meng-upload image </label><br>
			<a href="{{url('admin/eventmanager/edit/'.$event['id'])}}"class="btn btn-primary"> Refresh </a>
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
		<form action="{{ url('admin/eventmanager/delete_image/'.$event['id'])}}" method="post">
		<div class="box-body">

			@for($i = 0; $i < count($images);)
			<div class="row">
				@for($cnt = 0; $cnt < 3 && $i < count($images); $cnt++, $i++)
				<?php $url = url('admin/setprimaryimage/event/'.$event['id'].'/'.$images[$i]['id']); ?>
				<div class="col-md-4">
					<div class="box box-{{ strcmp($event['imageURL'],$images[$i]['imageURL']) == 0 ? 'success' : 'primary'}}">
						<div class="box-header">
							<h4 class="box-title"> <i class="fa fa-picture-o" aria-hidden="true"></i> {{$i+1}} {{ strcmp($event['imageURL'],$images[$i]['imageURL']) == 0 ? '(Primary Image)' : ''}} </h4>
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
		<form method="post" action="{{url('admin/update_event/'.$event['id'])}}">
			<div class="box-body">
				<div class="form-group">
	                <label>Title (Indonesia)</label>
	                <input type="text" name="titleid" class="form-control" placeholder="Enter ..." value="{{ $event['titleid'] }}" required>
	            </div>
				<div class="form-group">
	                <label>Title (English)</label>
	                <input type="text" name="titleen" class="form-control" placeholder="Enter ..." value="{{ $event['titleen'] }}" required>
	            </div>

	            <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" name="date" class="form-control" value="{{ $event['date'] }}">
                </div>

	            <div class="form-group">
	            	<label> Editor (Indonesia) </label>
	            	<textarea id="contentid" name="contentid" rows="10" cols="80">
	                    {!! $event['contenten'] !!}
	                </textarea> 
	            </div>

	            <div class="form-group">
	            	<label> Editor (English) </label>
	            	<textarea id="contenten" name="contenten" rows="10" cols="80">
	                    {!! $event['contenten'] !!}
	                </textarea> 
	            </div>

				<div class="form-group">
	                <label>Date</label>
	                <input type="date" name="date" class="form-control" value="{{ $event['date'] }}" required>
	            </div>

	            <div class="form-group">
	                <label>Location Description</label>
	                <input type="text" name="location" class="form-control" placeholder="Enter ..." value="{{ $event['location'] }}" required>
	            </div>

                <input type="hidden" id="LAT" name="LAT" class="form-control" placeholder="Enter ..." value="{{ $event['lat'] }}" required>
                <input type="hidden" id="LNG" name="LNG" class="form-control" placeholder="Enter ..." value="{{ $event['lng'] }}" required>
                <div class="form-group">
                	<label>Maps </label>
					<div id="googlemap" > test </div>
                </div>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-info" value="save">
			</div>
		</form>
	</div>

</section>

@endsection