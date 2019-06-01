<!DOCTYPE html>
<html>
  <head>
    <title> Krida Budaya | Liga Tari Mahasiswa Universitas Indonesia </title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="{{ url('style/master.css') }}"> --> @yield('styling')
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ url('javascript/myScript.js') }}"></script>
  </head>
  @if(!isset($mobilemode))
	  <script type="text/javascript">
		$(document).ready(function() {

		  var temp = "<?php
		  if(isset($news) && !isset($event)) {
		  	echo url('m/'.$lang.'/'.$curpage.'/'.$news['id']);
		  } else if(isset($event) && !isset($news)) {
		  	echo url('m/'.$lang.'/'.$curpage.'/'.$event['id']);
		  } else {
		  	echo url('m/'.$lang.'/'.$curpage);
		  }
		  ?>";
		  var w = window.innerWidth;
		  var h = window.innerHeight;
		  if(h > w) {
// Edited by Muhammad Muhlas due to unnecesarry  redirect
// 			$(location).attr('href',temp);
		  }
		});
	  </script>
  @endif
  <body onload="updatePage()">
    <div id="top"> </div>
  	<button class="upBtn btn btn-default"> <img src="{{ url('images/arrow.png') }}"> </button>
  	<header>
  		<div class="row">
  			<div class="col-sm-4 navcol-1">
  			    <a href="{{ url('/') }}">
  				    <img src="{{ url('images/logo2.png') }}" class="img-responsive" style="margin: 0; height: 75px;" width="auto">
  				</a>
  			</div>
  			<div class="col-sm-8 navcol-2" style="padding:0px">
  				<table class="headerMenus">
  					<tr>
  						<td>
  							<div class="btn-group">
								<button type="button" class="btn btn-default topBtn collapseBtn" onclick="collapseToggle()"><span class="glyphicon glyphicon-align-justify"></span></button>

								<!-- Search Form
								<div id="search">
									<span class="close glyphicon glyphicon-remove"></span>
									<form role="search" id="searchform" action="{{ url('/'.$lang.'/search') }} " method="post">
										<input value="" name="input" type="search" placeholder="search..."/>
									</form>
								</div>
								-->
								<!--
								<button type="button " id="searchBtn" class="btn btn-default topBtn topSpecial"><span class="glyphicon glyphicon-search"></span></button>
								-->

								<div class="btn-group">
									<button type="button" id="searchBtn" class="btn btn-default dropdown-toggle topBtn" data-toggle="dropdown" style="height:50px"><span class="glyphicon glyphicon-search"></span></button>
									<ul class="dropdown-menu dropdown-menu-right" role="menu">
										<li class="navbar-dropdown">
											<form role="search" id="searchform" action="{{url('/'.$lang.'/search')}}" method="post">
												<input value="" name="input" type="search" placeholder="SEARCH..."/>
											</form>
										</li>
									</ul>
								</div>

								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle topBtn" data-toggle="dropdown" style="height:50px">
										@if (strcmp($lang,'en')==0)
											EN
										@else
											ID
										@endif
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right" role="menu">
										<li class="navbar-dropdown">
											@if(isset($news) && !isset($event))
											<a href="{{ url('/') }}/id/{{ $curpage }}/{{$news['id']}}">BAHASA INDONESIA</a>
											@elseif(isset($event) && !isset($news))
											<a href="{{ url('/') }}/id/{{ $curpage }}/{{$event['id']}}">BAHASA INDONESIA</a>
											@else
											<a href="{{ url('/') }}/id/{{ $curpage }}">BAHASA INDONESIA</a>
											@endif
										</li>
										<li class="navbar-dropdown">
											@if(isset($news) && !isset($event))
											<a href="{{ url('/') }}/en/{{ $curpage }}/{{$news['id']}}">ENGLISH</a>
											@elseif(isset($event) && !isset($news))
											<a href="{{ url('/') }}/en/{{ $curpage }}/{{$event['id']}}">ENGLISH</a>
											@else
											<a href="{{ url('/') }}/en/{{ $curpage }}">ENGLISH</a>
											@endif
										</li>
									</ul>
  							  </div>
  							</div>
  						</td>
  					</tr>
  					<tr>
  						<td>
							<div class="btn-group" id="navbar">
								<a href="{{url('/'.$lang.'/home	')}}" class="btn btn-default naviBtn" style="font-size: 10px;" @if (strcmp($curpage,'home') == 0) id="activeNav" @endif>HOME</a>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle naviBtn" data-toggle="dropdown" @if (strcmp($curpage,'achievement') == 0 || strcmp($curpage,'people') == 0) id="activeNav" @endif> ABOUT US <span class="caret"></span></button>
									<ul class="dropdown-menu navbar-dropdown" role="menu">
										<li class="navbar-dropdown"><a href="{{url('/'.$lang.'/achievement')}}">ACHIEVEMENT</a></li>
										<li class="navbar-dropdown"><a href="{{url('/'.$lang.'/people')}}">PEOPLE</a></li>
									</ul>
								</div>
								<div class="btn-group">
									<button class="btn btn-default dropdown-toggle naviBtn" data-toggle="dropdown" @if (strcmp($curpage,'news') == 0 || strcmp($curpage,'events') == 0) id="activeNav" @endif> NEWS&EVENTS <span class="caret"></span></button>
									<ul class="dropdown-menu navbar-dropdown" role="menu">
										<li class="navbar-dropdown"><a href="{{url('/'.$lang.'/news')}}">NEWS</a></li>
										<li class="navbar-dropdown"><a href="{{url('/'.$lang.'/events')}}">EVENTS</a></li>
									</ul>
								</div>
								<a href="{{url('/'.$lang.'/gallery')}}" class="btn btn-default naviBtn" @if (strcmp($curpage,'gallery') == 0) id="activeNav" @endif>GALLERY</a>
								<a href="{{url('/'.$lang.'/comments')}}" class="btn btn-default naviBtn" @if (strcmp($curpage,'comments') == 0) id="activeNav" @endif>CONTACT US</a>
  							</div>
  						</td>
  					</tr>
  				</table>
  			</div>
  		</div>
  	</header>
      @yield('content')
    <footer>
  		<div id="footerTop" class="container-fluid">
  			<button class="footerBtn" onclick="location.href='https://twitter.com/kridabudaya'"> <img src="{{ url('images/twitter.png') }}"> </button>
  			<button class="footerBtn" onclick="location.href='https://facebook.com/ligatarikridabudaya'"> <img src="{{ url('images/fb.png') }}"> </button>
  			<button class="footerBtn" onclick="location.href='https://www.instagram.com/kridabudaya/'"> <img src="{{ url('images/ig.png') }}"> </button>
  			<button class="footerBtn" onclick="location.href='https://www.youtube.com/channel/UCgJzdrK4a9kosMM4T9MMEjA'"> <img src="{{ url('images/yt.png') }}"> </button>
  		</div>
  		<div id="footerBtm" class="container-fluid">
  			&copy; {{ date("Y") }}
  			ALL RIGHTS RESERVED.
  			POWERED BY <a href="https://laravel.com/">LARAVEL</a>.
  		</div>
  	</footer>
  </body >
  <script type="text/javascript">
