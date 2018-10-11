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
        <div class="form-inline">
            <a href="{{ url('/buat-spl/form-spl') }}" class="btn btn-outline-primary mb-2">
                <i class="fa fa-clock-o"></i> INPUT DATA SPL
            </a>
        </div>
        <table class="table table-responsive-sm table-hover" id="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>TANGGAL</th>
                    <th>MASUK</th>
                    <th>KELUAR</th>
                    <th>APPROV</th>
                </tr>
            </thead>
        </table>        
    @endcomponent
@endsection