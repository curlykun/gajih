<script type="text/javascript">
	$(document).ready(function() {
		$('#alert_unggah').alert('close');
	    $("#upload").change(function(){
	      $('.custom-file-label').html(this.value.split("\\").pop());
	    })
	});
	function save() {
		alert();
	}
</script>