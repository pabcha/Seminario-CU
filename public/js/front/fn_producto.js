$(document).ready(function() {

	$('.sumar').click(function (e) 
	{
		e.preventDefault();
		var id = $('#cantidad');
		valorAct = parseInt(id.val());		

		if (!isNaN(valorAct)) 
		{
			id.val(valorAct + 1);
		} 
		else
		{
			id.val(1);
		}
	});

	$('.restar').click(function(e){
		e.preventDefault();
		
		var id = $('#cantidad');
		valorAct = parseInt(id.val());

		if ( ! isNaN(valorAct) && valorAct > 1) 
		{
			id.val(valorAct - 1);
		} 
		else
		{
			id.val(1);
		}
	});

	//Slider

	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 110,
		itemMargin: 5,
		asNavFor: '#slider'
	});

	$('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#carousel",
		start: function(slider){
		  $('body').removeClass('loading');
		}
	});

	//notification

	var notiConf = {
		msg: "",
		position: "center",
		bgcolor: "",
		color: "#fff",
		time: 2500
	}

	var options = {
		urlAdd:  help.baseUrl + '/index/add_producto/' + $('#id').val()
	}

	$('#addCarro').click(function (e) {
		var params = {
			cantidad: $('#cantidad').val()
		}

		$.ajax({
			url: options.urlAdd,
			type: 'POST',
			dataType: 'json',
			data: params,
		})
		.done(function(data) {
			
			if ( data.status == 'success' )
			{
				notiConf['bgcolor'] = '#27ae60';
				notiConf['msg'] = 'El producto ha sido agregado al carrito!';
				notif( notiConf );

				var msg = (data.cantidad > 1 || data.cantidad == 0) ? 
					data.cantidad + ' productos' :
					data.cantidad + ' producto';

				$("#menu-cantidad").text( msg );
				$("#menu-total").text('$ ' + data.total.format(2, 3, '.', ','));
			} 
			else if ( data.status == 'error' ) 
			{
				notiConf['bgcolor'] = '#b94a48';
				notiConf['msg'] = 'No hay suficiente producto en stock.';
				notif( notiConf );
			}
		})
		.fail(function() {
			console.log("error");
		});	
		
	});
});