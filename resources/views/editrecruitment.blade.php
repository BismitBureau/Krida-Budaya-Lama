<!DOCTYPE html>
<html>
  <head>
    <title> Krida Budaya | Liga Tari Mahasiswa Universitas Indonesia </title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="{{ url('style/master.css') }}"> --> @yield('styling')
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ url('javascript/myScript.js') }}"></script>
    <script src="{{ url('javascript/dropzone.js') }}"></script>
    <style>
    .jumbotron {
    position: relative;
    background: #000 url("http://kridabudaya.com/images/slides/slide_492096b084c229f60532cd6d84e549658bbb077f.jpg") center center;
    width: 100%;
    height: 400px;
    background-size: cover;
    overflow: hidden;
    }

    .dz-max-files-reached {background-color: red};

    .foto {
        width: 200px;
        height: 300px;
    }


    </style>
  </head>
  <body>
<header class="with-img relative">
<div class="jumbotron">
    <div class="container">
        @if (isset($_SESSION['recruitmentStatus']) && $_SESSION['recruitmentStatus'] == true)
          <div class="alert alert-success">
              {{ "successfully saved" }}
          </div>
          <?php $_SESSION['recruitmentStatus'] = false; ?>
        @endif
    </div>
</div>
        </header>
<div class="single-content">
            <div class="container">
                <section class="join-form relative">

                    <div class="row">
                        <div class="col-md-4 abs img-wrapper">
                                <img class="img img-responsive" src="http://kridabudaya.com/images/form.jpg">
                        </div>
                        <div class="col-md-8 form">
                            <h3 class="section-title">Formulir Pendaftaran Online Krida Budaya</h3>
                            <div class="line"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    @if(strlen($recruitment['imageURL']) > 5)
                                    <img class="img-responsive foto" src="{{url($recruitment['imageURL'])}}">
                                    @else
                                     No Image Uploaded.
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <form action="{{ url('admin/upload_image/recruitment/'.$recruitment['id']) }}" method="post" enctype="multipart/form-data">
                                        Select image to upload:
                                        <input type="file" name="file" id="file">
                                        <input type="submit" value="Upload Image" name="submit">
                                    </form>
                                </div>
                            </div>

                            <form id="joinForm" action="{{url('/recruitment/'.$recruitment->id)}}" method="POST">
                                <input type="hidden" name="source" value="google">
                                <div class="row">
                                    <div class="col-md-6 form-group ">
                                        <label for="firstname">Nama Lengkap</label>
                                        <input class="form-control" aria-describedby="firstname" name="name" type="text" id="firstname" value="{{$recruitment->name}}" required>
                                    </div>
                                    <div class="col-md-6 form-group ">
                                        <label for="phone">Nomor Telpon</label>
                                        <div class="input-group col-md-12">
                                            <!-- <span class="input-group-addon">+62</span> -->
                                            <input class="form-control" aria-describedby="phone" name="nomor" type="text" value="{{$recruitment->nomor}}" id="phone" required>
                                            <small>Masukkan 1 (satu) nomor saja tanpa spasi/tanda baca.<br>Contoh: 081234567890</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="ttl">Tempat & Tanggal Lahir</label>
                                        <div class="input-group col-md-12">
                                            <!-- <span class="input-group-addon">+62</span> -->
                                            <input class="form-control" aria-describedby="ttl" name="ttl" value="{{$recruitment->ttl}}" type="text" id="ttl">
                                            <small>Format: [Tempat], [Tanggal Lahir].<br>Contoh: Jakarta, 10 Januari 2000 </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="email">Email</label>
                                        <input class="form-control" aria-describedby="email" value="{{$recruitment->email}}" name="email" type="email" id="email" required>
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="fj">Fakultas & Jurusan </label>
                                        <input class="form-control" aria-describedby="fj" name="fj" type="text" id="fj" value="{{$recruitment->fj}}" required>
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="angkatan">Angkatan </label>
                                        <input class="form-control" aria-describedby="angkatan" name="angkatan" type="text" id="angkatan" value="{{$recruitment->angkatan}}" required>
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="alamat"> Alamat </label>
                                        <input class="form-control" aria-describedby="alamat" name="alamat" type="text" id="alamat" value="{{$recruitment->alamat}}">
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="Twitter"> Twitter </label>
                                        <input class="form-control" aria-describedby="Twitter" name="Twitter" type="text" id="Twitter" value="{{$recruitment->Twitter}}">
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="Facebook"> Facebook </label>
                                        <input class="form-control" aria-describedby="Facebook" name="Facebook" type="text" id="Facebook" value="{{$recruitment->Facebook}}">
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="Instagram"> Instagram </label>
                                        <input class="form-control" aria-describedby="Instagram" name="Instagram" type="text" id="Instagram" value="{{$recruitment->Instagram}}">
                                    </div>

                                    <div class="col-md-6 form-group ">
                                        <label for="Line"> Line </label>
                                        <input class="form-control" aria-describedby="Line" name="Line" type="text" id="Line" value="{{$recruitment->Line}}">
                                    </div>

                                    <div class="col-md-12 form-group ">
                                        <label for="prestasi"> Pengalaman / Prestasi </label>
                                        <textarea class="form-control" name="prestasi" rows="3" placeholder="Enter ...">{!!$recruitment->prestasi!!}</textarea>
                                    </div>

                                    <div class="col-md-12 form-group ">
                                        <label for="seni"> Seni </label>
                                        <textarea class="form-control" name="seni" rows="3" placeholder="Enter ...">{!!$recruitment->seni!!}</textarea>
                                    </div>

                                    <div class="col-md-12 form-group ">
                                        <label for="seni"> Mengapa Krida Budaya? </label>
                                        <textarea class="form-control" name="alasan" rows="3" placeholder="Enter ...">{!!$recruitment->alasan!!}</textarea>
                                        <small> contoh: Suka menari dan main musik </small>
                                    </div>



                                </div>
                                <input class="btn btn-primary btn-block" id="joinSubmitBtn" type="submit" value="Simpan Perubahan">
                            </form>
                            <div class="disclaimers">
                                <p><strong>Syarat dan Ketentuan:</strong></p>
                                <ul>
                                    <!-- <li>Hanya untuk daerah Jakarta</li> -->
                                    <li>Mahasiswa Aktif Universitas Indonesia</li>
                                    <li>Mengisi Form Selengkap-lengkapnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
  </body>
</html>
