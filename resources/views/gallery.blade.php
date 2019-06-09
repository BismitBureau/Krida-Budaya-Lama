@extends('layout/master')

@section('title', 'Gallery')
@section('extracss')
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('new/css/gallery.css') }}">
@endsection

@section('extrajs')
<script src="{{ asset('new/js/gallery.js') }}"></script>
@endsection

@section('content')
<?php
	$count = 0;
?>
<div class="mt-5 mb-3">
    <h2 style="text-align: center" class="pt-4">GALLERY </h2>
    <div id="assetline" class="">
        <div class="mjs-object-content"></div>
    </div>

    <div class="row mb-5">
        <div id="wrapper" class="col-md-3 col-sm-12 py-5 mx-4">
            <div class="form-group">
					<section id="header-container">
						<div data-cuteselect-item="955544">
							<div id="title1" data-cuteselect-title="">{{ strcmp($lang,'en') == 0 ? 'Select origin of the dance ▼' : 'Pilih daerah tarian ▼' }}</div>
							<div data-cuteselect-options="">
								<div data-cuteselect-options-container="">
									@foreach($data["lsorigin"] as $lsorigins)
			                        <?php
			                            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '_', $lsorigins['origin']));
			                            $selected = strcmp($slug, $data['orig']) == 0 ? 'selected' : '';
			                        ?>
									<div data-cuteselect-value="{{ $slug }}" {{ $selected }}>{{ $lsorigins["origin"] }}</div>
									@endforeach
								</div>
							</div>
						</div>
              </section>
            </div>
        </div>
		<div class="col-md-8">
            <!--Photo carousel-->
            <div class="card container mx-auto shadow mt-5 mx-auto" style="border-radius: 48px">
                <div class="firstSection mx-auto px-4 col-lg-12 py-3 px-2">
                    <div class="row py-0 overflow-x-show text-align-center">
                            <div id="carouselTestimony" class="carousel slide" data-ride="carousel">
                                <h2 id="title2" class="judulDaerah"><strong>DKI Jakarta</strong></h2>
                                <ol class="carousel-indicators">
									@for($i = 0; $i < sizeof($data['gallery']); $i++)
                                    <li data-target="#carouselTestimony" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
									@endfor
                                </ol>
                                <div class="carousel-inner">
								<?php $count = true; ?>
  								@foreach($data["gallery"] as $gallery)
  								@if($data['orig'] == 'all' || $data['orig'] == strtolower(preg_replace('/[^a-z0-9]+/i', '_', $gallery['origin'])))
								@if($count)
									<div class="carousel-item active ">
								@else
									<div class="carousel-item">
								@endif
								<?php $count = false; ?>
										<div class="isiCarousel">
                                            <div class="col text-center">
												<a class="{{ 'galleryModalLink'.(++$count) }} ">
                                                	<h5>{{ strcmp($lang,'en')==0 ? $gallery['titleen'] : $gallery['titleid'] }}</P>
                                                	<img class="d-block w-100" src="{{ url($gallery['imageURL']) }}">
                                                	<p class="mt-3">{{ strcmp($lang,'en')==0 ? $gallery['descriptionen'] : $gallery['descriptionid'] }}</p>
												</a>
											</div>
                                        </div>
                                    </div>
								@endif
								@endforeach
							</div>
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
	</div>
</div>
@endsection
