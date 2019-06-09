@extends('layout.master')

@section('title', 'Homepage')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/firstcarousel.css') }}">
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('new/css/forhire.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')
<section class="mt-4 py-2" style="margin-bottom: 3em;">
    <div id="carousel-1" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
        @for($i = 0; $i < count($data['news']); $i++)
            <li data-target="#carousel-1" data-slide-to="{{ $i }}"  @if($i == 0) class="active" @endif></li>
        @endfor
      </ol>

      <!-- Wrapper for slides -->
     <div class="carousel-inner" role="listbox">
        @for($i = 0; $i < count($data['news']); $i++)
          <div class="carousel-item firstcarousel @if($i == 0) active @endif">
            <!--<img src="{ url($data['slides'][$i]['imageURL']) }" class="img-responsive">-->
            <a onClick="readmore('{{ $data['news'][$i]['id'] }}')" href="#">
                <img class="d-block w-100" src="{{ url($data['news'][$i]['imageURL']) }}">
            </a>
            <!-- <div class="carousel-caption">
                <h3>{{ $data['news'][$i]['titleid'] }}</h3>
                <p>
                    {{ $data['news'][$i]['snippetid'] }} ...
                    <a onClick="readmore('{{ $data['news'][$i]['id'] }}')" href="#">Read More</a>
                </p>
            </div> -->
          </div>
        @endfor
      </div>

      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<section id="ai-center my-auto" class="py-5">
    <div class="card container mx-auto shadow" style="border-radius: 48px">
        <div class="firstSection">
            <div class=" py-4">
                <div class="row py-0 overflow-x-show">
                    <div class="col-lg-6">
                        <div class="title-area overflow-x-show justify-content-center">
                            <h2 style="text-align: center;"><strong>About Us</strong></h2>

                            <div id="assetline" class="">
                                <div class="mjs-object-content"></div>
                            </div>

                            <p class="description" style="text-align:justify">
                                @if(strcmp($lang,"en")==0)
									<!-- english -->
									{{$data['about']['abouten']}}

								@else
									<!-- indonesia -->
									{{$data['about']['aboutid']}}
								@endif
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="title-area" style="overflow-x: hidden">
                            <div class="my-auto youtube">

                                <iframe style="width: 100% !important; padding-right: 0;" height="315" src="https://www.youtube.com/embed/5sDv75FJhGo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-biru">
<div class="mt-4 py-2" style="display:block" >
    <div class="row">
        <div class="col-md-4 mt-4">
            <div class="kotak" style="height: 500px;">
                <div class="isiKotak">
                    <div class="col text-center">
                        <h3>Liga Tari For Hire</h3>
                        <div id="persegi" class="my-3"></div>
                        <p>+62 877 93462282 (Via)</p>
                        <p>+62 812 10246100 (Sheli)</p>
                        <p>indonesia.kridabudaya@gmail.com</p>
                        <p><a href="{{ $lang }}/comments" style="color: #20d0ff;">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-4">
            <div class="kotak" style="height: 500px;">
                <div id="carouselTestimony" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
					@for( $i = 0; $i < count($data['testimonis']); $i++)
					  <li data-target="#carouselTestimony" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
					@endfor
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" style="overflow: visible;">
					@for( $i = 0; $i < count($data['testimonis']); $i++)
					  <div class="carousel-item @if($i==0) active @endif">
                          <div class="isiCarousel">
                                <div class="col text-center">
						<h3>{{ $data['testimonis'][$i]['name'] }}</h3>
						<p>
						  {{ strcmp($lang,"en") == 0 ? $data['testimonis'][$i]['contenten'] : $data['testimonis'][$i]['contentid']}}
                        </p>
					  </div>
                  </div>
              </div>
					@endfor
				  </div>

				  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#carouselTestimony" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselTestimony" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
