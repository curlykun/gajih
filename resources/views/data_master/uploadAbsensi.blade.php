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
<script type="text/javascript">
$(document).ready(function() {
	$('.alert-unggah').hide();
    $("#upload").change(function(){
      $('.custom-file-label').html(this.value.split("\\").pop());
    })
});
</script>
@endsection

@section('content')
<div class="animated fadeIn">
    
    <div class="card">
      <div class="card-header">
        <i class="fa fa-address-card-o"></i> ABSENSI KARYAWAN
      </div>
      <div class="card-body">

        <div class="form-inline">
        	<button type="submit" class="btn btn-primary mb-2" data-toggle="modal" href='#modal-id'><i class="fa fa-upload"></i> UNGGAH DATA</button>
		  	
		  	<div class="input-group mx-sm-3 mb-2">
		    	<input type="text" class="form-control " data-provide="datepicker" data-date-autoclose="true">
				<div class="input-group-append">
					<button class="btn btn-outline-primary" type="button"><i class="fa fa-search"></i></button>
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
                    <h4 class="modal-title">UNGGAH DATA</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" id="form">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="upload" accept=".xlsx">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </form>

                    <div class="alert alert-info alert-unggah">
                        <button type="button" class="close" onclick="$('.alert').hide();">&times;</button>
                        <span id="alert-content">asdas</span>
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
@endsection