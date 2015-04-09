$(document).ready(function() {
	
	$('#orderBy').change(function(e) {
		var val = $(this).val();

		if ( val != 0)
		{
			$('#formOrderBy').submit();
		}
	});
});