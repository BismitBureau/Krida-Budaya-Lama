@extends('layout.master')

@section('styling')
  <script src="{{ url('javascript/gallery.js') }}"></script>
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
  <link rel="stylesheet" href="{{ url('style/gallery.css') }}">
  <script>
      function ons(obj){
          console.log(obj.value);
      }
  </script>
@endsection


@section('content')
<?php
	$count = 0;
?>
<div class="topBorder"></div>

<div id="galleryContent">
    <div class="form-group">
        <label for="origin">Asal</label>
        <select class="form-control" id="origin" onchange="window.location.href = '{{ url($lang . '/gallery') }}/' + this.value">
            @foreach($data["lsorigin"] as $lsorigins)
            <?php
                $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '_', $lsorigins['origin']));
                $selected = strcmp($slug, $data['orig']) == 0 ? 'selected' : ''
            ?>
            <option value="{{ $slug }}" {{ $selected }}>{{ $lsorigins["origin"] }}</option>
            @endforeach
        </select>
    </div>

  @foreach($data["gallery"] as $gallery)
  @if($data['orig'] == 'all' || $data['orig'] == strtolower(preg_replace('/[^a-z0-9]+/i', '_', $gallery['origin'])))
	<!-- tari 1 -->
  <div class="container-fluid galleryPost">
    <div class="row">
      <a class="{{ 'galleryModalLink'.(++$count) }} ">
        <img src="{{ url($gallery['imageURL']) }}" class="img-responsive">
        <div class="galleryInfo">
          <h1>{{ strcmp($lang,'en')==0 ? $gallery['titleen'] : $gallery['titleid'] }}</h1>
		  <p>
			{{ strcmp($lang,'en')==0 ? $gallery['descriptionen'] : $gallery['descriptionid'] }}         
		  </p>
        </div>
      </a>
    </div>
  </div>

	<!-- isi foto tari 1-->
  <div id="{{ 'galleryModal'.$count }}" class="modal">
	<div class="galleryModal-content">
      
	  <div class="galleryModal-header">
		<span class="close glyphicon glyphicon-remove tolkon{{$count}}"></span>
        <div class="galleryModalTitle">
          {{ strcmp($lang,'en')==0 ? $gallery['titleen'] : $gallery['titleid'] }}
        </div>
      </div>

      <div class="galleryModal-body">
        @foreach($data['images'] as $image)
        @if($image['gallery_id'] == $gallery['id'] && strcmp($image['imageURL'],$gallery['imageURL'])!=0)
        <div class="responsive">
          <div class="imgPost">
            <img class="thisImg" src="{{ url($image['imageURL']) }}">
            <div class="imgDesc">
				{{ strcmp($lang,'en')==0 ? $image['descriptionen'] : $image['descriptionid'] }}
            </div>
			<!--
            <div class="imgTitle">
              {{ strcmp($lang,'en')==0 ? $image['titleen'] : $image['titleid'] }}
            </div>
			-->
          </div>
        </div>
        @endif
        @endforeach

        <div class="clearfix"></div>
      </div>

      <div class="galleryModal-footer">
      </div>
	  
    </div>
  </div>

  <div class="gallerySpace"></div>
  @endif
  @endforeach

  
  <!-- zoom tiap foto tari -->
  <div id="imgModal" class="modal">
	<span class="closeImg glyphicon glyphicon-remove"></span>
	  <img class="imgModal-content" id="img01">
	  <div id="title">DESCRIPTION</div>
	  <div id="caption"></div>
  </div>
  
</div>

<?php
	$count = 0;
?>
<script type="text/javascript">
	$(document).ready(function() {
		
		@foreach($data["gallery"] as $gallery)
		var {{ 'modal'.(++$count) }} = document.getElementById('{{ "galleryModal".$count }}');
		var {{ 'span'.$count }} = document.getElementsByClassName("close glyphicon glyphicon-remove tolkon{{$count}}")[0];
	
		$("a.{{ 'galleryModalLink'.$count }}").click(function(){
		   {{ 'modal'.$count }}.style.display = "block";
		 });
		 
		{{ 'span'.$count }}.onclick = function() {
		    {{ 'modal'.$count }}.style.display = "none";
		}
		
		window.onclick = function(event) {
			if (event.target == {{ 'modal'.$count }}) {
				{{ 'modal'.$count }}.style.display = "none";
			}
		}
		@endforeach
		
	});
</script>
@endsection