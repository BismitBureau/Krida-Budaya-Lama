@extends('layout.master')
@section('title', 'News')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/news.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
          check_if_in_view();

          $(window).on("scroll resize",check_if_in_view);

          });

        var lang;
        var mobile = false;

        function readmore(id) {
            location.href="http://localhost:9000/"+ lang +"/news/" + id;
        }

        function check_if_in_view() {
          var window_height = $(window).height();
          var window_top_position = $(window).scrollTop();
          var window_bottom_position = (window_top_position + window_height);

          $.each($(".postNews"), function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
              $element.addClass("showContent");
            }
          });
        }
    </script>
	<script type="text/javascript">
		var maxPost;
		var lastLoad;
		var posts = new Array();
		function init() {
			lastLoad = 0;
			lang = '{{ $lang }}';
				@foreach($data['news'] as $post)
					var id = "{{$post['id']}}";
					var titleid = "{{$post['titleid']}}";
					var imageURL = "{{$post['imageURL']}}";
					var snippetid = "{{$post['snippetid']}}";
					var titleen = "{{$post['titleen']}}";
					var snippeten = "{{$post['snippeten']}}";
                    var date = "{{\Carbon\Carbon::parse($post['date'])->format('l, j F Y')}}";
					posts.push([id,titleid,imageURL,snippetid," ",titleen,snippeten," ",date]);
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
		});

		function loadMore() {
			var tmp = maxPost;
			maxPost = Math.min(maxPost+3,posts.length);
			if(maxPost != tmp) {
				generateList();
				check_if_in_view();
			}
		}

		function generateList() {
			var data = "";
			if(maxPost > 3) {
				data +='<div class="newsSpace">';
				data +='</div>';
			}
			for(var i = lastLoad; i < maxPost; i++) {
                if(i == 0)
					data +=	'<div class="postNews col-12">';
				else
					data +=	'<div class="postNews col-12 col-sm-6">';
				data += '   <div class="single-blog-post mb-50">';
				data +=	'       <div class="post-thumbnail">';
				data +=	'           <a  onClick="readmore('+posts[i][0]+')" href="#">';
				data +=	'               <img src="http://kridabudaya.com/' + posts[i][2] +'">';
				data +=	'           </a>';
                data +=	'       </div>';
				data +=	'       <div class="post-content">';
				data += '           <p class="post-date">' + posts[i][8] + '</p>';
				data += '           <a href="#"  onClick="readmore('+posts[i][0]+')" class="post-title">';
                if(lang == 'id')
					data +=	'			<h4>' + posts[i][1] + '</h4>';
				else
					data +=	'			<h4>' + posts[i][5] + '</h4>';
				data +=	'           </a>';
                if(lang == 'id')
					data +=	'      <p class="post-excerpt">' + posts[i][3] + '<br>';
				else
					data +=	'      <p class="post-excerpt">' + posts[i][6] + '<br>';
				data +=	'               <a onClick="readmore('+posts[i][0]+')" href="#" style="color: #20d0ff;">Read More</a>';
				data +=	'           </p>';
				data +=	'       </div>';
				data +=	'   </div>';
				data +=	'</div>';
			}
			lastLoad = maxPost;
			$('#data_location').html($('#data_location').html() + data);
		}
	</script>

    <section class="news-section mt-6 py-4">
        <h2 style="text-align: center" class="pt-4">NEWS</h2>
        <div id="assetline" class="">
            <div class="mjs-object-content"></div>
        </div>
        <section class="blog-content-area py-4">
            <div class="">

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="blog-posts-area">
                            <div id="data_location" class="row">

    			            </div>
                        </div>
            			<div class="pager" id="loadMoreNews">
            				<a onclick="loadMore()"><i class="" aria-hidden="true"></i> Load more</a>
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
    </section>
@endsection
