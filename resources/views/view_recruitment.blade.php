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
    <section class="content invoice">   
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Formulir Pendaftaran Liga Tari UI Krida Budaya
                    <small class="pull-right">Date: {{ $recruitment->date }}</small>
                </h2>                            
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <img src="{{ url($recruitment->imageURL) }}" class="img img-responsive" style="width:150px; height:225px">
            </div>
            <div class="col-sm-4 invoice-col">
                <b>NPM {{ $recruitment->npm }}</b><br>
                <b>Nama Lengkap:</b><br> {{ $recruitment->name }}<br>
                <b>Nama Orang Tua:</b><br> {{ $recruitment->orangtua }}<br>
                <b>Tempat & Tanggal Lahir:</b><br> {{ $recruitment->ttl }}<br>
                <b>Fakultas & Jurusan:</b><br> {{ $recruitment->fj }}<br>
                <b>Angkatan:</b><br> {{ $recruitment->angkatan }} <br>
                <b>Nomor Telepon: </b><br> {{ $recruitment->nomor }}

            </div>
            <div class="col-sm-4 invoice-col">
                <b>Alamat:</b>
                <address>
                    {{ $recruitment->alamat }}
                </address>
                <b> Email: </b><br> {{ $recruitment->email }} <br>
                <b> Twitter: </b><br> {{ $recruitment->Twitter }} <br>
                <b> Instagram: </b><br> {{ $recruitment->Instagram }} <br>
                <b> Facebook: </b><br> {{ $recruitment->Facebook }} <br>
                <b> Line: </b><br> {{ $recruitment->Line }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Pengalaman/Prestasi</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                        @foreach(preg_split("/\\r\\n|\\r|\\n/", $recruitment->prestasi) as $line)
                            <li>
                                {{ $line }}
                            </li>
                        @endforeach
                        <ul>
                    </div>
                </div>                         
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Seni</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                        @foreach(preg_split("/\\r\\n|\\r|\\n/", $recruitment->seni) as $line)
                            <li>
                                {{ $line }}
                            </li>
                        @endforeach
                        <ul>
                    </div>
                </div>                         
            </div>           
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Alasan</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            {!! nl2br($recruitment->alasan) !!}
                        </p>
                    </div>
                </div>                         
            </div>           
        </div>


        <div class="row no-print">
            <div class="col-xs-12">
                <b>Status Pendaftaran:</b> 
                @if($recruitment->status == 0)
                    <span class="label label-warning">Pending</span>
                @elseif($recruitment->status == 1)
                    <span class="label label-success">Approved</span>
                @else
                    <span class="label label-danger">Denied</span>
                @endif
            </div>
        </div>

        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button> 
                <a href="{{url('admin/dashboard/form/0/'.$recruitment->id)}}" class="btn btn-solid pull-right" style="margin-right: 5px;"> Hilangkan tanda </a>
                <a href="{{url('admin/dashboard/form/1/'.$recruitment->id)}}" class="btn btn-primary pull-right" style="margin-right: 5px;"> Tandai sebagai diterima </a>
                <a href="{{url('admin/dashboard/form/2/'.$recruitment->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;"> Tandai sebagai ditolak </a>
            </div>
        </div>
    </section>
@endsection
