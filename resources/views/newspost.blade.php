@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/article.css') }}">
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
@endsection

@section('content')
		<div class="topBorder"></div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 wrapper">
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
								{!! strcmp($lang,'en') == 0 ? $news['contenten'] : $news['contentid'] !!}
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
								@if($news['id'] != $data['news'][0]['id'])<button type="button" class="btn btn-default calendarBtn" id="prev" onclick = "location.href='{{ url($url.$prev) }}'"><span class="glyphicon glyphicon-chevron-left" ></span>previous post</button> @endif				
								@if($news['id'] != $data['news'][count($data['news'])-1]['id'])<button type="button" class="btn btn-default calendarBtn" id="next" onclick = "location.href='{{ url($url.$next) }}'">next post<span class="glyphicon glyphicon-chevron-right"></span></button> @endif
							</div>
						</tr>
					</table>
				</div>
				
				<div class="col-md-4 wrapper2">
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
						        <?php $linkurl = url('/'.$lang.'/news/'.$datum['id']); ?>
							<a href="{{ $linkurl }}">
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
	</div>
@endsection