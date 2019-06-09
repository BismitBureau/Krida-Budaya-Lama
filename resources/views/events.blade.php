@extends('layout.master')
@section('title', 'Events')

@section('extracss')
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/events.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/news.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')
<script src="{{ url('javascript/events.js') }}"></script>
<script src="{{ url('javascript/calendar.js') }}"></script>
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
			$link = "http://localhost:9000/".$lang."/events/".$postid;
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
            var date        = "{{\Carbon\Carbon::parse($tmp['date'])->format('l, j F Y')}}";

events.push([id,titleid," ",snippetid,titleen," ",snippeten,imageURL,date]);

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
			data += '<div class="eventBox col-12 col-sm-6">';
            data += '   <div class="single-blog-post mb-50">';
            data +=	'       <div class="post-thumbnail">';
            data +=	'           <a onClick="goto('+events[i][0]+')" href="#">';
            data +=	'               <img src="http://localhost:9000/' +  events[i][7] +'">';
            data +=	'           </a>';
            data +=	'       </div>';
            data +=	'       <div class="post-content">';
            data += '           <p class="post-date">' + events[i][8] + '</p>';
            data += '           <a onClick="goto('+events[i][0]+')" href="#" class="post-title">';
            data +=	'			    <h4>' + {{ strcmp($lang,"en") == 0 ? "events[i][4]" : "events[i][1]"}} + '</h4>';
            data +=	'           </a>';
            data +=	'           <p class="post-excerpt">' + {{ strcmp($lang,"en") == 0 ? "events[i][6]" : "events[i][3]"}} + '<br>';
            data +=	'               <a onClick="goto('+events[i][0]+')" href="#" style="color: #20d0ff;">Read More</a>';
            data +=	'          </p>';
            data +=	'       </div>';
            data +=	'   </div>';
            data +=	'</div>';
		}
		$(".archiveBox").html(data);
	}
	function goto(id) {
	    location.href="http://localhost:9000/en/events/"+id;
	}
        function getEvents(day, month, year) {
                $.get("//localhost:9000/php/getEvents.php",{ 'day' : day, 'month' : month, 'year' : year, 'lang' : '{{$lang}}' }, function(data){
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
<section class="mt-6 py-4">
    <h2 style="text-align: center" class="pt-4">EVENTS</h2>
    <div id="assetline" class="">
        <div class="mjs-object-content"></div>
    </div>
    <div class="row">
        <div class="card container mx-4 py-4 px-4 shadow col-md-3 col-sm-12" style="border-radius: 48px;">
			<div class="calendar cal-div">

            </div>

				<br>

				<table style="width:100%">
					<tr>
						<td style="text-align:left">
							<button type="button" class="btn btn-outline-info calendarBtn" id="calendarPrev"><span class="glyphicon glyphicon-chevron-left"></span>PREV</button>
						</td>
						<td style="text-align:right">
							<button type="button" class="btn btn-outline-info calendarBtn" id="calendarNext">NEXT<span class="glyphicon glyphicon-chevron-right"></span></button>
						</td>
					</tr>
				</table>
			</div>

            <div class="card container mx-auto my-auto shadow col-md-8" style="border-radius: 48px">
                <div class="firstSection pt-5 px-4">
                    <div class="py-4 px-3">
                        <div class="overflow-x-show lolbox">
                            <h2 id="currentDate" class="date-title">30 May 2019</h2>
    				    </div>
    			    </div>
    		    </div>
                <div class="firstSection pt-5 px-4" id="clockdiv" class="row">
        			<div class="py-4 px-3" id="wrapper2">
        				<h3>@if($day > 0) UPCOMING EVENTS : <a href="{{ $link }}"> {{ strcmp($lang,'en') == 0 ? $titleen : $titleid }} </a> @elseif($day == 0) ON-GOING EVENT : <a href="{{ $link }}"> {{ strcmp($lang,'en') == 0 ? $titleen : $titleid }} </a> @else NO EVENT UPCOMING @endif </h3>
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
            </div>
        </div>

        <section class="mt-6 py-4">
            <h2 style="text-align: center" class="pt-4">ARCHIVE</h2>
            <div id="assetline" class="">
                <div class="mjs-object-content"></div>
            </div>
            <section class="blog-content-area px-4 py-4">
                <div class="">
    				<div class="archiveBox row">

    				</div>
                </div>
                <div class="pager" id="loadMoreEvents">
                    <a onclick="loadMore()"><i class="" aria-hidden="true"></i> Load more</a>
                </div>
			</section>
		</section>
	</section>
@endsection
