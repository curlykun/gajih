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
    <title>SISTEM PENGGAJIAN PT.NUTRINDO BOGARASA</title>
    <!-- Icons-->
    <link href="{{ url('coreui/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ url('coreui/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ url('coreui/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('coreui/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ url('coreui/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('coreui/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    @yield('style')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ url('coreui/img/brand/logo.jpg') }}" width="135" alt="CoreUI Logo">
        {{-- <img class="navbar-brand-minimized" src="{{ url('coreui/img/brand/sygnet.svg') }}" width="30" height="30" alt="CoreUI Logo"> --}}
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <h4 >PT. NUTRINDO BOGARASA</h4>
      </ul>
      
      <ul class="nav navbar-nav ml-auto">
        <a href="{{ url('/logout') }}" class="navbar-toggler" style="margin-right: 10px">
          <span class="fa fa-sign-out"></span> Keluar
        </a>
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          @yield('menu_active')
          <ul class="nav">

            <li class="nav-item">
              <a class="nav-link {{ $active ==''?'active':'' }} text-danger" href="{{url('/')}}">
                <i class="nav-icon icon-speedometer text-danger"></i> Dashboard
              </a>
            </li>


            <li class="nav-title">Menu</li>
            @foreach ($data_group as $group)
              @if($group->count > 0)
                <li class="nav-item nav-dropdown ">
                  <a class="nav-link nav-dropdown-toggle text-danger" href="#">
                    <i class="nav-icon {{$group->icon}} text-danger"></i>
                    {{$group->group}}
                  </a>

                  <ul class="nav-dropdown-items">
                    @foreach ($data_menu as $menu)
                      @if($menu->node_group == $group->node_group)
                        <li class="nav-item">
                          <a class="nav-link" href="{{ url($menu->link) }}">
                            <i class="{{$menu->icon}}"></i>
                            {{$menu->menu}}
                          </a>
                        </li>
                      @endif
                    @endforeach
                  </ul>

                </li>
              @endif
            @endforeach
          </ul>
          
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><strong>Wellcome</strong> {{ session()->get('name') }} ( {{ session()->get('jabatan') }} )</li>
        </ol>
        
        <div class="container-fluid">
          @yield('content')
        </div>

      </main>
    </div>
    <footer class="app-footer">
      <div>
        <a href="https://coreui.io">CoreUI</a>
        <span>&copy; 2018 creativeLabs.</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
      </div>
    </footer>
    <!-- Bootstrap and necessary plugins-->
    <script src="{{ url('coreui/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ url('coreui/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ url('coreui/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('coreui/vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ url('coreui/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('coreui/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>
    <!-- momenjs untuk format tanggal dan jam-->
    <script src="{{ url('coreui/vendors/momenjs/momen.js') }}"></script>
    @yield('script')
  </body>
</html>