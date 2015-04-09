$(document).ready(function() {
	
	$("form[name='formNewsletter']").submit(function(){
		$('#alerta').hide();
		var inputCorreo = $('#inputCorreoNews');
		var error       = '';
		
		error =	String(validar_correo(inputCorreo,true));	
	  	
		if( error != '' ) {
			$('.alert_info').html(error);
			$('#alerta').show();
			return false;
		} else {
			return true;
		}
	});

	$('#searchSubmit').click(function (e) {
		e.preventDefault();
		var q = $('#q'); 
		if ( q.val() != '' ) {
			q.closest('form').submit();
		} else {
			alert('Por favor, escriba una palabra.')
		}
	});

});