@extends('layout.app')

@section('menu_active')
    @php($active = 'Lembur')
@endsection

@section('style')
<link href="{{ url('coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
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
            <i class="fa fa-calendar-check-o"></i> APPROV KARYAWAN
        @endslot
        <div class="form-inline">
            <button type="submit" class="btn btn-outline-primary mb-2" onclick="date()" data-backdrop="static" data-toggle="modal" href='#modal_upload'><i class="fa fa-clock-o"></i> INPUT DATA LEMBUR</button>
        </div>        
    @endcomponent
@endsection