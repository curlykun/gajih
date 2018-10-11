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
        <form action="">
            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" required>
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
        </form> 
        <div class="form-group row">
    
            <div class="col-sm-6">
                <h5>Daftar Karyawan</h5>
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>JABATAN</th>
                            <th>ASKI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_karyawan as $key => $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        Pilih
                                        <span class="fa fa-arrow-right"></span>
                                    </button>
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
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>ASKI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_karyawan as $key => $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        Pilih
                                        <span class="fa fa-arrow-right"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $data_karyawan->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>    
    @endcomponent
@endsection
