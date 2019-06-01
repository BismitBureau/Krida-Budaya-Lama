@extends('layout.master')

@section('styling')
  <script src="{{ url('javascript/myScript.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
  <link rel="stylesheet" href="{{ url('style/search.css') }}">
@endsection

@section('content')
	<div class="topBorder"></div>	
	
	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div class="wrapper">
					<div class="searchTitlePage">
						search result for: {{$text}}
					</div>

					@if(count($event) == 0 && count($news) == 0)
						not found
					@endif

					
					@foreach($event as $tot)
					<div class="searchPost">
						<table>
							<tr>
								<div class="searchTitle">
									{{ strcmp($lang,'en') == 0 ? $tot->titleen : $tot->titleid}}
								</div>
							</tr>
							<tr>
								<div class="searchInfo">
									{{ $tot->date }}
								</div>
							</tr>
							<tr>
								<div class="searchSnippet">
									{{ strcmp($lang,'en')==0 ? $tot->snippeten : $tot->snippetid}}
								</div>
							</tr>
							<tr>
								<div class="readMoreSearch">
									<?php $tmplink = url('/'.$lang.'/events/'.$tot->id) ?>
									<button onclick="location.href='{{$tmplink}}'"><span>read more</span></button>
								</div>
							</tr>
							<tr>
								<div class="searchInfo2">
									Posted in Events
								</div>
							</tr>
						</table>
					</div>
					
					<div class="searchSpace"></div>

					@endforeach
					
					@foreach($news as $tot)
					<div class="searchPost">
						<table>
							<tr>
								<div class="searchTitle">
									{{ strcmp($lang,'en') == 0 ? $tot->titleen : $tot->titleid}}
								</div>
							</tr>
							<tr>
								<div class="searchInfo">
									{{ $tot->date }}
								</div>
							</tr>
							<tr>
								<div class="searchSnippet">
									{{ strcmp($lang,'en')==0 ? $tot->snippeten : $tot->snippetid}}
								</div>
							</tr>
							<tr>
								<div class="readMoreSearch">
									<?php $tmplink = url('/'.$lang.'/news/'.$tot->id) ?>
									<button onclick="location.href='{{$tmplink}}'"><span>read more</span></button>
								</div>
							</tr>
							<tr>
								<div class="searchInfo2">
									Posted in News
								</div>
							</tr>
						</table>
					</div>
					
					<div class="searchSpace"></div>

					@endforeach
					
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection