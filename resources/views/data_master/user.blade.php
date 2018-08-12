@extends('layout.app')

@section('menu_active')
    @php($active = 'Data Master')
@endsection

@section('style')
<link href="{{ url('public/coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript">

    $( document ).ready(function() {
        $('.number').keyup(function(data) {
            formatNumber(this.id);
        });
    });
    
    function formatNumber(id) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;

        // format number
        $("#"+id).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
    }
    var jabatan = "{{ Session::get('jabatan') }}";
    $('.alert').hide();$('#alert-update').hide(); 
    $('#example').DataTable( {
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "sDom": 'tipr', 
        "ajax": {
            "url" : "{{ url('user/show') }}",
            "type" : "POST",
            "beforeSend": function (request) {
                request.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
            }
        },
        "columns": [
            { "data" : "nik" },
            { "data" : "name",
              render : function(data){
                return data.toUpperCase();
              }
            },
            { "data" : "jabatan",
              render : function(data){
                return data.toUpperCase();
              }
            },
            { "data": "email",
              render : function(data){
                return data.toUpperCase();
              }
            },
            { "data": "username",
              render : function(data){
                return data.toUpperCase();
              }
            },
            { "data": "nik" , 
               render: function ( data, type, row ) {
                var del = '<button title="Delete" class="btn btn-sm btn-danger" style="margin:0px 2px 2px 0px" onclick="del(`'+data+'`)"> <i class="fa fa-trash"></i></button>';

                var edit = '<button title="Edit" class="btn btn-sm btn-success" data-toggle="modal" href="#modal-edit" style="margin:0px 2px 2px 0px" onclick="edit(`'+data+'`)"> <i class="fa fa-pencil"></i></button>';

                var user_access = '<button title="User Access" class="btn btn-sm btn-warning" data-toggle="modal" href="#modal-user_accecc" style="margin:0px 2px 2px 0px" onclick="access(`'+row.nik+'`,`'+row.name+'`)"> <i class="fa fa-wrench"></i></button>';

                var tunjangan = '<button title="Tunjangan" class="btn btn-sm btn-success" data-toggle="modal" href="#modal-tunjangan" style="margin:0px 2px 2px 0px" onclick="tunjangan(`'+row.nik+'`,`'+row.name+'`)"> <i class="fa fa-usd"></i></button>';

                if(jabatan.toUpperCase() === 'KEUANGAN'){
                    return tunjangan;
                }else{
                    return del+edit+user_access;
                }
                
              }
            }
        ]
    });

    var oTable = $('#example').DataTable();    
    $('#cari').keypress(function(e) {
        if(e.which == 13) {
            oTable.search( $(this).val() ).draw();
        }
    });
    function del(nik) {
        var r = confirm("are you sure to delete ? ");
        if (r == true) {
            $.ajax({
                url: '{{ url('user/delete') }}',
                type: 'delete',
                data: {"nik" : nik},
                headers: {
                    "X-CSRF-Token" : "{{csrf_token()}}"
                },
                dataType: 'json',
                success: function (data) {
                    if(data.msg){
                        oTable.ajax.reload();
                    }
                }
            });
        }
    }
    function edit(nik) {
        $.ajax({
            url: '{{ url('user/get/') }}/'+nik,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#nik').val(data[0].nik);
                $('#nik_hide').val(data[0].nik);
                $('#name').val(data[0].name);
                $('#jabatan').val(data[0].jabatan);
                $('#email').val(data[0].email);
                $('#pk').val(data[0].pk);
            }
        });
    }
    function save() {
        var form = $('#form').serializeArray();
        $.ajax({
            url: '{{ url('user/save') }}',
            type: 'post',
            data: form,
            headers: {
                "X-CSRF-Token" : "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {
                console.info(data);
                $('.alert').show();
                if(data.msg == "success"){
                    $('.alert').hide();
                    $('#form')[0].reset();
                    $('.modal').modal('hide');
                    oTable.ajax.reload();
                    
                }else{
                    $('#alert-content').html(data.msg);
                }
                
            }
        });
    }
    function update() {
        var form = $('#form-update').serializeArray();
        $.ajax({
            url: '{{ url('user/update') }}',
            type: 'post',
            data: form,
            headers: {
                "X-CSRF-Token" : "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {
                console.info(data);
                $('#alert-update').show();
                if(data.msg == "success"){
                    $('#alert-update').hide();
                    $('#form')[0].reset();
                    $('.modal').modal('hide');
                    oTable.ajax.reload();
                    
                }else{
                    $('#alert-update #alert-content').html(data.msg);
                }
                
            }
        });
    }
    function update_access() {
        var form = $('#form_user_access').serializeArray();
        $.ajax({
            url: '{{ url('user/update_useraccess') }}',
            type: 'post',
            data: form,
            headers: {
                "X-CSRF-Token" : "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {
                if(data[0]){
                    alert(data[0]);
                    $('#modal-user_accecc').modal('hide');
                }
            }
        });
    }
    function access(nik,name) {
        $('#access-name').html(name);
        $.get('{{url('user/menu')}}/'+nik,function(data) {
            $('#form_user_access').html(data);
        });
    }
    function tunjangan(nik,name) {
        $('#tunj-nik').html(nik);
        $('#tunj-name').html(name);
        $('#tujangan_nik').val(nik);
        $('#form-tunjangan')[0].reset();

        $.ajax({
            url: '{{ url('user/tunjangan') }}',
            type: 'post',
            data: {'nik' : nik},
            headers: {
                "X-CSRF-Token" : "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {
                $('#basic').val(data[0].basic);
                $('#bpjs').val(data[0].bpjs);
                $('#jamsostek').val(data[0].jamsostek);
                $('#uang_makan').val(data[0].uang_makan);
                $('#uang_transport').val(data[0].uang_transport);
                formatNumber('basic');
                formatNumber('bpjs');
                formatNumber('jamsostek');
                formatNumber('uang_makan');
                formatNumber('uang_transport');

            }
        });

    }
    function addTunjangan() {
        var form = $('#form-tunjangan').serializeArray();
        $.ajax({
            url: '{{ url('user/addtunjangan') }}',
            type: 'post',
            data: form,
            headers: {
                "X-CSRF-Token" : "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {
                $('.alert').show();
                if(data.msg == "success"){
                    $('.alert').hide();
                    $('#form')[0].reset();
                    $('.modal').modal('hide');
                    oTable.ajax.reload();
                    
                }else{
                    $('#alert-tunjangan #alert-content').html(data.msg);
                }
                
            }
        });
    }
</script>
@endsection

@section('content')


  <div class="animated fadeIn">
    
        <div class="card">
          <div class="card-header">
            <i class="fa fa-users"></i> KARYAWAN
          </div>
          <div class="card-body">
         {{--    <input type="text" name="cari" class="form-control col-md-9" id="cari" placeholder="Search Data">
            <a class="btn btn-md btn-primary " data-toggle="modal" href='#modal-id'>
                <i class="fa fa-plus"></i> Add
            </a> --}}

            <div class="form-horizontal">
              <div class="form-group row">
                {{-- <label class="col-md-3 col-form-label" for="hf-email">Email</label> --}}
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
          </div>
        </div>

  </div>


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
