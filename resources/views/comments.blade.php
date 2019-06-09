@extends('layout.master')

@section('extracss')
<link rel="stylesheet" type="text/css" href="{{ asset('new/css/contactus.css') }}">
@endsection

@section('extrajs')
@endsection

@section('content')

<section class="section-contact mt-4 pt-4" id="form1-4" data-rv-view="7288" style="overflow-x:hidden; margin:0">

    <div class="row justify-content-center">
        <div class="title col-12 col-lg-8">
            <h2 style="text-align: center;">
                CONTACT US</h2>
        </div>
    </div>

    <div id="assetline" class="">
        <div class="mjs-object-content"></div>
    </div>

    <div class="row justify-content-center mx-2">
	  <div id="col-12" style="text-align: center;">
        WE WOULD BE HAPPY TO HEAR FROM YOU SIMPLY CALL, EMAIL OR VISIT US
	  </div>
    </div>
    <div class="row justify-content-center pt-3">
       <div class="media-container-column col-lg-8" data-form-type="formoid">
    @if(isset($responseen))
   	 {{$responseen}}

            <div data-form-alert="" hidden="">
                	<strong>Success!</strong> {{ strcmp($lang,'en') == 0 ? $responseen : $responseid }}
            </div>
    @endif
    <form class="mx-0" action="{{ url('upload_comment') }}" method="post">
                <div class="row row-sm-offset">
                    <div class="col-md-5" data-for="name">
                        <div class="form-group">
                            <label class="form-control-label " for="name-form1-4">Name</label>
                            <input type="text" class="form-control" name="name" data-form-field="name" required="" id="name-form1-4">
                        </div>
                    </div>
                    <div class="col-md-4" data-for="email">
                        <div class="form-group">
                            <label class="form-control-label " for="email-form1-4">Email</label>
                            <input type="email" class="form-control" name="email" data-form-field="email" required="" id="email-form1-4">
                        </div>
                    </div>
                    <div class="col-md-3" data-for="phone">
                        <div class="form-group">
                            <label class="form-control-label " for="phone-form1-4">Website</label>
                            <input type="text" class="form-control" name="website" data-form-field="website" id="website-form1-4">
                        </div>
                    </div>
                </div>
                <div class="form-group" data-for="message">
                    <label class="form-control-label " for="message-form1-4">Message</label>
                    <textarea type="text" class="form-control" name="content" rows="7" data-form-field="content" id="message-form1-4"></textarea>
                </div>

                <span class="input-group-btn"><button href="" type="submit" class="btn btn-form btn-outline-info display-4">SEND</button></span>
            </form>
        </div>
    </div>
</section>
@endsection
