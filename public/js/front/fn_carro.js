var options = {
	url: help.baseUrl + '/carrito/updateC/',
	urlRemove: help.baseUrl + '/carrito/deleteC/',
	notiConf: {
		msg: "No hay suficiente producto en stock.",
		position: "center",
		bgcolor: "#b94a48",
		color: "#fff",
		time: 2500
	}
};



$(document).ready(function() {

	var promise = function (url, data)
	{
		return $.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: data,
		});
	}

	var render = function (data, id_total)
	{
		$("#menu-cantidad").text(data.cantidad);
		$("#menu-total").text('$ ' + data.total.format(2, 3, '.', ','));

		$(id_total).text('$ ' + data.subtotal.format(2, 3, '.', ','));
		$('#total').text('$ ' + data.total.format(2, 3, '.', ','));
	}

	var error = function () 
	{
		notif( options.notiConf );
	}

	$('.inputCant').change(function(event) {
		var that = $(this);
		var cantidad = parseInt( that.val() );

		if (isNaN(cantidad)) 
		{	
			return;
		}

		var id_total = '#total-' + that.attr('id');
		var url = options.url + that.attr('id');
		var data = {cantidad: cantidad};

		promise(url, data)
		.done(function (data) {
			if ( data.status == 'success')
			{
				render(data, id_total);
			} else if ( data.status == 'error')
			{
				error();
				that.val( data.stock );
				console.log(':(');
			}
		}).fail(function () {
			console.log("error");
		});
	});

	$('.sumar').click(function (e) 
	{
		e.preventDefault();
		var inputCant = $(this).prev();
		valor = parseInt(inputCant.val());

		if (!isNaN(valor)) 
		{
			var url = options.url + inputCant.attr('id');
			var data = {cantidad: valor + 1};
			var id_total = '#total-' + inputCant.attr('id');

			promise(url, data)
			.done(function (data) {
				if ( data.status == 'success')
				{
					render(data, id_total);
					inputCant.val(valor + 1);
				} else if ( data.status == 'error')
				{
					error();
					console.log(':(');
				}
			}).fail(function () {
				console.log("error");
			});
		} 
		else
		{
			inputCant.val(1);
		}
	});

	$('.restar').click(function(e){
		e.preventDefault();
		var inputCant = $(this).next();
		valor = parseInt(inputCant.val());

		if ( ! isNaN(valor) && valor > 1) 
		{
			var url = options.url + inputCant.attr('id');
			var data = {cantidad: valor - 1};
			var id_total = '#total-' + inputCant.attr('id');

			promise(url, data)
			.done(function (data) {
				if ( data.status == 'success')
				{
					render(data, id_total);
					inputCant.val(valor - 1);
				} else if ( data.status == 'error')
				{
					error();
					console.log(':(');
				}
			}).fail(function () {
				console.log("error");
			});
		} 
		else
		{
			inputCant.val(1);
		}
	});

	$(".icon-trash").click(function(){
		if ( confirm('¿Esta seguro de que desea quitar este producto?') ) 
		{
			var url = options.urlRemove + $(this).attr('id');
			var that = $(this);

			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json'
			})
			.done(function(data) {
				if (data.status == 'success')
				{					
					that.closest('tr').fadeOut(400, function(){ 
						$(this).remove();

						$("#menu-cantidad").text(data.cantidad);
						$("#menu-total").text('$ ' + data.total.format(2, 3, '.', ','));
						$('#total').text('$ ' + data.total.format(2, 3, '.', ','));

						if ( $('#tab-det-carro > tbody tr').length == 0 )
						{
							$('#detalle_carro').html('<p>Su carrito esta vacío.</p>');
						}
					});
				}
			})
			.fail(function() {
				console.log("error");
			});	
		}
	});
});