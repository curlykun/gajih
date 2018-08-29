@extends('layout.app')

@section('menu_active')
    @php($active = 'Data Master')
@endsection

@section('style')
<link href="{{ url('public/coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<link href="{{ url('public/coreui/vendors/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ url('public/coreui/vendors/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
@include('data_master.upload.js')
@endsection

@section('content')
    {!! $errors->first('file','<div class="alert alert-warning">:message</div>') !!}

    @component('component.card')
        @slot('title')
            <i class="fa fa-address-card-o"></i> ABSENSI KARYAWAN
        @endslot
        <div class="form-inline">
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal" href='#modal_upload'><i class="fa fa-upload"></i> UNGGAH DATA</button>
            
            <div class="input-group mx-sm-3 mb-2">
                <input type="text" class="form-control border border-primary" data-provide="datepicker" data-date-autoclose="true" placeholder="Cari Data">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <table id="example" class="table table-responsive-sm table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th width="10%">NIK</th>
                        <th width="20%">NAMA</th>
                        <th width="20%">POSISI</th>
                        <th width="20%">E-MAIL</th>
                        <th width="15%">USER NAME</th>
                        <th width="15%">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
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