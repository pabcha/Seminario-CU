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

	$('span.precio-dropdown > i').click(function(){
		// alert( $(this).attr('id') );
		if ( confirm('¿Esta seguro de que desea quitar este producto?') ) {
			location.href="http://localhost/saltaShop/index/"+$(this).attr('id');
		}
	});

});