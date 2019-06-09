<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('new/css/style.css') }}">

<nav class="navbar navbar-expand-lg navbar-light bg-white mb-0">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('new/img/ligtar1.png') }}" class="mt-0 litar-logo-navbar" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav justify-content-center mt-5">
            <li class="nav-item dropdown mr-2 flex-collumn text-center">
                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    About
                    <div id="kotak" class="ml-0"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="{{url('/'.$lang.'/people')}}">About Us</a>
                    <a class="dropdown-item text-dark" href="{{url('/'.$lang.'/achievement')}}">Achievements</a>
                </div>
            </li>
            <li class="nav-item dropdown mr-2 flex-collumn text-center">
            <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Blog
                    <div id="kotak" class="ml-0"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="{{url('/'.$lang.'/news')}}">News</a>
                    <a class="dropdown-item text-dark" href="{{url('/'.$lang.'/events')}}">Events</a>
                </div>
            </li>
            <li class="nav-item mr-2 text-center">
                <a class="nav-link text-dark" href="{{url('/'.$lang.'/gallery')}}">
                    Gallery
                    <div id="kotak" class="ml-0"></div>
                </a>
            </li>
            <li class="nav-item mr-2 text-center">
                <a class="nav-link text-dark" href="{{url('/'.$lang.'/comments')}}">
                    Contact
                    <div id="kotak" class="ml-0"></div>
                </a>
            </li>
            <li class="nav-item mr-2 text-center">
                <div class="row justify-content-center">
                    <div class="col-md-auto" style="    -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: none; padding: 5px;">
                        <a class="btn btn-outline-info text-dark " href="{{url('/'.$lang.'/comments')}}">
                            <img class="img-responsive mr-1" style="max-width:20px;" src="http://localhost:8000/img/person1.png" alt="">
                            Liga Tari for Hire
                        </a>
                    </div>
                    <div class="col-md-auto" style="padding: 5px;">
                        <button class="btn btn-outline-info text-dark" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-responsive mr-1" style="max-width:15px;" src="http://localhost:8000/img/globe.png" alt="">
                            @if (strcmp($lang,'en')==0)
											English
										@else
											Bahasa
										@endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@if(isset($news) && !isset($event))
							<a class="dropdown-item text-dark" href="{{ url('/') }}/id/{{ $curpage }}/{{$news['id']}}">BAHASA INDONESIA</a>
							@elseif(isset($event) && !isset($news))
							<a class="dropdown-item text-dark" href="{{ url('/') }}/id/{{ $curpage }}/{{$event['id']}}">BAHASA INDONESIA</a>
							@else
							<a class="dropdown-item text-dark" href="{{ url('/') }}/id/{{ $curpage }}">BAHASA INDONESIA</a>
							@endif
                            @if(isset($news) && !isset($event))
							<a class="dropdown-item text-dark" href="{{ url('/') }}/en/{{ $curpage }}/{{$news['id']}}">ENGLISH</a>
							@elseif(isset($event) && !isset($news))
							<a class="dropdown-item text-dark" href="{{ url('/') }}/en/{{ $curpage }}/{{$event['id']}}">ENGLISH</a>
							@else
							<a class="dropdown-item text-dark" href="{{ url('/') }}/en/{{ $curpage }}">ENGLISH</a>
							@endif
						</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</nav>
