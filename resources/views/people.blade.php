@extends('layout.master')
@section('title', 'About')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/firstabout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/people.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')


<section class="mt-6 py-4" style="background-color: #FDE25D">
    <div class="mb-4">
        <h2 style="background-image: url('new/img/panah-judul.png'); z-index: 999; background-size: cover; color: white; padding: 1em; overflow-y: hidden; background-repeat: no-repeat">LIGA TARI MAHASISWA
            UNIVERSITAS INDONESIA KRIDA BUDAYA</h2>
    </div>
    <div class="card container mx-auto my-auto shadow" style="border-radius: 48px">
        <div class="firstSection pt-5 px-4">
            <div class="py-4 px-3">
                <div class="overflow-x-hidden">
                    <div class="my-auto youtube video-container" style="text-align: center!important;">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/5sDv75FJhGo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;
                            picture-in-picture" style="max-width: 560px;" allowfullscreen></iframe>
                    </div>
                    <p style="text-align: justify; color: black" class="py-4">
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
        </div>
    </div>

</section>
<section class="mt-5">
    <h2 style="text-align: center" class="pt-4">PEOPLE </h2>
    <div id="assetline" class="">
        <div class="mjs-object-content"></div>
    </div>

    <div class="row">
        <div class="col-md-16">
            <div class="col-sm-4" id="membersize">


            </div>
        </div>
    </div>
	@foreach($data["people"] as $people)
    <div class="card container mx-auto shadow mt-5" style="border-radius: 48px">
            <div class="firstSection mx-auto px-4 col-lg-12 py-3 px-2">
                <div class="row py-0 overflow-x-show">
                    <div class="col-md-6 py-5 order-md-1 order-2 ">
                        <div class="title-area overflow-x-show">
                            <h2 class="peoplename"><strong> {{ $people['name'] }}</strong></h2>
                            <h4 class="peoplename">{{ $people['subname'] }}</h4>
                            <p class="description" style="text-align:justify">
                                 @if(strcmp($lang,'en')==0) {!! preg_replace("/\n/", "<br />", $people['contenten']) !!} @else {!! preg_replace("/\n/", "<br />", $people['contentid']) !!} @endif
                            </p>
                            <ul class="list-unstyled">
                			  <a class="peopleBtn" href="{{ $people['twitterURL'] }}"> <img src="{{ asset('new/img/twitter.png') }}" width="20px"> </a>
                			  <a class="peopleBtn" href="{{ $people['facebookURL'] }}"> <img src="{{ asset('new/img/facebook.png') }}" width="22px"> </a>
                			  <a class="peopleBtn" href="{{ $people['instagramURL'] }}"> <img src="{{ asset('new/img/instagram.png') }}" width="22px"> </a>
                          </ul>
                        </div>
                    </div>

                    <div class="col-md-6 mx-auto px-auto py-5 order-1 order-md-2 ">
                        <div class="people1 mx-auto my-auto ">
                            <img class="people-img" src="{{ url($people['photoURL']) }}" alt="{{ $people['name'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
	@endforeach

</div>
@endsection
