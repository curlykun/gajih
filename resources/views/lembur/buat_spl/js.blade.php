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

        var html;
        var init = $('div#init');
		$('#tanggal').data("DateTimePicker").minDate( moment().format('YYYY-MM-DD') );
        $("#tanggal").on("dp.change", function (e) {			
			
            $('#txt_tanggal').html($("#tanggal").val());
            $('div#init').find('[name=tanggal]').remove();
            for (let index = 0; index < init.length; index++) {
                // const element = array[index];
                var html = '<input type="hidden" value="'+$(this).val()+'" name="tanggal"/>';
                var div = $('div#init')[index];                
                div.innerHTML = div.innerHTML+html;
            }
            
        });

        $("#masuk").on("dp.change", function (e) {
            $('#keluar').data("DateTimePicker").minDate( moment(e.date).hour(7).minute(0).second(0)  );
            $('#keluar').data("DateTimePicker").maxDate( moment(e.date).hour(24).minute(0).second(0) );
            $('#txt_masuk').html($(this).val());
            $('#masuk_val').html($(this).val());
            $('div#init').find('[name=masuk]').remove();
            for (let index = 0; index < init.length; index++) {
                // const element = array[index];
                var html = '<input type="hidden" value="'+$(this).val()+'" name="masuk"/>';
                var div = $('div#init')[index];                
                div.innerHTML = div.innerHTML+html;
            }
        });
        $("#keluar").on("dp.change", function (e) {
            $('#txt_keluar').html($(this).val());
            $('#keluar_val').html($(this).val());
            $('div#init').find('[name=keluar]').remove();
            for (let index = 0; index < init.length; index++) {
                // const element = array[index];
                var html = '<input type="hidden" value="'+$(this).val()+'" name="keluar"/>';
                var div = $('div#init')[index];                
                div.innerHTML = div.innerHTML+html;
            }
        });
	}
</script>