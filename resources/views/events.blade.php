@extends('layout.master')


@section('styling')
  <script src="{{ url('javascript/events.js') }}"></script>
  <script src="{{ url('javascript/calendar.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/events.css') }}">
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
@endsection

@section('content')

<?php
	date_default_timezone_set("Asia/Jakarta");
	$diff = 0;
	$day = -1;
	$titleen;
	$titleid;
	$postid;
	$link;
	$curdate;
	if(count($data['events']) > 0) {
		$min_date = $data['events'][0]['date'];
		foreach($data['events'] as $curEvent) {
			if(strcmp($curEvent['date'],date("Y-m-d")) >= 0) {
				$min_date = $curEvent['date'];
				$titleen = $curEvent['titleen'];
				$titleid = $curEvent['titleid'];
				$postid = $curEvent['id'];
			}
		}
		foreach($data['events'] as $curEvent) {
			if(strcmp($curEvent['date'],$min_date) < 0 && strcmp($curEvent['date'],date("Y-m-d")) >= 0) {
				$min_date = $curEvent['date'];
				$titleen = $curEvent['titleen'];
				$titleid = $curEvent['titleid'];
				$postid = $curEvent['id'];
			}
		}
		$curdate = date("Y-m-d");
		if(strcmp($curdate,$min_date) > 0)
		    	$day = -1;
		else {
		        $day = 0;
			while(strcmp($curdate,$min_date) != 0) {
			    $day++;
			    $curdate = date('Y-m-d', strtotime(' +'.$day.' day'));
			}
			$day = $day*24*60*60;
			$now = ((int) date('H')) * 60 * 60 + ((int) date('i')) * 60 + ((int) date('s'));
			$day -= $now;
			$day = max($day,0);
			$link = "http://kridabudaya.com/".$lang."/events/".$postid;
		}
	}
?>

<script type="text/javascript">
	var events = new Array();
	var maxPost;
	
		@foreach($data['events'] as $tmp)
			@if(strcmp($tmp['date'],$curdate) < 0) 		        
			
			var id 		= "{{$tmp['id']}}";
			var titleid 	= "{{$tmp['titleid']}}";
			var snippetid 	= "{{$tmp['snippetid']}}";
			var titleen 	= "{{$tmp['titleen']}}";
			var snippeten 	= "{{$tmp['snippeten']}}";
			var imageURL 	= "{{$tmp['imageURL']}}";
			
events.push([id,titleid," ",snippetid,titleen," ",snippeten,imageURL]); 
			
			@endif
		@endforeach
	events.reverse();
	
	function loadMore() {
		var tmp = maxPost;
		maxPost = Math.min(maxPost+3, events.length);
		if(tmp != maxPost) {
			generatePost();
			check_if_in_view();
		}
	}
	function generatePost() {
		var data = "";
		for(i = 0; i < maxPost; i++) {
			data += '<div class="row eventBox">';
			data +=	'	<div class="col-lg-6 eventBoxPicture">';
			data += '		<img src="http://kridabudaya.com/' + events[i][7] + '" class="img-responsive">';
			data += '	</div>';
			data += '	<div class="col-lg-6 eventBoxContent">';
			data += '		<table>';
			data += '			<tr>';
			data += '				<h1>' + {{ strcmp($lang,"en") == 0 ? "events[i][4]" : "events[i][1]"}} + ' </h1>';
			data += '			</tr>';
			data += '			<tr>';
			data += '				<p> ' + {{ strcmp($lang,"en") == 0 ? "events[i][6]" : "events[i][3]" }} + '</p>'; 
			data += '			</tr>';
			data += '			<tr> ';
			data += '				<div class="eventBtnBox" style="text-align:right">';
			data += '					<button onclick="goto(' + events[i][0] +')"><span>read more</span></button>';
			data += '				</div>';
			data += '			</tr>';
			data += '		</table>';
			data += '	</div>';
			data += '</div>';
			data += '<div class="eventsSpace"></div>';
		}
		$(".archiveBox").html(data);
	}
	function goto(id) {
	    location.href="http://kridabudaya.com/en/events/"+id;
	}
        function getEvents(day, month, year) {
                $.get("//kridabudaya.com/php/getEvents.php",{ 'day' : day, 'month' : month, 'year' : year, 'lang' : '{{$lang}}' }, function(data){
	       	$(".lolbox").html(data);
	        });
        }
	$(document).ready(function() {
			maxPost = Math.min(3,events.length);
			generatePost();
			getEvents({{date("d")}},{{date("m")}},{{date("Y")}});
			var diff = {{ $day }} * 1000;
			if(diff > 0) {
				var deadline = new Date(Date.parse(new Date()) + diff);
				initializeClock('clockdiv', deadline);
			}
	});
