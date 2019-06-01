@extends('layout.admin')

@section('content')
	<section class="content-header">
        <h1>
            Dashboard
            <small> Recruitment </small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
	<section class="content">    
		<div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Filter & Control Panel Berkas </h3>
            </div>
            <form role="form">
                <div class="box-body">
                  	<div class="form-group">
	                    <label>Date range:</label>
	                    <div class="input-group">
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                        <input type="text" name="daterange" @if(isset($_GET['daterange'])) value="{{ $_GET['daterange'] }}" @endif class="form-control pull-right" id="reservation">
	                    </div>
	                </div>

                    <div class="form-group"> 
                        <label> Status Recruitment </label>
                        <div class="radio">
                            <label class="">
                                <div class="" aria-checked="{{ $data['recruitmentMode'] == 1 ? 'true' : 'false' }}" aria-disabled="false" style="position: relative;">
                                    <input type="radio" name="recruitmentMode" id="optionsRadios1" value="1" checked="" style="position: absolute; opacity: 0;" {{ $data['recruitmentMode'] == 1 ? 'checked' : ''}}><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                                Dibuka
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="" aria-checked="{{ $data['recruitmentMode'] == 0 ? 'true' : 'false' }}" aria-disabled="false" style="position: relative;">
                                    <input type="radio" name="recruitmentMode" id="optionsRadios2" value="0" style="position: absolute; opacity: 0;" {{ $data['recruitmentMode'] == 0 ? 'checked' : ''}}>
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                                Tutup
                            </label>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
            </form>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Berkas Pendaftar</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>NPM</th>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    @foreach($data['recruitments'] as $recruitment)
                    <tr>
                        <td>{{ $recruitment->id }}</td>
                        <td>{{ $recruitment->name }}</td>
                        <td>{{ $recruitment->date }}</td>
                        <td>
                            @if($recruitment->status == 0)
                                <span class="label label-warning">Pending</span>
                            @elseif($recruitment->status == 1)
                                <span class="label label-success">Approved</span>
                            @else
                                <span class="label label-danger">Denied</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/dashboard/viewform/'.$recruitment->id)}}"> lihat form </a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody></table>
            </div>
        </div>
        
    </section>

    <script type="text/javascript">
		$(function() {
		    $('input[name="daterange"]').daterangepicker();
		});
	</script>
@endsection
