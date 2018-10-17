@extends('layout.app')

@section('menu_active')
    @php($active = 'Lembur')
@endsection

@section('style')
<link href="{{ url('coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<link href="{{ url('coreui/vendors/bootstrap4-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ url('coreui/vendors/bootstrap4-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
@include('lembur.buat_spl.js')
<script>
    date();
</script>
@endsection


@section('content')
@if ($errors->any())
    <div class="alert alert-info">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ strtoupper($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
@component('component.card')
        @slot('title')
            <i class="fa fa-calendar-check-o"></i> BUAT SURAT PERINTAH LEMBUR
        @endslot
        <form action="{{ route('BuatSpl.store') }}" method="POST">
            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" required>
                    <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        
            <div class="form-group row">
                <label for="masuk" class="col-sm-2 col-form-label">Jam Masuk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="masuk" name="masuk" autocomplete="off" required>
                </div>
            </div>
        
            <div class="form-group row">
                <label for="keluar" class="col-sm-2 col-form-label">Jam Keluar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="keluar" name="keluar" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="simpan" class="col-sm-2 col-form-label">SIMPAN</label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa fa-save"></i>
                    </button>
                </div>
            </div>
        </form> 
        <div class="form-group row">
            <div class="col-sm-6">
                <h5>Daftar Karyawan</h5>
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword1" class="form-control border border-dark" placeholder="Cari Data" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit">Button</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>JABATAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_karyawan as $key => $item)
                        <tr>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>
                                <form action="{{ route('BuatSpl.PilihKaryawan') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="nik" value="{{ $item->nik }}">
                                    <button class="btn btn-sm btn-dark" type="submit">
                                        Pilih
                                        <span class="fa fa-arrow-right"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $data_karyawan->links('vendor.pagination.bootstrap-4') }}
                </div>
                
            </div>
            
            <div class="col-sm-6">
                <h5>Daftar Karyawan untuk Lembur</h5>
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword2" class="form-control border border-dark" placeholder="Cari Data" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit">Button</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>AKSI</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>JABATAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pilih_karyawan as $key => $item)
                            <tr>
                                <td>
                                    <form action="{{ route('BuatSpl.BatalKaryawan') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="nik" value="{{ $item->nik }}">
                                        <button class="btn btn-sm btn-dark" type="submit">
                                            <span class="fa fa-arrow-left"></span>
                                            Batal
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->user()->first()->name }}</td>
                                <td>{{ $item->user()->first()->jabatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $data_pilih_karyawan->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>    
    @endcomponent
@endsection
