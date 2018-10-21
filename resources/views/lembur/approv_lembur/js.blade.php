{{-- custom javasvript untuk view Buat SPL --}}
<script type="text/javascript">
	$(document).ready(function() {
	    $('#table').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "sDom": 'tipr', 
            "ajax": '{{ Route("ApprovLembur.show") }}',
            "columns": [
                {"data": 'nik', "name": 'nik'},
                { "data" : "nik",
                    render : function(data, type, row, meta){                        
                        return row.user.name.toUpperCase();
                    }
                },
                {"data": 'tanggal', "name": 'tanggal'},
                {"data": 'masuk', "name": 'masuk'},
                {"data": 'keluar', "name": 'keluar'},
                {"data": 'approv', "name": 'approv'}
            ]
        });
	});
</script>