function updatePage() {
  	var url = window.location.href;
	var array_url = url.split('/')[3];
	if(url.split('/')[0].localeCompare('http:') != 0)
		array_url = url.split('/')[1];
	// alert(array_url);
	win = $(this);
	if( array_url.localeCompare('m') == 0) {
		// $("#navbar").removeClass("btn-group");
		// $("#navbar").addClass("btn-group-vertical");
		// $("#navbar").hide();
		// $(".naviBtn").css("width","auto");
		// $(".collapseBtn").show();
		// $(".navcol-1").removeClass("col-sm-4");
		// $(".navcol-1").addClass("col-sm-12");
		// $(".navcol-2").removeClass("col-sm-8");
		// $(".navcol-2").addClass("col-sm-12");
		// $(".naviBtn").css("font-size","25px");
		// $(".naviBtn").css("height","40px");		$(".topBtn").css("font-size","2vw");
		// $(".navbar-dropdown").css("font-size","25px");
		// $(".navbar-dropdown").css("text-align","left");
		// $(".navbar-dropdown").css("width","auto");
		// $(".upBtn").css("width","4vw");
		// $(".upBtn").css("height","4vw");
		// $(".upBtn img").css("height","2vw");
		// $(".upBtn img").css("width","2vw");
		$("#navbar").removeClass("btn-group");
		$("#navbar").addClass("btn-group-vertical");
		$(".collapseBtn").show();
		$(".naviBtn").css("width",win.width());
		$(".navcol-1").removeClass("col-sm-4");
		$(".navcol-1").addClass("col-sm-12");
		$(".navcol-1").css("height","auto");
		$(".navcol-1").css("width","100%");
		$(".navcol-2").removeClass("col-sm-8");
		$(".navcol-2").addClass("col-sm-12");
		$("#navbar").hide();
		$(".naviBtn").css("font-size","6vw");
		$(".naviBtn").css("height","auto");
		$(".topBtn").css("font-size","6vw");
		$(".navbar-dropdown").css("font-size","5vw");
		$(".navbar-dropdown").css("text-align","center");
		$(".navbar-dropdown").css("width","100vw");
		$(".upBtn").css("width","6vw");
		$(".upBtn").css("height","6vw");
		$(".upBtn img").css("height","3vw");
		$(".upBtn img").css("width","3vw");
	} else {
		$("#navbar").removeClass("btn-group-vertical");
		$("#navbar").addClass("btn-group");
		$(".naviBtn").css("width","auto");
		$(".collapseBtn").hide();
		$(".navcol-1").removeClass("col-sm-12");
		$(".navcol-1").addClass("col-sm-4");
		$(".navcol-2").removeClass("col-sm-12");
		$(".navcol-2").addClass("col-sm-8");
		$(".naviBtn").css("font-size","25px");
		$(".naviBtn").css("height","40px");
		$("#navbar").show();
		$(".topBtn").css("font-size","2vw");
		$(".navbar-dropdown").css("font-size","25px");
		$(".navbar-dropdown").css("text-align","left");
		$(".navbar-dropdown").css("width","auto");
		$(".upBtn").css("width","4vw");
		$(".upBtn").css("height","4vw");
		$(".upBtn img").css("height","2vw");
		$(".upBtn img").css("width","2vw");
	}
	}
  </script>
</html>
