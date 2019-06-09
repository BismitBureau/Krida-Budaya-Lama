@extends('layout.master')
@section('title', 'News Details')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/firstcarousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/news.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/news-details.css') }}">
@endsection

@section('content')
<section class="mt-4 py-2 blog-content-area" style="margin-bottom: 3em;">
<div class="">
    <div class="row justify-content-center">
        <!-- Blog Posts Area -->
        <div class="col-12 col-lg-8">


            <div class="single-post-details-area">
                <div class="post-content">

                        <div class="text-center mb-50">
                            <p class="post-date">{{ $news['date'] }}</p>
                            <h2 class="post-title">{{  strcmp($lang,'en') == 0 ? $news['titleen'] : $news['titleid'] }}</h2>

                            <div >
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
								{!! strcmp($lang,'en') == 0 ? $news['contenten'] : $news['contentid'] !!}
    						</p>
                        </div>
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
						?>
							<div class="articleButton">
								@if($news['id'] != $data['news'][0]['id'])<button type="button" class="btn btn-outline-info calendarBtn" id="prev" onclick = "location.href='{{ url($url.$prev) }}'"><span class="glyphicon glyphicon-chevron-left" ></span>previous post</button> @endif
								@if($news['id'] != $data['news'][count($data['news'])-1]['id'])<button type="button" class="btn btn-outline-info calendarBtn" id="next" onclick = "location.href='{{ url($url.$next) }}'">next post<span class="glyphicon glyphicon-chevron-right"></span></button> @endif
							</div>
						</div>
					</div>
				</div>


                <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                    <div class="post-sidebar-area scrolling-box">
                        <div class="single-widget-area mb-30 ">
                            <div class="widget-title">
                                <h6>Latest News</h6>
                            </div>
                            @foreach($data['news'] as $post)
                            <section class="show-five">
                                <div class="single-latest-post d-flex">

                                    <div class="post-content">
                                        <a href="#" class="post-title">
                                            <h6>{{$post['titleid']}}</h6>
                                        </a>
                                        <a href="#" class="post-author" style="color: #20d0ff;">{{\Carbon\Carbon::parse($post['date'])->format('l, j F Y')}}</a>
                                    </div>
                                </div>
                            </section>
                            @endforeach
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
@endsection
