{{-- custom javasvript untuk view uploadAbsensi --}}
<script type="text/javascript">
	$(document).ready(function() {
		moment.locale('id');
		$('[data-toggle="tooltip"]').tooltip();
		$('#alert_unggah').alert('close');

	    $("#upload").change(function(){
	      $('.custom-file-label').html(this.value.split("\\").pop());
	    });

	    data( moment().format('Y'), moment().format('MM') );

	    // alert(moment().format('MM') );

	});
	function save() {
		alert();
	}
	function data(tahun,bulan) {
		// alert(tahun+" - "+bulan);
		$('#upload-table').DataTable( {
			"bDestroy": true,
	        "responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "sDom": 'tipr',
	        "order": [ [ 1, 'asc' ] ],
	        "ajax": {
	            "url" : "{{ route('upload_absensi.data') }}",
	            "type" : "POST",
	            "data" : {'tahun' : tahun, 'bulan' : bulan },
	            "beforeSend": function (request) {
	                request.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
	            }
	        },
	        "columns": [
	        	{ "data" : "nik",
	              render : function(data, type, row, meta){
	                return (meta.row)+1;
	              }
	            },
	            { "data" : "nik"},
	          	{ "data" : "sys_user.name",
	            	render : function(data, type, row, meta){
	            	// console.log(data);
	                return data;
	              } 
	          	},
	            { "data" : "tanggal",
	            	render : function(data, type, row, meta){
	            		// console.log(data);
	                	return moment(data).format('l');
	            	}
	            },
	            { "data" : "masuk" },
	            { "data" : "keluar" },
	        ]
	    });
	}
</script>