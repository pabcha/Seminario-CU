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

	/*$("#formAdd2Cart").submit(function(event) {
		event.preventDefault();
		stock = parseInt($("#stock").val());
		cantidad = parseInt($('#inputCantidad').val());
		
		if ( cantidad > stock)
		{
			alert("La cantidad solicitada no está disponible.");
			return;
		}

		this.submit();	
	});*/
	var amaranConfig = {
			content: {
				bgcolor: '',
				message   :'',
				color: '#fff'
			},
	        theme: 'colorful',
	        position: 'bottom right'
	    };

	$('#addCarro').click(function (e) {
		var stock = $('#stock').val();
		var cantidad = $('#cantidad').val();

		if ( cantidad > stock)
		{
			amaranConfig.content.bgcolor = '#b94a48';
			amaranConfig.content.message = 'La cantidad solicitada no está disponible!';
			$.amaran( amaranConfig );
		}
		else
		{
			amaranConfig.content.bgcolor = '#27ae60';
			amaranConfig.content.message = 'El producto ha sido agregado al carrito!';
			$.amaran( amaranConfig );
		}

		
	});
});