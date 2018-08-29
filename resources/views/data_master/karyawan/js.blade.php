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