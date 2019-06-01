@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/index.css') }}">
  <link rel="stylesheet" href="{{ url('style/comments.css') }}">
@endsection


@section('content')
  
  <div id="commentsContent">
    <div id="wrapper">
	  <div id="bigWords">
        WE WOULD BE HAPPY TO HEAR FROM YOU SIMPLY CALL, EMAIL OR VISIT US
	  </div>
	  <div id="address">
	  <br>
        <p>Pusat Kegiatan Mahasiswa UI, Jl. Prof. Dr. Fuad Hassan 16425,</p>
        <p>Depok, Jawa Barat</p>
	  </div>
    </div>

    <div id="yellowLine">
      <div class="row">
        <div class="col-sm-6">
          <p> Phone : +62 877 93462282 (Via) </p>
        </div>
        <div class="col-sm-6" id="ratakanan">
          <p> Email : indonesia.kridabudaya@gmail.com </p>
        </div>
      </div>
    </div>
    
    @if(isset($responseen))
   	 {{$responseen}}
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Success!</strong> {{ strcmp($lang,'en') == 0 ? $responseen : $responseid }}
	</div>   	
    @endif
    <form action="{{ url('upload_comment') }}" method="post">
    <div id="formcomment">
      <div class="row">
        <div class="col-sm-6 formbox">
          <table style="width:100%">
            <tr>
              <td style="width:40px">
                <span class="glyphicon glyphicon-user"> </span>
              </td>
              <td>
                <input type="text" name="name" class="commentinput" placeholder="Name"> </input>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-sm-6 formbox ">
          <table style="width:100%">
            <tr>
              <td style="width:40px">
                <span class="glyphicon glyphicon-envelope"> </span>
              </td>
              <td>
                <input type="email" name="email" class="commentinput" placeholder="Email"> </input>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 onelinedform">
          <table style="width:100%">
            <tr>
              <td style="width:40px">
                <span class="glyphicon glyphicon-globe"> </span>
              </td>
              <td>
                <input type="text" name="website" class="commentinput" placeholder="Website"> </input>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 onelinedform">
          <textarea class="commentinput" name="content" rows="5" id="comment" placeholder="Comments"></textarea>
        </div>
      </div>
      <button class="btn btn-default" id="submitButton">SEND</button>
    </div>
    </form>
  </div>
@endsection