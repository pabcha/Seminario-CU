$(document).ready(function() {
	$('#sSubmit').click(function (e) {
		e.preventDefault();

		var min = parseFloat($('#min').val()),
			max = parseFloat($('#max').val());

		if ($('#min').val() == '' || $('#max').val() == '')
		{
			alert('Complete los campos minimo/maximo.');
			return;
		}

		if (min >= max) {
			alert('El minimo debe ser menor al maximo.');
			return;
		};

		$(this).closest('form').submit();
	});
});