@extends('layout.app')
@section('menu_active')
    @php($active = '')
@endsection
@section('content')
  <div class="card bg-default m-auto d-md-down-none" style="width: 50%">
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
@endsection