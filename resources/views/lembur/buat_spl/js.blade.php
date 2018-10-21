{{-- custom javasvript untuk view Buat SPL --}}
<script type="text/javascript">
	$(document).ready(function() {
	   
	});
	function date() {
		$('#tanggal').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
            inline: false,
            keepOpen : true,
            useCurrent: false,
            keepOpen: false,
            
        });
        $('#masuk').datetimepicker({
            locale: 'id',
            format: 'HH:mm:00',
            inline: false,
            keepOpen : true,
            useCurrent: false,
            keepOpen: false,
            
        });
        $('#keluar').datetimepicker({
            locale: 'id',
            format: 'HH:mm:00',
            inline: false,
            keepOpen : true,
            useCurrent: false,
            keepOpen: false,

        });		
		$('#tanggal').data("DateTimePicker").minDate( moment().format('YYYY-MM-DD') );

        $("#tanggal").on("dp.change", function (e) {			
			
			// $('#masuk').data("DateTimePicker").maxDate( 
			// 	moment(e.date).format('13:59:00')
			// );
			// $('#masuk').data("DateTimePicker").minDate( 
			// 	moment(e.date).format('07:00:00')
			// );
            $('#txt_tanggal').html($("#tanggal").val());
        });

        $("#masuk").on("dp.change", function (e) {
            $('#keluar').data("DateTimePicker").minDate( moment(e.date).hour(7).minute(0).second(0)  );
            $('#keluar').data("DateTimePicker").maxDate( moment(e.date).hour(24).minute(0).second(0) );
            $('#txt_masuk').html($(this).val());
        });
        $("#keluar").on("dp.change", function (e) {
            $('#txt_keluar').html($(this).val());
        });
	}
</script>