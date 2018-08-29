@extends('layout.app')

@section('menu_active')
    @php($active = 'Data Master')
@endsection

@section('style')
    <link href="{{ url('public/coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
@endsection

@section('script')
    <script type="text/javascript" 
        src="{{ url('public/coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" 
        src="{{ url('public/coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
    @include('data_master.karyawan.js')
@endsection

@section('content')
    @component('component.card')
        @slot('title')
            <i class="fa fa-users"></i> KARYAWAN
        @endslot

        <div class="form-horizontal">
          <div class="form-group row">
            <a class="btn btn-md btn-primary" data-toggle="modal" href='#modal-id' style="margin: 3px 3px 3px 17px">
                <i class="fa fa-plus"></i> TAMBAH DATA
            </a>
            <div class="col-md-9" style="margin: 3px 3px 3px 0px">
              <input type="text" name="cari" class="form-control col-md-9" id="cari" placeholder="Cari Data">
            </div>
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
    @endcomponent

    <section>
        <div class="modal fade" id="modal-id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal" id="form">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">NIK</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">NAME</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">POSITION</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="jabatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">E-MAIL</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </form>

                        <div class="alert alert-info">
                            <button type="button" class="close" onclick="$('.alert').hide();">&times;</button>
                            <span id="alert-content"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save();">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <section>
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-success" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal" id="form-update" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">NIK</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nik" id="nik">
                                    <input type="hidden" class="form-control" name="nik_hide" id="nik_hide">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">NAME</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">POSITION</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="jabatan" id="jabatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">E-MAIL</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                        </form>
                        <div class="alert alert-info" id="alert-update">
                            <button type="button" class="close" onclick="$('.alert').hide();">&times;</button>
                            <span id="alert-content"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="update();">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>

    <section>
        <div class="modal fade" id="modal-user_accecc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-warning" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Access | <span id="access-name"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_user_access"></form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="update_access();">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>

    <section>
        <div class="modal fade" id="modal-tunjangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-success" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">TUNJANGAN <span id="tunj-nik"></span> <span id="tunj-name"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal" id="form-tunjangan" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">BASIC</label>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control number text-right" name="tujangan_nik" id="tujangan_nik">
                                    <input type="text" class="form-control number text-right" name="basic" id="basic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">BPJS</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control number text-right" name="bpjs" id="bpjs">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">JAMSOSTEK</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control number text-right" name="jamsostek" id="jamsostek">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">UANG MAKAN</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control number text-right" name="uang_makan" id="uang_makan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">UANG TRANSPORT</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control number text-right" name="uang_transport" id="uang_transport">
                                </div>
                            </div>
                        </form>
                        <div class="alert alert-info" id="alert-tunjangan">
                            <button type="button" class="close" onclick="$('.alert').hide();">&times;</button>
                            <span id="alert-content"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addTunjangan();">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>

@endsection
