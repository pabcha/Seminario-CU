$(document).ready(function() {
	
	$('#orderBy').change(function(e) {
		var val = $(this).val();
		$('#formOrderBy').submit();
	});
});