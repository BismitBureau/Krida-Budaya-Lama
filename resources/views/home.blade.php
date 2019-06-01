@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
  <script src="{{ url('javascript/news.js') }}"></script>
@endsection


@section('content')

<div class="topBorder"></div>

<div class="container-fluid home">
  <div class="row">
    <div id="homeSlider" class="carousel slide carousel-fade" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        @for($i = 0; $i < count($data['news']); $i++)
          <li data-target="#homeSlider" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif></li>
        @endfor
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        @for($i = 0; $i < count($data['news']); $i++)
          <div class="item @if($i == 0) active @endif">
            <!--<img src="{ url($data['slides'][$i]['imageURL']) }" class="img-responsive">-->
            <img src="{{ url($data['news'][$i]['imageURL']) }}" class="img-responsive">
            <div class="carousel-caption">
                <h3>{{ $data['news'][$i]['titleid'] }}</h3>
                <p>
                    {{ $data['news'][$i]['snippetid'] }} ... 
                    <a onClick="readmore('{{ $data['news'][$i]['id'] }}')" href="#">Read More</a>
                </p>
            </div>
          </div>
        @endfor
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#homeSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Prev</span>
      </a>
      <a class="right carousel-control" href="#homeSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

	<div id="wrapperHome">
	
		<div class="row">
			<div class="el1 col-md-4">
				<div id="cp">
					<table>
						<tr>
							<div class="cpTitle">
								Liga Tari for Hire
							</div>
						</tr>
						<tr>
							<div class="cpTitle2">
								MARKETING
							</div>
						</tr>
					</table>
					
					<table>
						<tr>
							<td>
								<div class="teleponCp">
									+62 877 93462282
								</div>
							</td>
							<td>
								<div class="namaCp">
									Via
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="teleponCp">
									+62 812 10246100
								</div>
							</td>
							<td>
								<div class="namaCp">
									Sheli
								</div>
							</td>
						</tr>
					</table>
					
					<table>
						<tr>
							<div class="row">
								<div class="logoEmailCp col-lg-2">
									<img src="{{ url('images/gmail-logo.ico') }}" alt="gmail-logo">
								</div>
								<div class="alamatEmailCp col-lg-10">
									indonesia.kridabudaya@gmail.com
								</div>
							</div>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="el2 col-md-8">
				<div id="about">
					<table>
						<tr>
							<div class="aboutTitle">
								About Krida Budaya
							</div>
						</tr>
						<tr>
							<div id="aboutContent">
								@if(strcmp($lang,"en")==0)
									<!-- english -->
									{{$data['about']['abouten']}}
									
								@else
									<!-- indonesia -->
									{{$data['about']['aboutid']}}
								@endif
							</div>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
		<div class="spaceHome"></div>
		
		<div class="row">
			<div class="el3 col-md-12">
				<div id="testimonialBox" class="carousel slide carousel-fade" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					@for( $i = 0; $i < count($data['testimonis']); $i++)
					  <li data-target="#testimonialBox" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
					@endfor
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					@for( $i = 0; $i < count($data['testimonis']); $i++)
					  <div class="item @if($i==0) active @endif">
						<div class="testiName">{{ $data['testimonis'][$i]['name'] }}</div>
						<div class="testiContent">
						  {{ strcmp($lang,"en") == 0 ? $data['testimonis'][$i]['contenten'] : $data['testimonis'][$i]['contentid']}}
						</div>
					  </div>
					@endfor
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#testimonialBox" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Prev</span>
				  </a>
				  <a class="right carousel-control" href="#testimonialBox" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
		
	</div>
	
</div>
@endsection