
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.0.0
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>MASUK | SISTEM PENGGAJIAN PT.NUTRINDO BOGARASA</title>
    <!-- Icons-->
    <link href="{{ url('public/coreui/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/coreui/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/coreui/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/coreui/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ url('public/coreui/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('public/coreui/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">

  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4 bg-danger">
              <div class="card-body">
                <h1>Masuk</h1>
                <p class="text-white">Masuk ke akun Anda</p>
                <form action="{{ url('cekuser') }}" method="POST">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4">Masuk</button>
                  </div>
                  <div class="col-6 text-right">
                    {{-- <button type="button" class="btn btn-link px-0">Forgot password?</button> --}}
                  </div>
                </div>
                {{ csrf_field() }}
                </form>
              </div>
            </div>
            <div class="card bg-default py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <img class="navbar-brand-full" src="{{ url('public/coreui/img/brand/logo.jpg') }}" width="135" alt="CoreUI Logo" style="width:70%;margin-bottom: 5px">
                  <h4 style="margin-bottom: 15px">PT. NUTRINDO BOGARASA</h4>
                  <p>Menjadi produsen makanan dan minuman yang berkualitas
        					dan terpercaya di mata konsumen domestik maupun internasional
        					dan menguasai pasar-pasar terbesar dalam kategori produk
        					sejenis.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap and necessary plugins-->
    <script src="{{ url('public/coreui/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/coreui/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ url('public/coreui/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/coreui/vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ url('public/coreui/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('public/coreui/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>

  </body>
</html>