$(document).ready(function() {
	$('#sSubmit').click(function (e) {
		e.preventDefault();

		var min = $('#min').val(),
			max = $('#max').val();

		if (min == '' || max == '')
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

	$('#search_showmore').click(function (e) {
		$('#moresearch_criteria').toggle('slow');
		$('#search_showmore > p').toggle();
	});
});