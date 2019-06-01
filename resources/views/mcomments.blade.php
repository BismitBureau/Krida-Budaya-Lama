@extends('layout.master')

@section('styling')
  <link rel="stylesheet" href="{{ url('style/mindex.css') }}">
  <link rel="stylesheet" href="{{ url('style/mcomments.css') }}">
@endsection


@section('content')
  <div class="topBorder"></div> 
  
  <div id="content">
    <div id="bigWords">
      <p> WE WOULD BE HAPPY TO HEAR FROM YOU SIMPLY CALL, EMAIL OR VISIT US </p>
    </div>
    <div id="address">
      <p>BALAI MAHASISWA KAMPUS UI SALEMBA JL.SALEMBA RAYA NO.04</p>
      <p>CENTRAL JAKARTA - 10430 - INDONESIA</p>
    </div>

    <div id="yellowLine">
      <div class="row">
          <p> phone : +62-8569-3669-864 (marketing)</p>
		  <p> email : kridabudaya@gmail.com </p>
      </div>
    </div>
	
    <div id="formcomment">
	
      <div class="row">
      <form action="{{ url('upload_comment') }}" method="post">
		<div class="formbox">
          <table style="width:100%">
            <tr>
              <td style="width:40px">
                <span class="glyphicon glyphicon-user"></span>
              </td>
              <td>
                <input type="text" name="name" class="commentinput" placeholder="Name"> </input>
              </td>
            </tr>
          </table>
        </div>
	  </div>
	  
	  <div class="space"></div>
	
	  <div class="row">
        <div class="formbox">
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
	  
	  <div class="space"></div>
	  
      <div class="row">
        <div class="formbox">
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
	  
	  <div class="space"></div>
	  
      <div class="row">
        <div class="onelinedform">
          <textarea class="commentinput" name="content" rows="5" id="comment" placeholder="Comments"></textarea>
        </div>
      </div>
	  
      <button class="btn btn-default" id="submitButton">SEND</button>

    </div>
  </div>
@endsection