</script>
<div class="topBorder"></div>
	<div id="content" class="container-fluid">

		<div class="row calendarBox">
		
			<div class="col-sm-4 calendarAllBox">				
				<div class="calendar">
				</div>
				
				<br>
					
				<table style="width:100%">
					<tr>
						<td style="text-align:left">
							<button type="button" class="btn btn-default calendarBtn" id="calendarPrev"><span class="glyphicon glyphicon-chevron-left"></span>PREV</button>
						</td>
						<td style="text-align:right">
							<button type="button" class="btn btn-default calendarBtn" id="calendarNext">NEXT<span class="glyphicon glyphicon-chevron-right"></span></button>
						</td>
					</tr>
				</table>				
			</div>
			
			<div class="col-sm-8 calendarCurrentBox">
			
				<div id="wrapper" class="lolbox">
					<div id="currentDate">17 FEBRUARY 2016</div>
					<div class="postEvents row">
						<div class="imgEvents col-md-4">
							<img src="{{ url('images/asd.jpg') }}">							
						</div>
						<div class="infoEvents col-md-8">
							<table>
								<tr>
									<div class="titleEvents">
										<h2>PERESMIAN ANGGOTA BARU KRIDA BUDAYA 2015</h2>
									</div>
								</tr>
								<tr> 
									<div class="snippetEvents">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
										Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, 
										pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
									</div>
								</tr>
								<tr> 
									<div class="readMoreEvents">
										<button><span>read more</span></button>
									</div>
								</tr>
							</table>
						</div>
					</div>
					
					<br>
					
					<div class="postEvents row">
						<div class="imgEvents col-md-4">
							<img src="{{ url('images/asd.jpg') }}">							
						</div>
						<div class="infoEvents col-md-8">
							<table>
								<tr>
									<div class="titleEvents">
										<h2>PERESMIAN ANGGOTA BARU KRIDA BUDAYA 2015</h2>
									</div>
								</tr>
								<tr> 
									<div class="snippetEvents">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
										Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, 
										pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
									</div>
								</tr>
								<tr> 
									<div class="readMoreEvents">
										<button><span>read more</span></button>
									</div>
								</tr>
							</table>
						</div>
					</div>
					
					<br>
					
					<div class="postEvents row">
						<div class="imgEvents col-md-4">
							<img src="{{ url('images/asd.jpg') }}">							
						</div>
						<div class="infoEvents col-md-8">
							<table>
								<tr>
									<div class="titleEvents">
										<h2>PERESMIAN ANGGOTA BARU KRIDA BUDAYA 2015</h2>
									</div>
								</tr>
								<tr> 
									<div class="snippetEvents">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
										Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, 
										pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
									</div>
								</tr>
								<tr> 
									<div class="readMoreEvents">
										<button><span>read more</span></button>
									</div>
								</tr>
							</table>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
		
		<div id="clockdiv" class="row">	
			<div id="wrapper2">
				<h1>@if($day > 0) UPCOMING EVENTS : <a href="{{ $link }}"> {{ strcmp($lang,'en') == 0 ? $titleen : $titleid }} </a> @elseif($day == 0) ON-GOING EVENT : <a href="{{ $link }}"> {{ strcmp($lang,'en') == 0 ? $titleen : $titleid }} </a> @else NO EVENT UPCOMING @endif </h1>
				@if($day > 0)
				<div class="row countDownBox">
					<div class="col-sm-3 daysClk">
						<span class="days"> </span> {{strcmp($lang,'en') == 0 ? 'Days' : 'Hari'}}
					</div>
					<div class="col-sm-3 hoursClk">
						<span class="hours"></span> {{strcmp($lang,'en') == 0 ? 'Hours' : 'Jam'}}
					</div>
					<div class="col-sm-3 minutesClk">
						<span class="minutes"></span> {{strcmp($lang,'en') == 0 ? 'Minutes' : 'Menit'}}
					</div>
					<div class="col-sm-3 secondsClk">
						<span class="seconds"></span> {{strcmp($lang,'en') == 0 ? 'Seconds' : 'Detik'}}
					</div>
				</div>
				@endif
			</div>
		</div>

		<div class="row" id="eventContent2">
			<div id="wrapper3">
				<div class="titleBox">
					ARCHIVE
				</div>			
				<div class="archiveBox">

				</div>
				
				<div id="loadMoreEvents">
					<button onclick="loadMore()"><span>load more</span></button>
				</div>
			</div>

		</div>
		
	</div>

</div>
@endsection