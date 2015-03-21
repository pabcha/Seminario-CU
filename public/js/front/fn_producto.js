$(document).ready(function() {

	$('.sumar').click(function (e) 
	{
		e.preventDefault();
		var id   = $(this).prev().attr('id'),
		valorAct = parseInt($('#'+id).val());		

		if (!isNaN(valorAct)) 
		{
			$('#'+id).val(valorAct + 1);
		} 
		else
		{
			$('#'+id).val(1);
		}
	});

	$('.restar').click(function(e){
		e.preventDefault();
		
		var id   = $(this).next().attr('id'),
		valorAct = parseInt($('#'+id).val());

		if ( ! isNaN(valorAct) && valorAct > 1) 
		{
			$('#'+id).val(valorAct - 1);
		} 
		else
		{
			$('#'+id).val(1);
		}
	});

	$("#formAdd2Cart").submit(function(event) {
		event.preventDefault();
		stock = parseInt($("#stock").val());
		cantidad = parseInt($('#inputCantidad').val());
		
		if ( cantidad > stock)
		{
			alert("La cantidad solicitada no está disponible.");
			return;
		}

		this.submit();	
	});

	

	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails",
		pauseOnAction: true,
		pauseOnHover: true,
		touch: true,
	});
});