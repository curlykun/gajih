@extends('layout.app')

@section('menu_active')
    @php($active = 'Data Master')
@endsection

@section('style')
<link href="{{ url('coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<link href="{{ url('coreui/vendors/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ url('coreui/vendors/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
@include('data_master.upload.js')
@endsection

@section('content')
    {!! $errors->first('file','<div class="alert alert-warning">:message</div>') !!}
    {!! $errors->first('error','<div class="alert alert-danger">:message</div>') !!}


    @component('component.card')
        @slot('title')
            <i class="fa fa-cloud-upload"></i> ABSENSI KARYAWAN
        @endslot

        <div class="form-inline">
            <button type="submit" class="btn btn-outline-primary mb-2" data-toggle="modal" href='#modal_upload'><i class="fa fa-upload"></i> UNGGAH DATA</button>
            
            <div class="input-group mx-sm-3 mb-2">
                {{-- <input type="text" class="form-control border border-primary" data-provide="datepicker" data-date-autoclose="true" placeholder="Cari Data"> --}}
                <select class="form-control btn-outline-success" id="tahun" style="width: 150px" data-toggle="tooltip" data-placement="top" title="Pilih Tahun">
                    <option value="">Pilih Tahun</option>
                    @foreach($tahun as $key => $value )
                        <option value="{{ $value->year }}">{{ $value->year }}</option>
                    @endforeach
                </select>
                <select class="form-control btn-outline-success" id="bulan" style="width: 150px" data-toggle="tooltip" data-placement="top" title="Pilih Bulan">
                    <option value="">Pilih Bulan</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="button" onclick="data( $('#tahun').val(),$('#bulan').val() )"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <table id="upload-table" class="table table-responsive-lg table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>TANGGAL</th>
                    <th>MASUK</th>
                    <th>KELUAR</th>
                </tr>
            </thead>
        </table>
    @endcomponent

    {{ Form::open(['url'=>'/upload_absensi/upload','method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
    @component('component.modal-primary',['id'=>'modal_upload','title'=>'UNGGAH DATA'])
        <div class="custom-file">
            {{ Form::file('file',['class'=>'custom-file-input','id'=>'upload','accept'=>'.xlsx','required'=>'false']) }}
            {{ Form::label('upload','Pilih File', ['class'=>'custom-file-label']) }}
        </div>
        @component('component.alert-info',['id'=>'alert_unggah','class'=>'mt-2'])
            asdas
        @endcomponent
        @slot('footer')
            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
            <input type="submit" class="btn btn-primary" value="Simpan">
        @endslot
    @endcomponent
    {{ Form::close() }}
@endsection