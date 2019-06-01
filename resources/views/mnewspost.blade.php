@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/marticle.css') }}">
  <link rel="stylesheet" href="{{ url('style/mindex.css') }}">
@endsection

@section('content')
		<div class="topBorder"></div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="wrapper">
					<table>
						<tr>
							<div class="articleTitle">
								{{  strcmp($lang,'en') == 0 ? $news['titleen'] : $news['titleid'] }}
							</div>
						</tr>
						<tr>
							<div class="articleInfo">
								Posted on {{ $news['date'] }} by admin
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
										<span class="sr-only">Prev</span>
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
							<div class="row">
							<div class="col-md-12">
							<div class="articleContent">
								{!! strcmp($lang,'en') == 0 ? $news['contenten'] : $news['contentid'] !!}
							</div>
							</div>
							</div>
						</tr>
						<tr>
						<?php
							$prev = -1;
							$next = 999;
							for($i = 0 ; $i < count($data['news']); $i++) {
								if($data['news'][$i]['id'] == $news['id']) {
									if($i-1 >= 0)
										$prev = $data['news'][$i-1]['id'];
									if($i+1 < count($data['news']))
										$next = $data['news'][$i+1]['id'];
								}
							}
							$url = '/'.$lang.'/news/';
							if(isset($mobilemode))
								$url = '/m/'.$lang.'/news/';	
						?>						
							<div class="articleButton">
								@if($news['id'] != $data['news'][0]['id'])<button type="button" class="btn btn-default calendarBtn" id="prev" onclick = "location.href='{{ url($url.$prev) }}'"><span class="glyphicon glyphicon-chevron-left" ></span>prev post</button>		@endif		
								@if($news['id'] != $data['news'][count($data['news'])-1]['id'])<button type="button" class="btn btn-default calendarBtn" id="next" onclick = "location.href='{{ url($url.$next) }}'">next post<span class="glyphicon glyphicon-chevron-right"></span></button> @endif
							</div>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="row">
				<div class="wrapper2">
					<table>
					
						<tr>
							<div class="topicBoxTitle">
								@if(count($data['news']) <= 1) No @endif Other News
							</div>
						</tr>
						
						<br>
						@foreach($data['news'] as $datum)
						@if(strcmp($datum['id'],$news['id']) != 0)
						<tr>
							<a href="#">
								<div class="topicPost">
									<div class="topicTitle">
										{{ strcmp($lang,'en') == 0 ? $datum['titleen'] : $datum['titleid'] }}
									</div>
								</div>
							</a>
						</tr>
						@endif
						@endforeach
					</table>
				</div>
			</div>
		</div>
@endsection