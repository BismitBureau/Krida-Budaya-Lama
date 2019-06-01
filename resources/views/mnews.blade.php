@extends('layout.master')

@section('styling')
  <script src="{{ url('javascript/news.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/mnews.css') }}">
  <link rel="stylesheet" href="{{ url('style/mindex.css') }}">
@endsection


@section('content')
	<script type="text/javascript">
		var maxPost;
		var lastLoad;
		var posts = new Array();
		function init() {
			lastLoad = 0;
			lang = '{{ $lang }}';
			mobile = true;
				@foreach($data['news'] as $post)
					var id = "{{$post['id']}}";
					var titleid = "{{$post['titleid']}}";
					var imageURL = "{{$post['imageURL']}}";
					var snippetid = "{{$post['snippetid']}}";
					var titleen = "{{$post['titleen']}}";
					var snippeten = "{{$post['snippeten']}}";
					posts.push([id,titleid,imageURL,snippetid," ",titleen,snippeten," "]);
				@endforeach
			maxPost = Math.min(3,posts.length);
			if(posts.length > 0) {
				generateList();
				check_if_in_view();
			} else {
				$('#data_location').html('<h1> empty post </h1>');
			}
		}
		$(document).ready(function() {
			init();
		})

		function loadMore() {
			var tmp = maxPost;
			if(tmp != maxPost) {
				maxPost = Math.min(maxPost+3,posts.length);
				generateList();
				check_if_in_view();
			}
		}

		function generateList() {
			var data = "";
			for(var i = lastLoad; i < maxPost; i++) {
				data += '<div class="postNews">';
				data += '	<table>';
				data += '		<tr>';
				data += '			<div class="titleNews">';
				data += '				<h2>'
				if(lang == 'id')
					data += posts[i][1];
				else
					data += posts[i][5];
				data += '				</h2>';
				data += '			</div>';
				data += '		</tr>';
				data += '		<tr>';
				data += '			<div class="imgNews">';
				data += '				<img src="http://kridabudaya.com/' + posts[i][2] + '">';
				data += '			</div>';
				data += '		</tr>';
				data += '		<tr>';
				data += '			<div class="row">';
				data += '			<div class="col-md-12" style="word-wrap: break-word;">';
				data += '			<div class="snippetNews">';
				if(lang == 'id')
					data += posts[i][3];
				else
					data += posts[i][6];
				data += '			</div>';
				data += '			</div>';
				data += '			</div>';
				data += '		</tr>';
				data += '		<tr>';
				data += '			<div class="readMoreNews">';
				data += '				<button id="readMoreNewsLink" onClick="readmore('+posts[i][0]+')"><span>read more</span></button>';
				data += '			</div>';
				data += '		</tr>';
				data += '	</table>';
				data += '</div>';
				if(i+1 != maxPost) {
					data +='<div class = "newsSpace">';
					data +='</div>';
				}
			}
			lastLoad = maxPost;
			$('#data_location').html($('#data_location').html() + data);
		}
	</script>

	<div class="topBorder"></div>

	<div id="newsContent">
		<div class="container-fluid">
		
			<div class="row">
				<div id="data_location">
				</div>

				<div id="loadMoreNews">
					<button onclick="loadMore()"><span>load more</span></button>
				</div>
			</div>
		</div>
@endsection